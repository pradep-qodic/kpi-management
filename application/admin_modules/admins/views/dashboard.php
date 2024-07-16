<link rel="stylesheet" type="text/css" href="<?php echo admin_base_url();?>themes/admin/css/dashboardpage.css">
<style>
.modal-dialog {
  max-width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

.modal-content {
  height: auto;
  min-height: 100%;
  border-radius: 0;
}
</style>
<!-- END: Left Aside -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader" style="padding: 23px 0px 23px 0;background-color: #716aca;">
		<div class="row">			
			<div class="col-md-2"></div>										
			<div class="col-md-2">			
				<select class="form-control m-bootstrap-select m_selectpicker reportcall"  id="site_id">
					<option value="0">Select Site</option>
					<option value="all">All Site</option>
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
			<div class="col-md-2">			
				<select class="form-control m-bootstrap-select m_selectpicker reportcall"  title="Select Year" id="select_year" data-max-options="1"  multiple="multiple">
						<?php for($i=2015;$i<=date('Y');$i++){ ?>
								<option value="<?php echo $i ?>"><?php echo $i.' / '.($i+1); ?></option>
						<?php } ?>
				</select>
			</div>
			<div class="col-md-2">			
				<select class="form-control  m-bootstrap-select m_selectpicker reportcall" title="Select Month" id="select_month" data-max-options="2" multiple="multiple">					
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
					<option value="ytd">YTD</option>
				</select>
			</div>			
			<div class="col-md-2"></div>
		</div>
	</div>
	<div class="m-content" id="setChart">		
			
	</div>
	<div class="m-content" id="camparedataview">
		<div class="row">			
			<div class="col-xl-4 order-1 order-xl-2">
				<a href="#" id="backmain" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
					<span><i class="la 	la-backward"></i><span>Back</span></span>
				</a>
				<div class="m-separator m-separator--dashed d-xl-none"></div>
			</div>			
		</div>
		<div class="row" id="set_compare_data" style="margin-top:10px;">
					
		</div>		
	</div>
	<!--<div class="m-content" id="multipalselect" style="display:none;">
		<label class="m-checkbox">All Compare
			<input type="checkbox" id="multipalcheckboxcheck">
			<span></span>
		</label>		
	</div>-->
</div>  
<!-- full recored data modal -->
<div class="modal fade" id="set-load-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="text-align: -webkit-center;display: -webkit-box;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 26px;">Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background: #f2f3f8;">
				<div class="row" id="set_compare_data_old">
				
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<script src="<?php echo admin_base_url();?>themes/admin/assets/demo/default/custom/components/forms/widgets/bootstrap-select.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="<?php echo admin_base_url() ?>./themes/admin/js/mainpage.js" type="text/javascript"></script>
