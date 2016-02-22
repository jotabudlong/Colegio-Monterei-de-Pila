<?php
if(isset($_POST['save']) && $_POST['f_name'] != '' && $_POST['l_name'] != '' && $_POST['m_name'] != '' && $_POST['username'] != '') {
	$status = save_user($_POST['id'],$_POST['f_name'],$_POST['l_name'],$_POST['m_name'],$_POST['type'],$_POST['username'],$_POST['password']);
}

if(isset($_GET['edit'])) {
	$result = get_user_info($_GET['edit']);
	$result = $result[0];
}
?>

<input type='button' value='BACK' onclick='window.location = "?page=dashboard&view=users"'/>
<br><br><br>
<h1>User Information</h1>

<form method='post' autocomplete='off'>
User Type<br/>
<select name='type'>
	<option value='1'<?php if($result['type']==1) { echo "selected";} ?>>Admin</option>
	<option value='2'<?php if($result['type']==2) { echo "selected";} ?>>Student</option>
	<option value='3'<?php if($result['type']==3) { echo "selected";} ?>>Teacher</option>
	<option value='4'<?php if($result['type']==4) { echo "selected";} ?>>Registrar</option>
</select><br/>
<input type='hidden' name='id' value='<?php echo $result['id']; ?>'/> 
First Name<br/>
<input type='text' name='f_name' value='<?php echo $result['f_name']; ?>'/> <?php echo isset($_POST['f_name']) && $_POST['f_name']=='' ? '<font color="red">required!</font>' : '' ?><br>
Last Name<br/>
<input type='text' name='l_name' value='<?php echo $result['l_name']; ?>'/> <?php echo isset($_POST['l_name']) && $_POST['l_name']=='' ? '<font color="red">required!</font>' : '' ?><br/>
Middle Initial<br/>
<input type='text' name='m_name' maxlength=3 size=3 value='<?php echo $result['m_name']; ?>'/> <?php echo isset($_POST['m_name']) && $_POST['m_name']=='' ? '<font color="red">required!</font>' : '' ?><br/>
Username<br/>
<input type='text' name='username' value='<?php echo $result['username']; ?>' autocomplete='off'/> <?php echo isset($_POST['username']) && $_POST['username']=='' ? '<font color="red">required!</font>' : '' ?><br>
New Password <i>*Leave it blank if no change*</i><br/>
<input type='password' name='password' autocomplete='off'/> 
<?php if(isset($_POST['password']) && $_POST['password'] != '') {
	echo isset($_POST['password']) && strlen($_POST['password']) < 5 ? '<font color="red">Password must be a minimum of 5 characters!</font>' : '';
}?>

<br><br>	
<?php
if(isset($_POST['save'])) {
	if(isset($status) && $status) {
		echo "<font color='green'>Save Successful</font><br>";
	}
}

?>
<input type='submit' name='save' value='SAVE'/>

</form>