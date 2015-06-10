<?php 

	if(validation_errors()){
		echo validation_errors();
	}
?>
<form action="" method="post">
<p>
	<label>Name</label>
	<input type="text" name="t_menunane" value=""><br/>
</p>

<p>
	<label>Order</label>
	<select name="type">
			<option value="1">System Admin</option>
			<option value="2">Business Admin</option>
			<option value="3">Employee</option>
	</select>
</p>
<p>
	<label>Url</label>
	<input type="text" name="t_url" placeholder="without basse url"><br/>
</p>

	<input type="submit" name="submit" value="create">
</form>