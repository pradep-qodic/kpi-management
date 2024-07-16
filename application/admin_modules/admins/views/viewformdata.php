<table class="m-datatable" id="storeview">
	<thead>
		<tr>
			<th>From Type</th>			
			<th>Site</th>						
			<th>Year & Month</th>						
			<th data-field="Actions">Action</th>			
		</tr>
	</thead>
	<tbody>						
		<?php foreach($getallfrom as $allfrom){?>
			<tr>
				<td><?php echo str_ireplace('_',' ',$allfrom->HR_KPI);?></td>
				<td><?php echo storename($allfrom->store_id); ?></td>												
				<td><?php echo date('M-Y',strtotime($allfrom->month_year)); ?></td>																
				<td>
					<span style="overflow: visible; width: 110px;">						
						<a href="javascript:void(0);" data-store='<?php echo json_encode($allfrom);?>' data-toggle="modal" data-target="#edit-width-modal"class="userEdit m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">
							<i class="la la-edit"></i>
						</a>
						<a href="javascript:void(0);" data-store='<?php echo json_encode($allfrom);?>' class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill user_delete" title="Delete">
							<i class="la la-trash"></i>
						</a>
					</span>
				</td>
			</tr>
			<?php } ?>
	</tbody>
</table>