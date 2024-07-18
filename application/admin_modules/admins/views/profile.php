<link rel="stylesheet" type="text/css" href="">
<style>	
	.title_fon
	{
	font-weight: 700 !important;
	text-transform: uppercase !important;
	}
	.croppie-container .cr-slider-wrap {
    width: 37%!important;
	}
	.cr-boundary{
	width: 401px;
	height: 300px;
	}
</style>
<script>
	$('.dropdown-toggle').dropdown();
</script>
<!-- END: Left Aside -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">Profile</h3>
			</div>
			<div>
				<span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
					<span class="m-subheader__daterange-label">
						<span class="m-subheader__daterange-title"></span>
						<span class="m-subheader__daterange-date m--font-brand"></span>
					</span>
					<a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
						<i class="la la-angle-down"></i>
					</a>
				</span>
			</div>
		</div>
	</div>
	<div class="m-content">
		<div class="row">
			<div class="col-md-6">
				<div class="m-portlet m-portlet--tab">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
									<i class="la la-gear"></i>
								</span>
								<h3 class="m-portlet__head-text">
									Settings
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-section">
							<div class="m-section__content">
								<div class="grid-block align-center">											
									<div class="row">
										<?php
											if($usersdata[0] && $usersdata[0]->profile_pic){
												$userprofileimage = $usersdata[0]->profile_pic;													
												}else{
												$userprofileimage = 'default.jpg';
											}
										?>
										<div class="col col s4 m4 l4">
											<img src="<?php echo base_url().'uploads/adminLogo/'.$userprofileimage;?>" style="cursor: pointer; width:130px; margin-left: 30%" id="Modals_Img" class="profile_model img-responsive img-circle collectionImg" title="Logo" alt=""/>
										</div>
									</div>											
									<input type="hidden" class="" style="margin-left:320px;" name="useruid" id="useruid" value="<?php echo ($usersdata[0]->user_id ? $usersdata[0]->user_id : ''); ?>"></br></br>
									
								</div>
								<div class="example-box-wrapper" id="submit_email">		
									<form class="form-horizontal" id="submit_profile_data">
										<div class="form-group row">
											<label class="col-lg-4 control-label">Name</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo ($usersdata[0]->name ? $usersdata[0]->name : ''); ?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-4 control-label">Email</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" name="email" id="email" placeholder="" value="<?php echo ($usersdata[0]->email ? $usersdata[0]->email : ''); ?>">
											</div>
										</div>
									</form>
									<button type="button" class="btn btn-accent" id="submitprofile" style="margin-left:30%;">Submit</button>
								</div>
								
								<div id="popup_profile_pic" style="display:none;">
									<div class="row">
										<div class="col-md-8">
											<div class="card-panel" >
												<form id="submit_profile" method="post">														
													<div class="file-field input-field" style="text-align: center;">
														<div class="btn">
															<input type="file" class="btn btn-custom waves-effect waves-light" id="upload" multiple="">
														</div>
														<div id="upload-demo"></div>
														<input type="hidden" id="imagebase64" name="imagebase64">
														<input type="hidden" class="" style="margin-left:320px;" name="image_name" id="image_name" value="<?php echo ($usersdata[0]->profile_pic ? $usersdata[0]->profile_pic : ''); ?>">
													</div>
													<div style="text-align: center;">
														<a class="btn btn-info waves-effect w-md waves-light m-b-5" id="close_popup" name=""> Close </a> &nbsp &nbsp
														<a href="#" class="upload-result btn btn-success waves-effect w-md waves-light m-b-5" id="Upload_adminimage" style=""> Upload </a>	
													</div>
												</form>						
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="m-portlet m-portlet--tab">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
									<i class="la la-gear"></i>
								</span>
								<h3 class="m-portlet__head-text">
									Reset Password
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-section">
							<div class="m-section__content">
								<form class="form-horizontal" id="reset_pass">
									<div class="panel">
										<div class="panel-body">
											<div class="example-box-wrapper">
												<div class="form-group row">
													<label class="col-lg-4 control-label">New Password</label>
													<div class="col-lg-6">
														<input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter new password...">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-4 control-label">Confirm Password</label>
													<div class="col-lg-6">
														<input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Enter new password...">
													</div>
												</div>
												<div>
													<input type="hidden" class="" style="margin-left:320px;" name="useruid" id="useruid" value="<?php echo ($usersdata[0]->user_id ? $usersdata[0]->user_id : ''); ?>">
													<button type="button" class="btn btn-accent" id="resetpass" style="margin-left:36%;">Submit</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel">
				
			</div>			
		</div>
	</div>  
</div>  