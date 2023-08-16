<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="http://code.jquery.com/jquery-latest.js"></script> 
	<script type="text/javascript"> 
	$(document) .ready(function(){ 
		$('.chkbx') .click(function(){ 
			var text= ""; 
			$('.chkbx:checked').each(function(){ 
				text+=$(this) .val() + ','; 
			}); 
			text=text.substring(0,text.length-1); 
			$('#selectedtext') .val(text); 
			var count = $("[type=' checkbox']:checked") .length; 
			$('#count').val($("[type='checkbox'] :checked") .length); 
		}); 
	}); 
</script>
</head>
<body>

<table>
	<tr>
		<td><input type="Checkbox" name="" value="AW" class="chkbx"></td>
		<td>awaw</td>
		<td>awaw</td>
	</tr>
	<tr>
		<td><input type="Checkbox" name="" value="WE" class="chkbx"></td>
		<td>wewe</td>
		<td>wewe</td>
	</tr>
</table>


<textarea type='text' id='selectedtext' placeholder="Selected Checkboxs"></textarea></br> 
<input type='text' id=' count' placeholder="Number Of Selected Checkboxs">
</body>
</html>