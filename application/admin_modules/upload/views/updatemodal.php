<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo admin_base_url();?>themes/admin/css/styleUpload.css" type="text/css" />

<script src="<?php echo admin_base_url();?>themes/admin/js/jquery-2.1.1.js"></script>
<script src="<?php echo admin_base_url();?>themes/admin/js/jquery.cropit.min.js"></script>
<style>
    body { padding-top:0!important; }
    .cropit-image-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 5px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 250px;
        height: 250px;
        cursor: move;
        margin-left: 60px;
    }

    .cropit-image-background {
        opacity: .2;
        cursor: auto;
    }

    .image-size-label {
        margin-top: 10px;
    }

    input {
        /* Use relative position to prevent from being covered by image background */
        position: relative;
        z-index: 10;
        display: block;
    }

    .export {
        margin-top: 10px;
    }

    .upload_photo_home {
        background: #FF551F none repeat scroll 0 0;
        border: 0 none;
        border-radius: 4px;
        color: #fff;
        cursor: pointer;
        padding: 6px 0;
        position: relative;
        text-align: center;
        z-index: 1111;
    }

    .upload_photo_home [type="file"] {
        bottom: 0;
        cursor: pointer;
        height: 100% !important;
        left: 0;
        margin: 0;
        opacity: 0;
        padding-bottom: 0;
        padding-left: 0 !important;
        padding-right: 0;
        padding-top: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%;
        z-index: 9999;
    }

    .cropit-image-preview.cropit-image-loaded {
        border-radius: 50%;
        overflow: hidden;
    }

    /*.cropit-image-background-container {
        left: 45px !important;
    }
    .range-bar {
      margin: 20px 0;
    }

    .customRange {
        float: left;
        margin: 5px 20px !important;
        width: 240px !important;
    }*/

    input[type=range] {
        -webkit-appearance: none;
    }
    input[type=range]:focus {
        outline: none;
    }
    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 6px;
        cursor: pointer;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        background: #ffffff;
        border-radius: 1.3px;
        border: 0.2px solid #010101;
        margin-top: 5px;
    }
    input[type=range]::-webkit-slider-thumb {
        border: 1px solid #000000;
        height: 24px;
        width: 21px;
        border-radius: 50px;
        background: #9b9a9a;
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -8px;
    }
    input[type=range]:focus::-webkit-slider-runnable-track {
        background: #0d0d0d;
    }
    input[type=range]::-moz-range-track {
        width: 100%;
        height: 2px;
        cursor: pointer;
        background: #ffffff;
        border-radius: 1.3px;
        border: 0.2px solid #010101;
    }
    input[type=range]::-moz-range-thumb {
        border: 1px solid #000000;
        height: 24px;
        width: 21px;
        border-radius: 50px;
        background: #9b9a9a;
        cursor: pointer;
    }
</style>
<div class="container" style="top: 0;">
	<div class="alert alert-success alert-dismissible" role="alert"	id="alertUpdateSuccess" style="display: none;">
		<button type="button" class="close" data-dismiss="alert">
			<span aria-hidden="true">&times;</span><span class="sr-only"></span>
		</button>
		<strong>Success !!!</strong> <span id="sUpdateMsg"></span>
	</div>
	<div class="alert alert-warning alert-dismissible" role="alert"	id="alertUpdateError" style="display: none;">
		<button type="button" class="close" data-dismiss="alert">
			<span aria-hidden="true">&times;</span><span class="sr-only"></span>
		</button>
		<strong>Oops�</strong> <span id="eUpdateMsg"></span>
	</div>
	<div class="image-editor">

		<!-- .cropit-image-preview-container is needed for background image to work -->
		<div class="cropit-image-preview-container">
			<div class="cropit-image-preview"></div>
		</div>

		<div class="range-bar">
			<span class="fa fa-minus-circle fa-2x pull-left" style="margin: 0; color: #aaaaaa;"></span><input type="range" class="inline cropit-image-zoom-input customRange"><span class="fa fa-plus-circle fa-2x pull-left" style="margin: 0; color: #aaaaaa;"></span>
			<div style="clear: both;"></div>
		</div>

		<div class="left-side">
			<div class="upload_photo_home font-Omnes-Medium">
				<div class="cursor_p">Select Photo</div>
				<input type="file" class="cropit-image-input" accept="image/png, image/jpeg">
			</div>
		</div>
		<div class="right-side">
			<button class="btn btn-primary" id="btnUpdateCropAndUpload" style="background-color: #74adda; width: 100%; border: none;">
				Crop & Upload <i class="fa fa-spin fa-spinner" id="uploadUpdateCollectionLoader" style="display: none;"></i>
			</button>
		</div>
	</div>
	<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>"/>
	<input type="hidden" name="imgName" id="imgName" value="<?php echo $modalImages;?>"/>
	
</div>
</div>
<link href="<?php echo admin_base_url('themes/admin/css/bootstrap.min.css');?>" rel="stylesheet">
<script src="<?php echo admin_base_url();?>/themes/admin/js/bootstrap.min.js"></script>

<script type="text/javascript">
  $(function() {
	var url=$('#base_url').val();
	var imgName=$('#imgName').val();	
    $('.image-editor').cropit({
      originalSize: true,
      imageBackground: true,
      imageBackgroundBorderWidth: 20,
      allowDragNDrop:true,
      imageState: {
        src: url+'uploads/adminLogo/'+imgName
      }
    });

    $('#btnUpdateCropAndUpload').click(function() {
      var imageData = $('.image-editor').cropit('export');
      uploadUpdateModalData(imageData);
    });
  });

    
    function uploadUpdateModalData(imageData){
    	$("#btnUpdateCropAndUpload").prop('disabled',true);
        $('#uploadUpdateCollectionLoader').fadeIn();
        $p=parent.window.$;
        var colId=$p("#collectionId").val();
		var url=$('#base_url').val();
		 $('.image-editor').cropit('disable');
		var img=imageData;
		
		$.ajax({
	        type:"post",
			dataType:'json',
	        data:{imageData:img,collectionId:colId},
	        url: url+'upload/updatemodal',
	        success: function(data){
				// console.log(data.data.fileName);
	        	if(data.status=="success"){
	        		$('#uploadUpdateCollectionLoader').fadeOut();
					$("#sUpdateMsg").html(data.message);
					$('.image-editor').cropit('reenable');
	                $('#alertUpdateSuccess').fadeIn().delay(2000).fadeOut(function(){parent.hideUpdateModal(data.data);$("#btnUpdateCropAndUpload").prop('disabled',false);});
					return;
				}
				if(data.status=="error"){
					$("#btnUpdateCropAndUpload").prop('disabled',false);
		            $('#uploadUpdateCollectionLoader').fadeOut();
					$("#eUpdateMsg").html(data.message);
					$('.image-editor').cropit('reenable');
	                $('#alertUpdateError').fadeIn().delay(2000).fadeOut();
					return;
				}
				$("#btnUpdateCropAndUpload").prop('disabled',false);
	            $('#uploadUpdateCollectionLoader').fadeOut();
	            $('.image-editor').cropit('reenable');
	        }
		});	
	}
</script>
