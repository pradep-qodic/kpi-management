<table class="m-datatable" id="storeview">
	<thead>
		<tr>
			<th>No</th>
			<th>Name</th>			
			<th>Short name</th>						
			<th>Status</th>						
			<th data-field="Actions">Action</th>			
		</tr>
	</thead>
	<tbody>						
		<?php $no=1; foreach($getStore as $allusers){?>
			<tr>							
				<td><?php echo $no++;?></td>
				<td><?php echo $allusers->store_name;?></td>
				<td><?php echo $allusers->store_short_code; ?></td>												
				<td>					
					<div class="col-lg-4 col-md-9 col-sm-12">
						<span class="m-switch m-switch--primary">
							<label>
							<input <?php echo ( $allusers->status ? 'checked' : ''); ?> name="switchstatus" type="checkbox" class="save_status" data-on-color="brand" data-store='<?php echo json_encode($allusers);?>'>
							<span></span>
							</label>
						</span>						
					</div>
				</td>												
				<td>
					<span style="overflow: visible; width: 110px;" data_hedoffice="<?php echo $allusers->head_office; ?>" class="headoffice">						
						<a href="javascript:void(0);" data-store='<?php echo json_encode($allusers);?>' data-toggle="modal" data-target="#edit-width-modal"class="userEdit m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">
							<i class="la la-edit"></i>
						</a>
						<a href="javascript:void(0);" data-store='<?php echo json_encode($allusers);?>' class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill user_delete" title="Delete">
							<i class="la la-trash"></i>
						</a>
					</span>
				</td>
			</tr>
			<?php } ?>
	</tbody>
</table>