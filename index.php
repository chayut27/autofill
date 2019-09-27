<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>AutoFill</title>
</head>

<body>

<form id="frm1" action="#" method="POST">
<label>Customer ID</label>
<input type="text" id="cus_id" name="cus_id">
<ul style="display:none;">

</ul>
<br>
<br>
<label>Customer Name</label>
<input type="text" id="cus_name" name="cus_name">
<br>
<br>
<label>Customer Email</label>
<input type="text" id="cus_email" name="cus_email">
<br>
<br>
</form>

<div class="show_error">
</div>



<script src="jquery-3.4.1.min.js"></script>
<script>
$("#cus_id").keyup(function(){
	var cus_id = $(this).val();
	
	var form_data = new FormData();
	form_data.append("cus_id",cus_id);
	$.ajax({
		url: "process.php",
		data: form_data,
		type: "POST",
		dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
		success:function(result){
			var text = "";
			if(result["data"]){
				$(".show_error").text("");
				$("ul").css("display","block");
				
				
				
				for(key in result["data"]){
					text += '<li class="list_cus_id">';
					text += ''+result["data"][key]["cus_id"]+'';
					text += '</li>';
				}
				
				$("body").on('click', ".list_cus_id", function() {
	
					$("#cus_id").val($(this).text());
					if($("#cus_id").val() == result["data"][key]["cus_id"]){
						$("#cus_name").val(result["data"][key]["name"]);
						$("#cus_email").val(result["data"][key]["email"]);
					}
					
					$("ul").css("display","none");
					
					
				})
								
				
				$("ul").html(text);
				
			}else{
				$(".show_error").text("ไม่พบข้อมูล");
				// $("#cus_name").val("");
				// $("#cus_email").val("");
				$("ul").css("display","none");
			}
		}

	})
})




</script>
</body>

</html>