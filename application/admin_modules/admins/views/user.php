<style>
    .tagclass {
	width: auto;
	height: 20px;
	background: #c8d1f5;
	color: #657aa9;
	padding: 3px 7px 4px 6px;
	border-radius: 13px;
	font-weight: 800;
    }
	.buttonload {
    background-color: #4CAF50; /* Green background */
    border: none; /* Remove borders */
    color: white; /* White text */
    padding: 12px 16px; /* Some padding */
    font-size: 16px /* Set a font size */
	}
</style>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">Users</h3>
				<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
					<li class="m-nav__item m-nav__item--home">
						<a href="" class="m-nav__link m-nav__link--icon">
							<i class="m-nav__link-icon la la-home"></i>
						</a>
					</li>
					<li class="m-nav__separator">-</li>
					<li class="m-nav__item">
						<a href="" class="m-nav__link">
							<span class="m-nav__link-text">user</span>
						</a>
					</li>
				</ul>
			</div>			
		</div>
	</div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <!--<div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
							Users List
						</h3>
					</div>
				</div>
			</div>-->
            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
					<div class="row align-items-center">
						<div class="col-xl-8 order-2 order-xl-1">
							<div class="form-group m-form__group row align-items-center">
								<div class="col-md-4">
									<div class="m-input-icon m-input-icon--left">
										<input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
										<span class="m-input-icon__icon m-input-icon__icon--left">
											<span><i class="la la-search"></i></span>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 order-1 order-xl-2 m--align-right">
							<a href="#" data-toggle="modal" id="btn-add-user" data-target="#full-width-modal" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
								<span>
									<i class="flaticon-user-ok"></i>
									<span>Add User</span>
								</span>
							</a>
							<div class="m-separator m-separator--dashed d-xl-none"></div>
						</div>
					</div>
				</div>
                <div id="userTable">
					<?php echo $this->load->view('admins/viewuser'); ?>
				</div>
                <!--end: Datatable -->
			</div>
		</div>
	</div>
</div>
<div class="modal modal-fullscreen fade" id="full-width-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <form name="Adduser-form" id="Adduser-form" class="form-horizontal" role="form">
					<div class="form-group row">
						<label class="col-md-4 control-label">Name</label>
						<div class="col-md-6">
							<input type="text" name="name" class="form-control" placeholder="enter name">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Email">Email</label>
						<div class="col-md-6">
							<input type="email"  name="email" class="form-control" placeholder="enter email">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Address">Address</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="address" placeholder="address" rows="5"></textarea>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Contact Number">Contact Number</label>
						<div class="col-sm-6">
							<input type="text" name="phone_no" class="form-control" maxlength="10" placeholder="enter contact number">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Contact Number">Site</label>
						<div class="col-sm-6">
							<select class="form-control m-bootstrap-select m_selectpicker" name="site_id[]" multiple data-actions-box="true">																								
								<?php foreach($getStore as $allstore){?>
									<option value="<?php echo $allstore->store_id; ?>"><?php echo $allstore->store_name; ?></option>
								<?php } ?>						
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Contact Number">User Type</label>
						<div class="col-sm-6">
							<label class="m-radio">
								<input type="radio" name="usertype" checked="checked" value="2"> Staff
								<span></span>
							</label>
							<label class="m-radio">
								<input type="radio" name="usertype" value="1"> Admin
								<span></span>
							</label>							
						</div>
					</div>	
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="add_user" class="btn btn-primary"><i class="fa fa-spinner fa-spin" id="fa-spin"></i> Save</button>
			</div>
		</div>
	</div>
</div>
<!-- Edit time modal -->
<div class="modal modal-fullscreen fade" id="edit-full-width-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="Adduser-form" id="edit-user-form" class="form-horizontal" role="form">
					<input type="hidden" name="userid" id="userid" class="form-control" value="">
					<div class="form-group row">
						<label class="col-md-4 control-label">Name</label>
						<div class="col-md-6">
							<input type="text" name="name" id="name" class="form-control" placeholder="enter name">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Email">Email</label>
						<div class="col-md-6">
							<input type="email"  name="email"  id="email" class="form-control" placeholder="enter email">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Address">Address</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="address" id="address" placeholder="address" rows="5"></textarea>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Contact Number">Contact Number</label>
						<div class="col-sm-6">
							<input type="text" name="phone_no" id="phone_no"  class="form-control" maxlength="10" placeholder="enter contact number">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Contact Number">Site</label>
						<div class="col-sm-6">
							<select class="form-control m-bootstrap-select m_selectpicker"  id="site_id" name="site_id[]" multiple data-actions-box="true">																									
								<?php foreach($getStore as $allstore){?>
									<option value="<?php echo $allstore->store_id; ?>"><?php echo $allstore->store_name; ?></option>
								<?php } ?>						
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 control-label" for="Contact Number">User Type</label>
						<div class="col-sm-6">
							<label class="m-radio">
								<input type="radio" name="usertype" id="edit_usertype_s" value="2"> Staff
								<span></span>
							</label>
							<label class="m-radio">
								<input type="radio" name="usertype" id="edit_usertype_a" value="1"> Admin
								<span></span>
							</label>							
						</div>
					</div>	
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="update-user" class="btn btn-primary">Update</button>
			</div>
		</div>
	</div>
</div>
<!--.modal-->
																							