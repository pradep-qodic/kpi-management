<?php 
	if($headoffice){
		$titalarr=array(
			"c_s_occupancy"=>"Occupancy",
			"c_s_complaints"=>"Complaints",
			"c_s_on_waiting_list"=>"Waiting List",
			"c_s_client_satisfaction"=>"Client Satisfaction",
			// "c_s_family_satisfaction"=>"Family Satisfaction",
			"c_s_friends"=>"Friends",
			"c_s_volunteer_hours"=>"Volunteer Hours",
			"c_s_facebook_page_lkes"=>"Facebook Page Likes"
		);
	}else{
		$titalarr=array(
			"c_s_occupancy"=>"Occupancy",
			"c_s_complaints"=>"Complaints",
			"c_s_on_waiting_list"=>"Waiting List",
			"c_s_client_satisfaction"=>"Client Satisfaction",
			// "c_s_family_satisfaction"=>"Family Satisfaction",
			"c_s_friends"=>"Friends",
			"c_s_volunteer_hours"=>"Volunteer Hours",
			//"c_s_facebook_page_lkes"=>"Facebook Page Likes"
		);
	}
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
					<?php if($val['filed_name']=='c_s_occupancy' || $val['filed_name']=='c_s_client_satisfaction'): ?>
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