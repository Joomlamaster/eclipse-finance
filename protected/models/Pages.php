<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $page_id
 * @property integer $pid
 * @property string $page_name
 * @property string $page_title
 * @property string $page_body
 */
class Pages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid', 'numerical', 'integerOnly'=>true),
			array('page_name, page_title', 'length', 'max'=>255),
			array('page_body, page_url, page_type, weight', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('page_id, pid, page_url, page_name, page_title, page_body', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'childs' => array(self::HAS_MANY, 'Pages', 'pid')
		);
	}

	public function getPageByActionId()
	{
		$criteria = new CDbCriteria; 
		$criteria->condition = 'page_type=:page_type';
		$criteria->params = array(':page_type' => strtolower(Yii::app()->controller->action->id));
		
		if(!($page = Pages::model()->find($criteria)))
		{
			$page = new Pages; 
			$page->page_type = strtolower(Yii::app()->controller->action->id); 
			$page->save(false); 
		} 
		return $page;
	}
	
	public function getPageByType($type)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'page_type=:page_type';
		$criteria->params = array(':page_type' => $type);	
		return Pages::model()->find($criteria); 	
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'page_id' => 'Page',
			'pid' => 'Parent page',
			'page_name' => 'Page Name',
			'page_title' => 'Page Title',
			'page_body' => 'Page Body',
		);
	}
	
	public function getPagesTree($criteria = null) {
		if(!$criteria)
			$criteria = new CDbCriteria;
		$pages = self::model()->findAll($criteria); 
		return $this->buildTree($pages);
	}

	function findByUrl($url)
	{
		if($url)
			return $this->find('page_url=:page_url', array(':page_url' => $url));
		return null;
	}	

	private function buildTree($data, $rootID = 0) {
		$tree = array();
		foreach ($data as $id => $node) {
			if ($node->pid == $rootID) {
				unset($data[$id]);
				$node->childs = $this->buildTree($data, $node->page_id);
				$tree[] = $node;
			}
		}
		return $tree;
	}	
	
	public function isChild($page_id, $root)
	{
		if($page_id !== null)
		{
			foreach($root->childs as $child)
			{
				if($child->page_id == $page_id)
					return $root->page_id == $child->pid;
			}
		}
		return false; 
	}
	 
	function beforeSave()
	{
		if(parent::beforeSave())
		{
			$this->pid = is_numeric($this->pid) ? $this->pid : 0;
			return true;
		}
		return false;
	}	

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('page_id',$this->page_id);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('page_name',$this->page_name,true);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_body',$this->page_body,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
