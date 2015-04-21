<style>
profile-container .profile-content {
width: 713px;
}
.profile-container {
padding: 0;
}
.table-bordered {
-webkit-border-radius: 0;
-moz-border-radius: 0;
border-radius: 0;
}
.table-bordered thead:first-child tr:first-child>th:first-child, .table-bordered tbody:first-child tr:first-child>td:first-child, .table-bordered tbody:first-child tr:first-child>th:first-child {
-webkit-border-top-left-radius: 0;
-moz-border-radius-topleft: 0;
border-top-left-radius: 0;

-webkit-border-radius: 0;
-moz-border-radius: 0;
border-radius: 0;
}
.table-bordered thead:last-child tr:last-child>th:first-child, .table-bordered tbody:last-child tr:last-child>td:first-child, .table-bordered tbody:last-child tr:last-child>th:first-child, .table-bordered tfoot:last-child tr:last-child>td:first-child, .table-bordered tfoot:last-child tr:last-child>th:first-child {
-webkit-border-bottom-left-radius: 0;
-moz-border-radius-bottomleft: 0;
border-bottom-left-radius: 0;
}
i.fa.fa-caret-up {
font-size: 35px;
color: green;
}
i.fa.fa-caret-down {
font-size: 35px;
color: red;
}
tr.closed td {
text-align: center;
}
h1.heading.profile, h1.heading.login, h1.heading.invest {
   background: url("/assets/1e83dde4/img/head-bg.png") no-repeat scroll 0 0 / 100% auto rgba(0, 0, 0, 0) !important;
}
</style>
<div class="bs-example" data-example-id="bordered-table">
    <table class="table table-bordered">
      	<thead>
			<tr>
				<th>Asset</th>
				<th>Action</th>
				<th>Entry Date</th>
				<th>Expiry Date</th>
				<th>Entry Rate</th>
				<th>Expiry Rate</th>
				<th>Invest</th>
				<!-- <th>Amount</th> -->
				<th>Return</th>
				<th>Status</th>
			</tr>
		</thead>
	    <tbody>
			<?php foreach($rates as $rate): ?>
			<tr data-rateID="<?php echo $rate->rate_id; ?>" class="closed <?php echo Globals::$statuses[$rate->status]['class']; ?>">
			<td><?php echo $rate->rate_currency; ?></td>
		    	<td><?php if($rate->rate_type == 'above') { ?> <i class="fa fa-caret-up"></i> <?php } ?><?php if($rate->rate_type == 'below') { ?> <i class="fa fa-caret-down"></i> <?php } ?></td>
		    	<td><?php echo date('d-m-Y H:i', $rate->rate_start_time); ?></td>
		        <td><?php echo date('d-m-Y H:i', $rate->rate_end_time); ?></td>
				<td><?php echo $rate->strike_value; ?></td>
				<td><?php echo $rate->expiration_value; ?></td>
				<!-- <td><?php echo $rate->rate_value; ?></td> -->
				<td><?php echo $rate->rate_value?> </td>
				<td><?php
				 $sts = Globals::$statuses[$rate->status]['text'];
				 if($sts == "You Lose!"){
				 echo "0";
				 } else{
				 echo $rate->rate_value * 1.85;
				 } ?></td>
				<td class="status"><?php echo Globals::$statuses[$rate->status]['text']; ?></td>
			</tr>		
			<?php endforeach; ?>
		</tbody>
    </table>
    <?php $this->widget('BLinkPager', array(
	    'pages' => $pages,
		'id' => '',
		'firstPageLabel' => '<i class="icon-chevron-left"></i><i class="icon-chevron-left"></i>',
		'lastPageLabel' => '<i class="icon-chevron-right"></i><i class="icon-chevron-right"></i>',

		'prevPageLabel' => '<i class="icon-chevron-left"></i>',
		'nextPageLabel' => '<i class="icon-chevron-right"></i>',
		
		'htmlOptions' => array(
			'class' => 'btn-group'
		)
	)) ?>
</div>