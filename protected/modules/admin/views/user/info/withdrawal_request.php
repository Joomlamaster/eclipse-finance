<dl class="dl-horizontal">
	<h1><?php echo $request->payment_methods[$request->payment_method_id];?></h1>

	<dt>Request ID</dt>
	<dd><?php echo $request->request_id; ?>&nbsp;</dd>
  	<?php if($request->payment_method_id == 1): ?>
	<dt>Bank Wire Account</dt>
	<dd><?php echo $request->bank_wire_account; ?>&nbsp;</dd> 
	
	<dt>Customer Name</dt>
	<dd><?php echo $request->customer_name; ?>&nbsp;</dd>
	
	<dt>Bank Name</dt>
	<dd><?php echo $request->bank_name; ?>&nbsp;</dd>
	
	<dt>Bank Code</dt>
	<dd><?php echo $request->bank_code; ?>&nbsp;</dd>	
	
	<dt>Branch Address</dt>
	<dd><?php echo $request->branch_address; ?>&nbsp;</dd>	
	
	<dt>Account Number</dt>
	<dd><?php echo $request->account_number; ?>&nbsp;</dd>	
	
	<dt>Iban</dt>
	<dd><?php echo $request->iban; ?>&nbsp;</dd>	
	
	<dt>Swift</dt>
	<dd><?php echo $request->swift; ?>&nbsp;</dd>	
	
	<dt>Currency</dt>
	<dd><?php echo $request->currency; ?>&nbsp;</dd>							
		 	
  	<?php elseif($request->payment_method_id == 2): ?>
  	
  	<?php elseif($request->payment_method_id == 3): ?>
  	
  	<?php endif; ?>
  	
	<dt>Amount</dt>
	<dd><?php echo $request->amount; ?> &nbsp;</dd>	  	

	<dt>Comments</dt>
	<dd><?php echo $request->comments; ?> &nbsp;</dd>		
		
</dl>