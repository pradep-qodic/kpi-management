<script src="<?php echo admin_base_url();?>themes/admin/assets/demo/default/custom/components/forms/widgets/bootstrap-select.js"></script>
<script src="<?php echo admin_base_url();?>themes/admin/assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js"></script>
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
</style>
<div class="m-grid__item m-grid__item--fluid m-wrapper">    
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
							Datamangement View
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
                            <a href="#" data-toggle="modal" data-target="#add-width-modal" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                <span>
									<i class="la la-cart-plus"></i>
									<span>Create</span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                </div>
                <div id="userTable">
                    <?php echo $this->load->view('admins/viewformdata'); ?>
                </div>
                <!--end: Datatable -->
            </div>
        </div>		
    </div>
</div>
<div class="modal fade" id="add-width-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-md-4">
				<button type="button" class="btn m-btn--pill m-btn--air btn-outline-success btn-lg setform" data_fromname="c_s_kpi">C&S KPI</button>	
			</div>
			<div class="col-md-4">
				<button type="button" class="btn m-btn--pill m-btn--air btn-outline-success btn-lg setform" data_fromname="clinical_kpi"> Clinical KPI</button>	
			</div>
			<div class="col-md-4">
				<button type="button" class="btn m-btn--pill m-btn--air btn-outline-success btn-lg setform" data_fromname="finance_kpi">Finance KPI</button>	
			</div>
		</div>	
		<div class="row" style="    margin-top: 10%;">
			<div class="col-md-4">
				<button type="button" class="btn m-btn--pill m-btn--air btn-outline-success btn-lg setform" data_fromname="hr_kpi">HR KPI</button>	
			</div>
			<div class="col-md-4">
				<button type="button" class="btn m-btn--pill m-btn--air btn-outline-success btn-lg setform" data_fromname="it_kpi">IT KPI</button>	
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>
<!-- Edit time modal -->
<div class="modal fade" id="form-width-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="fromname"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form name="save-form" id="save-form" method="post" class="m-form m-form--fit m-form--label-align-right">
			<div class="form-group m-form__group row">
				<label class="col-form-label col-lg-3 col-sm-12">Select Site</label>
				<div class="col-lg-4 col-md-9 col-sm-12">
					<select class="form-control m-bootstrap-select m_selectpicker getloaddata" name="store_id" id="store_id">
						<option value="0">Select Site</option>
						<?php foreach($getStore as $allstore){?>
							<option value="<?php echo $allstore->store_id; ?>"><?php echo $allstore->store_name; ?></option>
						<?php } ?>						
					</select>
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-form-label col-lg-3 col-sm-12">Select Month & Year</label>
				<div class="col-lg-4 col-md-9 col-sm-12">
					<input type="month"  name="month_year" value="<?php echo date('Y-m'); ?>" class="form-control getloaddata" placeholder="Select date" id="month_year"/>
				</div>
			</div>			
			<hr>
			<div id="showForm_set">
			
			</div>	
			<input type="hidden" name="formname" id="formname"/>	
			<input type="hidden" name="id" id="id"/>	
		</form>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="save_data"  class="btn btn-primary fromIdchnage">Save</button>        
      </div>
    </div>
  </div>
</div>
<!--.modal-->
<script src="<?php echo admin_base_url();?>themes/admin/js/datamanagement.js"></script>
<script src="<?php echo admin_base_url();?>themes/admin/js/bootbox.min.js"></script>