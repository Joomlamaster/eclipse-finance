<?php 
class TransactionController extends UserController
{
	function actionBonus($user_id)
	{       
		
		if(!$user = Users::model()->findByPk($user_id))
			throw new CHttpException(404,'Page not found.'); 
		$model = new BonusToUsers('search');
		$model->unsetAttributes();  // clear any default values
		//echo $user_id;exit;
		$model->user_id = $user_id; 
		if(isset($_GET['BonusToUsers']))
			$model->attributes=$_GET['BonusToUsers'];

		$bonusForm = new BonusForm;
		if(isset($_POST['BonusForm']))
		{
			$bonusForm->attributes = $_POST['BonusForm'];
			if($bonusForm->validate())
			{
				$model = new BonusToUsers;
				$model->type_id = $bonusForm->type_id;
				$model->bonus_timestamp = strtotime($bonusForm->date);
				$model->bonus_value = $bonusForm->bonus_value;
				$model->user_id = $user_id; 
				$model->save();
				
				switch($model->type_id)
				{
					case 0: {
						$user->bonus+=$bonusForm->bonus_value;
						$user->balance+=$bonusForm->bonus_value;						
					} break;
				}
				
				$user->save(false);
				
				Yii::app()->user->setFlash('success', 'Bonus added');
				$this->refresh();
			}
		}
		$this->render('bonus', compact('model', 'bonusForm', 'user'));
	}

	function actionDeleteBonus($bonus_id)
	{
		$result = array('deletedID' => $bonus_id);
		$bonus = BonusToUsers::model()->findByPk($bonus_id); 
		if($bonus)
		{
			$user = users::model()->findByPk($bonus->user_id);
			if($user)
			{
				switch($bonus->type_id)
				{
					case 0: { //bonus manually
						$user->balance-=$bonus->bonus_value;
						$user->bonus-=$bonus->bonus_value;	
					} break;
				}

				$user->save(false); 
			}
			if($bonus->delete())
				$result['code'] = 'success';
			else 
				$result['code'] = 'fail';
			
		} else 
			$result['code'] = 'fail';
			
			echo CJSON::encode($result);
		//throw new CHttpException(404, 'Page not found');
	}
	
	function actionDeleteDeposit($transaction_id)
	{
		$result = array('deletedID' => $transaction_id);
		$deposit = Transactions::model()->findByPk($transaction_id);
		if($deposit)
		{
			$user = users::model()->findByPk($deposit->user_id);
			if($user)
			{
				switch($deposit->type_id)
				{
					case 0: { //bonus manually
						$user->balance-=$deposit->amount;
						$user->deposit-=$deposit->amount;
					} break;
					case 1: { //is ats bonus
						$user->ats_balance-=$deposit->amount;
						$user->ats_deposit-=$deposit->amount;
					} break;
					case 2: { //is pro following bonus
						$user->pro_balance-=$deposit->amount;
						$user->pro_deposit-=$deposit->amount;
					}
				}
	
				$user->save(false);
			}
			if($deposit->delete())
				$result['code'] = 'success';
			else
				$result['code'] = 'fail';
				
		} else
			$result['code'] = 'fail';
			
		echo CJSON::encode($result);
		//throw new CHttpException(404, 'Page not found');
	}	
	
	function actionDeposit($user_id)
	{
		if(!$user = Users::model()->findByPk($user_id))
			throw new CHttpException(404,'Page not found.');		
		$model = new Transactions('search');
		$model->unsetAttributes();  // clear any default values
		$model->user_id = $user_id;
		if(isset($_GET['Transactions']))
		$model->attributes=$_GET['Transactions'];
		
		$depositForm = new DepositForm;
		if(isset($_POST['DepositForm']))
		{
			$deposit_type = $_POST['DepositForm'][deposit_type];
			$depositForm->attributes = $_POST['DepositForm'];
			
			if($depositForm->validate())
			{
				$model = new Transactions;
				$model->type_id = $depositForm->type_id;
				$model->deposit_type = $deposit_type;
				$model->timestamp = strtotime($depositForm->date);
				$model->amount = $depositForm->amount;
				$model->user_id = $user_id;
				$model->save();
				
				switch($model->type_id)
				{
					case 0: {
						$user->deposit+=$depositForm->amount;
						$user->balance+=$depositForm->amount;
						if(!$user->deposit_first)
							$user->deposit_first = $depositForm->amount;
					} break;
					case 1: {
						$user->ats_deposit+=$depositForm->amount;
						$user->ats_balance+=$depositForm->amount;
					}break;
					case 2: {
						$user->pro_deposit+=$depositForm->amount;
						$user->pro_balance+=$depositForm->amount;
					}
				}				
				$user->save(false);
								
				Yii::app()->user->setFlash('success', 'Deposit added');
				$this->refresh();
			}
		}		
		$this->render('deposit', compact('model', 'depositForm', 'user'));
	}
	
	function actionDeduction($user_id)
	{
		if(!$user = Users::model()->findByPk($user_id))
			throw new CHttpException(404,'Page not found.');		
		$model = new DeductionToUsers('search');
		$model->unsetAttributes();  // clear any default values
		$model->user_id = $user_id;
		if(isset($_GET['DeductionToUsers']))
			$model->attributes=$_GET['DeductionToUsers'];
		
		$deductionForm = new DeductionForm;
		if(isset($_POST['DeductionForm']))
		{
			$deductionForm->attributes = $_POST['DeductionForm'];
			if($deductionForm->validate())
			{
				$model = new DeductionToUsers;
				$model->deduction_timestamp = strtotime($deductionForm->date);
				$model->deduction_value = $deductionForm->deduction_value;
				$model->comment = $deductionForm->comment;
				$model->user_id = $user_id;
				$model->save();
				
				$user->balance-=$model->deduction_value;
				$user->save(false);
		
				Yii::app()->user->setFlash('success', 'Success');
				$this->refresh();
			}
		}		
		$this->render('deduction', compact('model', 'deductionForm', 'user'));
	}
	
	function actionDeleteDeduction($deduction_id)
	{
		$result = array('deletedID' => $deduction_id);
		$deduction = DeductionToUsers::model()->findByPk($deduction_id);
		if($deduction)
		{
			$user = users::model()->findByPk($deduction->user_id);
			if($user)
			{
				$user->balance+=$deduction->deduction_value; 	
				$user->save(false);
			}
			if($deduction->delete())
				$result['code'] = 'success';
			else
				$result['code'] = 'fail';
	
		} else
			$result['code'] = 'fail';
			
		echo CJSON::encode($result);
	}	
	
	function actionBalanceCorrector($user_id)
	{
		$model = Users::model()->findByPk($user_id);
		$balance_deduction = $model->balance_deduction;
		$ats_balance_deduction = $model->ats_balance_deduction;
		$pro_balance_deduction = $model->pro_balance_deduction;
		if(isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
			if($model->validate())
			{
				$model->balance -= $model->balance_deduction - $balance_deduction;
				$model->ats_balance -= $model->ats_balance_deduction - $ats_balance_deduction;
				$model->pro_balance -= $model->pro_balance_deduction - $pro_balance_deduction;
				$model->save(false); 
				Yii::app()->user->setFlash('success', 'Balance refreshed');
				$this->refresh();
			}
		}
		
		$this->render('corrector', compact('model'));
	}
}
?>