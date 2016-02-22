<?php
if(isset($_POST['add'])) {
	$status = add_student_to_class($_POST['id'],$_POST['student']);
}

if(isset($_POST['unassign'])) {
	unassign_student($_POST['id']);
}

if(isset($_GET['assign'])) {
	$result = get_section_info($_GET['assign']);
	$result = $result[0];
	$result_teacher = get_user_info($result['adviser'])[0];	
}
?>

<input type='button' value='BACK' onclick='window.location = "?page=dashboard&view=class"'/>
<br><br>
<h1> Class Management <br>
<b>Section:</b> <?php echo $result['name'].' - '.to_level($result['year_level']); ?><br>
<b>Adviser:</b> <?php echo $result_teacher['l_name'].', '.$result_teacher['f_name']; ?></h1>

<form method='post'>
<input type='hidden' name='id' value='<?php echo $result['id']; ?>'/>

<b>Student List</b><br/>
<table>
<tr>
	<th></th>
	<th>ID</th>
	<th>Last Name</th>
	<th>First Name</th>
	<th>Middle Initial</th>
	<th>User Name</th>
	<th></th>
</tr>
<?php
	$result_students_in_subject = list_students_in_section($_GET['assign']);

	if($result_students_in_subject != null) {
		$x = 1;
		foreach($result_students_in_subject as $row) {
		?>
			<tr>
				<td><?php echo $x; ?></td>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['l_name']; ?></td>
				<td><?php echo $row['f_name']; ?></td>
				<td><?php echo $row['m_name']; ?></td>
				<td><?php echo $row['username']; ?></td>
				<td>
				<form method='POST'>
					<input type='hidden' value='<?php echo $row['id']; ?>' name='id'/>
					<input type='submit' value='Unassign' name='unassign'/>
				</form>
				</td>
			</tr>
		<?php
		$x++;
		}
	}
?>
</table>

<?php
	$result_students = list_available_student($result['id']);
		
	if($result_students != null) {
	
?>
Available Students<br/>

<select name='student'>
	<?php 
		if($result_students != null) {
			$x = 1;
			foreach($result_students as $row) {
			?>
				<option value=<?php echo $row['id'];?>><?php echo $row['l_name'].', '.$row['f_name']; ?></option>
			<?php
			}
		}
	?>
</select>	
<?php

if(isset($_POST['add'])) {
	if($status) {
		echo "<font color='green'>Add Successful</font><br>";
	}
}

?>
<input type='submit' name='add' value='ADD'/>
<?php
} else {
?>
<br/><br/>	
<font color='red'>No Available Students To Be Added</font><br/>
<?php
}
?>
</form>