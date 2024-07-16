<table class="" id="user_datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Address</th>
			<th>Mobile No</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>						
		<?php
			foreach($Get_all_users as $allusers){?>
			<tr>											
				<td><?php echo $allusers->name;?></td>
				<td><?php echo $allusers->email; ?></td>
				<td><?php echo $allusers->address; ?></td>
				<td><?php echo $allusers->mobile_no; ?></td>
				<td>
					<span style="overflow: visible; width: 110px;">						
						<a href="javascript:void(0);" data-user='<?php echo json_encode($allusers);?>' data-toggle="modal" data-target="#edit-width-modal"class="userEdit m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">
							<i class="la la-edit"></i>
						</a>
						<a href="javascript:void(0);" data-user='<?php echo json_encode($allusers);?>' class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill user_delete" title="Delete">
							<i class="la la-trash"></i>
						</a>
					</span>
				</td>
			</tr>
			<?php } ?>
	</tbody>
</table>