<table class="table table-hover" style="background-color: rgba(241, 241, 241, 1)">
	<thead>
		<tr>
			<th>Currency</th>
			<th>Order</th>
			<th>Strike time</th>
			<th>Expiry</th>
			<th>Strike</th>
			<th>Expiration rate</th>
			<th>Amount</th>
			<th>Return</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($rates as $rate): ?>
		<tr data-rateID="<?php echo $rate->rate_id; ?>" class="closed <?php echo RatesGlobals::$statuses[$rate->status]['class']; ?>">
			<td><?php echo $rate->rate_currency; ?></td>
	    	<td><?php echo $rate->rate_type; ?></td>
	    	<td><?php echo date('d-m-Y H:i:s', $rate->rate_start_time); ?></td>
	        <td><?php echo date('d-m-Y H:i:s', $rate->rate_end_time); ?></td>
			<td><?php echo $rate->strike_value; ?></td>
			<td><?php echo $rate->expiration_value; ?></td>
			<td><?php echo $rate->rate_value; ?></td>
			<td><?php echo $rate->rate_value * 1.85; ?></td>
			<td class="status"><?php echo RatesGlobals::$statuses[$rate->status]['text']; ?></td>
		</tr>		
		<?php endforeach; ?>
	</tbody>			
</table>
<?php $this->widget('RLinkPager', array(
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