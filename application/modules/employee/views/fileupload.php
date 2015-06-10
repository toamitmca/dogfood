<html>
<head>
<title>Ajax Image Upload </title>
</head>

<script src="<?php echo base_url();?>assects/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assects/js/jquery.wallform.js"></script>
<script>
 $(document).ready(function() { 
		
            $('#photoimg').die('click').live('change', function(){ 
			          //$("#preview").html('');
			   
				$("#imageform111").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
				        $("#imageloadstatus").show();
					 	$("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				    
				    console.log('test');
					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					}, 
					error:function(){ 
					console.log('xtest');
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
					
		
			});
        }); 
</script>

<style>

body
{
font-family:arial;
}

#preview
{
color:#cc0000;
font-size:12px
}
.imgList 
{
max-height:150px;
margin-left:5px;
border:1px solid #dedede;
padding:4px;	
float:left;	
}

</style>
<body>

<div>

<div id='preview'>
</div>
	
<form id="imageform111" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>employee/dashboard/ajaxImageUpload' style="clear:both">
<h1>Upload your images</h1> 
<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="photos[]" id="photoimg" multiple="true" />
</div>
</form>


</div>
</body>
</html>