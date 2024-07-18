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
                <div class="row" style="padding: 15px;">			
					<div class="col-md-2"></div>															
					<div class="col-md-2">			
						<select class="form-control m-bootstrap-select m_selectpicker reportcall"  id="site_id">
							<option value="0">Select Site</option>
							<?php foreach($getStore as $allstore){?>
								<option value="<?php echo $allstore->store_id; ?>"><?php echo $allstore->store_name; ?></option>
							<?php } ?>						
						</select>
					</div>
					<div class="col-md-2">			
						<select class="form-control m-bootstrap-select m_selectpicker reportcall"  id="select_type">
							<option value="0">Select Type</option>					
								<option value="c_s_kpi">C&S Kpi</option>
								<option value="clinical_kpi">Clinical Kpi</option>
								<option value="finance_kpi">Finance Kpi</option>
								<option value="hr_kpi">HR Kpi</option>
								<option value="it_kpi">IT Kpi</option>					
						</select>
					</div>
					<div class="col-md-2 pickershowhide" style="display:none;" id="viewYear">
						<select class="form-control m-bootstrap-select m_selectpicker reportcall"  title="Select Year" id="select_year">						
								<?php for($i=2015;$i<=date('Y');$i++){ ?>
									<option value="<?php echo $i ?>"><?php echo $i.' / '.($i+1); ?></option>
								<?php } ?>
						</select>
					</div>
					<div class="col-md-2 pickershowhide" style="display:none;">
						<select class="form-control m-bootstrap-select m_selectpicker reportcall" title="Select Month" id="select_month">					
							<?php  $formattedMonthArray = array(
								"1" => "January", "2" => "February", "3" => "March", "4" => "April",
								"5" => "May", "6" => "June", "7" => "July", "8" => "August",
								"9" => "September", "10" => "October", "11" => "November", "12" => "December",
							);
							for($i=7;$i<=12;$i++){ ?>
									<option value="<?php echo ($i > 9 ? $i : '0'.$i) ?>"><?php echo $formattedMonthArray[$i]; ?></option>
							<?php } 
							for($i=1;$i<=6;$i++){ ?>
									<option value="<?php echo ($i > 9 ? $i : '0'.$i) ?>"><?php echo $formattedMonthArray[$i]; ?></option>
							<?php } ?>		
						</select>
					</div>			
					<div class="col-md-2" id="btnshow" style="display:none;">
						<button type="button" id="save_data"  class="btn btn-primary fromIdchnage">Save budget</button>        
					</div>
					<div class="col-md-2"></div>
				</div>
            </div>
            <div class="m-portlet__body">                
                <form name="save-form" id="save-form" method="post" class="m-form m-form--fit m-form--label-align-right">
					<div id="formtypeset">                    
						
					</div>					
					<input type="hidden" name="store_id" id="store_id"/>	
					<input type="hidden" name="month_year" id="month_year"/>	
					<input type="hidden" name="formname" id="formname"/>	
					<input type="hidden" name="is_budget" id="is_budget" value="1"/>										
					<input type="hidden" name="id" id="id"/>										
				</form>
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