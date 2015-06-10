		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript">
        function submitForm(){
						var data1 = new FormData();
						$.each($('#file_data')[0].files, function(i, file) {
						data1.append(i, file);
						});
            $.ajax({
              url: "<?php echo base_url() ?>employee/dashboard2/test2",
              type: "POST",
              data:data1,
              enctype: 'multipart/form-data',
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function(data) {
                console.log("PHP Output:");
                console.log(data);
            });
            return false;
        }
    </script>
</head>
<body>
<p onclick="return submitForm(); ">hellodear</p>
<p class="manu tttt"> add daya</p>
    <form method="post"  id="fileinfo" action="" name="fileinfo"  enctype="multipart/form-data">
        <label>Select a file:</label><br>
        <input class="upload_f" type="file" name="file[]" id="file_data" multiple />
        <input type="submit" value="Upload" />
    </form>


<table id="tblDept">
  <tbody >
  </tbody>
</table>


    <div id="output"></div>



<script type="text/javascript">
var i=0;
$(document).ready(function() {

$(document.body).on('click','.tttt',function(){
  alert('hello');
  console.log(i);
  $('#tblDept tbody').append("<tr><td><input type=file name='dept_name_search' class='dept_name' id='dept_name_search_'>");

});
$(document.body).on('change','.dept_name',function(){
  alert('hello');

});

});
</script>
</body>
</html>