<input type='button' value='Add User' onclick='window.location = "?page=dashboard&view=users&add";'/>
<br><br><br>

<form method='post'>
	<input type='text' name='search' size='50'><select name='type'>
	<option value='1'<?php if(isset($_POST['type']) && $_POST['type']==1) { echo "selected";} ?>>Admin</option>
	<option value='2'<?php if(isset($_POST['type']) && $_POST['type']==2) { echo "selected";} ?>>Student</option>
	<option value='3'<?php if(isset($_POST['type']) && $_POST['type']==3) { echo "selected";} ?>>Teacher</option>
	<option value='4'<?php if(isset($_POST['type']) && $_POST['type']==4) { echo "selected";} ?>>Registrar</option>
</select><input type='submit' name='submit' value='Search'>
</form><br/>
<form method='post'>
	<input type='hidden' name='search' value=''>
	<input type='submit' name='submit' value='List All Users'>
	<input type='submit' name='submit' value='List All Admin'>
	<input type='submit' name='submit' value='List All Student'>
	<input type='submit' name='submit' value='List All Teacher'>
	<input type='submit' name='submit' value='List All Registrar'>
</form>
<br><br>
<table width=100%>
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Middle Initial</th>
		<th>Username</th>
		<th>Type</th>
		<th></th>
	<tr>
	<?php
		if(isset($_POST['search'])) {
			if($_POST['submit']=='List All Users') {
				$_POST['type'] = -1;
			} elseif($_POST['submit']=='List All Admin') {
				$_POST['type'] = 1;
			} elseif($_POST['submit']=='List All Student') {
				$_POST['type'] = 2;
			} elseif($_POST['submit']=='List All Teacher') {
				$_POST['type'] = 3;
			} elseif($_POST['submit']=='List All Registrar') {
				$_POST['type'] = 4;
			}
			$result = searh_user($_POST['search'],$_POST['type']);
			
				if($result != null) {
					foreach($result as $row) {
					?>
					<tr>
						<!--<td><?php //echo $row['id']; ?></td>-->
						<td><?php echo $row['f_name']; ?></td>
						<td><?php echo $row['l_name']; ?></td>
						<td><?php echo $row['m_name']; ?></td>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo $row['type']==1 ? "Admin" : '';
						echo $row['type']==2 ? "Student" : '';
						echo $row['type']==3 ? "Teacher" : '';
						echo $row['type']==4 ? "Registrar" : '';?></td>
						<td><a href='<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&edit=$row[id]"; ?>'>[EDIT]</a></td>
					</tr>
					<?php
					}
				} else {
					?>
					<tr>
						<!--<td></td>-->
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php
				}
				
		} else {
	?>
		<!--<td></td>-->
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	<?php
		}
	?>
</table>