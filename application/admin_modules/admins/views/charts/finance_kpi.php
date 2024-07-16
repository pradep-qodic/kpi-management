<?php 
	if($headoffice){
				$titalarr=array("finance_income"=>"Income PRPD",
					"finance_profit_loss"=>"Profit/Loss",
					"finance_profit_loss_prpd"=>"Profit/Loss PRPD",
					"finance_acfi"=>"AFCI PRPD",
					"finance_supported_ratio"=>"Supported Ratio",
					"finance_net_rads"=>"Net RAD's",
					"finance_rad_balance"=>"RAD Balance",
					"finance_rad_liquidity_head_office_only"=>"Rad liquidity",
					"finance_eom_cash_v_target_head_office_only"=>"EomCash",
					"finance_capital_expenses"=>"Capital Expenses YTD"
				);
	}else{
				$titalarr=array("finance_income"=>"Income PRPD",
					"finance_profit_loss"=>"Profit/Loss",
					"finance_profit_loss_prpd"=>"Profit/Loss PRPD",
					"finance_acfi"=>"AFCI PRPD",
					"finance_supported_ratio"=>"Supported Ratio",
					"finance_net_rads"=>"Net RAD's",
					"finance_rad_balance"=>"RAD Balance",					
					"finance_capital_expenses"=>"Capital Expenses YTD"
				);
	}
?>
<div class="row" id="setChart">
	<?php foreach($finalarray as $key=>$val): ?>	
	<?php if(array_key_exists($val['filed_name'],$titalarr)):?>
	<?php if($key!='finance_capital_expenses'): ?>	
	<div class="col-xl-4">			
		<div class="m-portlet m-portlet--bordered-semi m-portlet--half-height m-portlet--fit " style="min-height: 300px" data-filedname="<?php echo $val['filed_name']; ?>">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text"><?php echo $titalarr[$val['filed_name']]; ?></h3>
					</div>
					<div class="comparebox">
						<button type="button" data_title="<?php echo $titalarr[$val['filed_name']]; ?>" data_canvas_id="m_chart_bandwidth_<?php echo $key; ?>" class="btn btn-success compare_chart">Compare</button>
					</div>
				</div>					
			</div>
			<div class="m-portlet__body">					
				<div class="m-widget20">
					<?php if($val['filed_name']=='finance_supported_ratio'): ?>
						<div class="m-widget20__number actualsize" data_filed_name="<?php echo $titalarr[$val['filed_name']]; ?>" style="color:<?php echo $val['color']; ?>"><?php echo $val['actual'] .'&nbsp;%'; ?></div>					
						<div class="m-widget20__number goalsize"  data_filed_name="<?php echo $titalarr[$val['filed_name']]; ?>"style="color:<?php echo $val['color']; ?>">Goal :&nbsp;&nbsp;<?php echo $val['goal'] .'&nbsp;%'; ?></div>
					<?php else: ?>
						<div class="m-widget20__number actualsize" data_filed_name="<?php echo $titalarr[$val['filed_name']]; ?>" style="color:<?php echo $val['color']; ?>"><?php echo rupiss_format_val($val['actual']); ?></div>					
						<div class="m-widget20__number goalsize" data_filed_name="<?php echo $titalarr[$val['filed_name']]; ?>" style="color:<?php echo $val['color']; ?>">Goal :&nbsp;&nbsp;<?php echo rupiss_format_val($val['goal']); ?></div>
					<?php endif; ?>
					<div class="m-widget20__chart" style="height:160px;">
						<canvas class="getidinchart" data_barchart='<?php echo base64_encode(json_encode(($barchart ? $barchart[$val['filed_name']] : ''))); ?>' data_val='<?php echo base64_encode(json_encode($chartdataarr[$val['filed_name']])); ?>' id="m_chart_bandwidth_<?php echo $key; ?>" data_color_code="<?php echo $val['color']; ?>"></canvas>
					</div>
				</div>					
			</div>
		</div>
	</div>		
	<?php endif; ?>
	<?php endif; ?>	
	<?php if($key=='finance_capital_expenses'): ?>	
	<div class="col-xl-4">			
		<div class="m-portlet m-portlet--bordered-semi m-portlet--half-height m-portlet--fit ">
			<div class="m-portlet__head" style="position: absolute;opacity: 6;z-index: 2;">
				<div class="m-portlet__head-caption">					
					<div class="m-portlet__head-title">						
						<h3 class="m-portlet__head-text"><?php echo $titalarr[$val['filed_name']]; ?> : <?php echo $val['actual']; ?></h3>
					</div>
					<div class="comparebox">					
						<button type="button" data_title="<?php echo $titalarr[$val['filed_name']]; ?>" data_canvas_id="fincialchart" class="btn btn-success compare_chart">Compare</button>
					</div>
				</div>					
			</div>
			<div class="m-widget20__chart" style="height:160px;display:none;" id="fincialchart_bar">
				<canvas class="getidinchart" data_barchart='<?php echo base64_encode(json_encode(($barchart ? $barchart[$val['filed_name']] : ''))); ?>' data_val='<?php echo base64_encode(json_encode($chartdataarr[$val['filed_name']])); ?>' id="m_chart_bandwidth_capital" data_color_code="<?php echo $val['color']; ?>"></canvas>
			</div>
			<div class="m-portlet__body" id="fincialchart" style="height:250px; margin: 0 auto" data_barchart='<?php echo base64_encode(json_encode(($barchart ? $barchart[$val['filed_name']] : ''))); ?>' data_actual="<?php echo $val['actual']; ?>" data_goal="<?php echo $val['goal']; ?>" data_val='<?php echo base64_encode(json_encode($chartdataarr[$val['filed_name']])); ?>' data_color_code="<?php echo $val['color']; ?>"></div>
		</div>
	</div>
	<?php endif; ?>
	<?php endforeach; ?>
</div>