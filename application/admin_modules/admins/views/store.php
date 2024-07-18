<style>
.tagclass{
	width: auto;
    height: 20px;
    background: #c8d1f5;
    color: #657aa9;
    padding: 3px 7px 4px 6px;
    border-radius: 13px;    
    font-weight: 800;
}
.headofficeactivate :hover{
	background-color: #c2d26b;
}
.headofficeactivate{
	background-color: #c2d26b;
}
</style>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
							Site List
						</h3>
                    </div>
                </div>                
            </div>
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
                            <a href="#" data-toggle="modal" data-target="#full-width-modal" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                <span>
									<i class="la la-cart-plus"></i>
									<span>Add Site</span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                </div>
                <div id="userTable">
                    <?php echo $this->load->view('admins/viewstore'); ?>
                </div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="full-width-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Site</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form name="addstore-form" id="addstore-form" class="form-horizontal" role="form">					
			<div class="form-group row">
				<label class="col-md-3 control-label">Name</label>
				<div class="col-md-9">
					<input type="text" name="store_name" class="form-control" placeholder="enter name">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 control-label">Site Short name</label>
				<div class="col-md-9">
					<input type="text" name="store_short_code" class="form-control" placeholder="enter Short name">
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-md-3 control-label">status</label>
				<div class="col-lg-4 col-md-9 col-sm-12">
					<span class="m-switch m-switch--primary">
						<label>
							<input name="store_status" type="checkbox" data-on-color="brand" checked id="m_notify_url">
							<span></span>
						</label>
					</span>					
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 control-label">Head Office</label>
				<div class="col-lg-4 col-md-9 col-sm-12">					
					<label class="m-checkbox m-checkbox--state-success">
						<input type="checkbox" name="head_office"><span></span>
					</label>
					</span>					
				</div>
			</div>	
		</form>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="add_user_data"  class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit time modal -->
<div class="modal fade" id="edit-width-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Site</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form name="edit-form" id="edit-form" class="form-horizontal" role="form">					
			<div class="form-group row">
				<label class="col-md-3 control-label">Name</label>
				<div class="col-md-9">
					<input type="text" name="store_name" id="store_name" class="form-control" placeholder="enter name">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 control-label">Site Short name</label>
				<div class="col-md-9">
					<input type="text" name="store_short_code" id="store_short_code" class="form-control" placeholder="enter Short name">
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-md-3 control-label">status</label>
				<div class="col-lg-4 col-md-9 col-sm-12">
					<span class="m-switch m-switch--primary">
						<label>
							<input name="store_status" type="checkbox" data-on-color="brand" id="store_status">
							<span></span>
						</label>
					</span>					
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 control-label">Head Office</label>
				<div class="col-lg-4 col-md-9 col-sm-12">					
					<label class="m-checkbox m-checkbox--state-success">
						<input type="checkbox" name="head_office" id="head_office"><span></span>
					</label>
					</span>					
				</div>
			</div>
			<input type="hidden" name="store_id" id="store_id" class="form-control" placeholder="enter number">			
		</form>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update_user_data"  class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<!--.modal-->
