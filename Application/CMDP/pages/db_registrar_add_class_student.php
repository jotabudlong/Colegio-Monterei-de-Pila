	<?php
if(isset($_POST['add']) && $_POST['f_name'] != '' && $_POST['l_name'] != '' && $_POST['m_name'] != '') {
	$status = add_user($_POST['f_name'],$_POST['l_name'],$_POST['m_name'],$_POST['type']);
}

if(isset($_GET['edit'])) {
	$result = get_user_info($_GET['edit']);
	$result = $result[0];
}
?>	

<input type='button' value='BACK' onclick='window.location = "?page=dashboard&view=class"'/>
<br><br><br>
<h1>User Information</h1>

<form method='post' autocomplete='off'>
User Type<br/>
<select name='type'>
	<option value='2'>Student</option>
	<option value='3'>Teacher</option>
</select><br/>
First Name<br/>
<input type='text' name='f_name'/> <?php echo isset($_POST['f_name']) && $_POST['f_name']=='' ? '<font color="red">required!</font>' : '' ?><br>
Last Name<br/>
<input type='text' name='l_name'/> <?php echo isset($_POST['l_name']) && $_POST['l_name']=='' ? '<font color="red">required!</font>' : '' ?><br/>
Middle Initial<br/>
<input type='text' name='m_name' maxlength="2" size=2/> <?php echo isset($_POST['m_name']) && $_POST['m_name']=='' ? '<font color="red">required!</font>' : '' ?><br>
<br>
<?php
if(isset($_POST['save'])) {
	if(isset($status) && $status) {
		echo "<font color='green'>Add Successful</font><br><br>";
	}
}

?>

<input type='submit' name='add' value='Add'/>

</form>

</br>


<b>Note:</b></br>
Default username is (last_name)(middle_initial)_(f_name)</br>
Default password is (last_name)
<br><br>
<b>Example:</b></br>
First Name: Pedro<br>Last Name: San Juan<br>Middle Initial: P<br><br>
Username: sanjuanp_pedro<br>
Password: sanjuan



<br><br>