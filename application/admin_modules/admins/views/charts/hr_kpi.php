<?php $titalarr=array(
				"hr_incidents"=>"Incidents",
				"hr_near_misses"=>"Near Misses",
				"hr_loss_time_injury_hours"=>"Loss Time Injury (Hours)",
				"hr_active_workers_compensation_claims"=>"Active Worker's Comp Claims",
				"hr_new_workers_compensation_claims"=>"New Worker's Comp Claims",
				"hr_annual_satisfaction"=>"Annual Satisfaction",
				"hr_complaints"=>"Complaints",
				"hr_involuntary_terminations"=>"Involuntary Terminations",
				"hr_active_ir_claims"=>"Active IR Claims"
			) 
?>
<div class="row" id="setChart">
	<?php foreach($finalarray as $key=>$val): ?>	
	<?php if(array_key_exists($val['filed_name'],$titalarr)):?>
	<div class="col-xl-4">			
		<div class="m-portlet m-portlet--bordered-semi m-portlet--half-height m-portlet--fit " style="min-height: 300px">
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
					<?php if($val['filed_name']=='hr_annual_satisfaction'): ?>
						<div class="m-widget20__number actualsize" data_filed_name="<?php echo $titalarr[$val['filed_name']]; ?>" style="color:<?php echo $val['color']; ?>"><?php echo $val['actual'] .'&nbsp;%'; ?></div>					
						<div class="m-widget20__number goalsize" data_filed_name="<?php echo $titalarr[$val['filed_name']]; ?>" style="color:<?php echo $val['color']; ?>">Goal :&nbsp;&nbsp;<?php echo $val['goal'] .'&nbsp;%'; ?></div>
					<?php else: ?>
						<div class="m-widget20__number actualsize" data_filed_name="<?php echo $titalarr[$val['filed_name']]; ?>" style="color:<?php echo $val['color']; ?>"><?php echo number_format_val($val['actual']); ?></div>					
						<div class="m-widget20__number goalsize"  data_filed_name="<?php echo $titalarr[$val['filed_name']]; ?>" style="color:<?php echo $val['color']; ?>">Goal :&nbsp;&nbsp;<?php echo number_format_val($val['goal']); ?></div>
					<?php endif; ?>	
					<div class="m-widget20__chart" style="height:160px;">
						<canvas class="getidinchart" data_barchart='<?php echo base64_encode(json_encode(($barchart ? $barchart[$val['filed_name']] : ''))); ?>' data_val='<?php echo base64_encode(json_encode($chartdataarr[$val['filed_name']])); ?>' id="m_chart_bandwidth_<?php echo $key; ?>" data_color_code="<?php echo $val['color']; ?>"></canvas>
					</div>
				</div>					
			</div>
		</div>
	</div>		
	<?php endif; ?>
	<?php endforeach; ?>
</div>