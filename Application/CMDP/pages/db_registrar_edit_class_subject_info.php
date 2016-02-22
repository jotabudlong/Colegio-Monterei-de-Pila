<?php
if(isset($_POST['save']) && $_POST['name'] != '') {

	$subjects = array();

	for($x = 0; $x < sizeof($_POST['subjects']);$x++) {
		$subject = new Subject;
		$subject->id = $_POST['ids'][$x];
		$subject->name = $_POST['subjects'][$x];
		$subject->teacher = $_POST['teachers'][$x];
		array_push($subjects,$subject);
	}

	$status = save_section_class($_POST['id'], $_POST['name'],$_POST['year_level'],$_POST['school_year'],$_POST['teacher_adviser'],$subjects);
}

if(isset($_GET['edit'])) {
	$result = get_section_info($_GET['edit']);
	$result = $result[0];
	$result_teacher = get_user_info($result['adviser'])[0];
	
	$result_teacher_list = searh_teacher('');
	
	$result_subject_list = get_subjects_from_section($result['id']);
}

$result_teacher = searh_teacher('');
?>

<input type='button' value='BACK' onclick='window.location = "?page=dashboard&view=class"'/>
<br><br><br>
<h1>Edit Section Information</h1>

<form method='post'>
<input type='hidden' name='id' value='<?php echo $result['id']; ?>'/>
Section Name<br/>
<input type='text' name='name' placeholder='Section Name' value='<?php echo $result['name']; ?>'/> <?php echo isset($_POST['name']) && $_POST['name']=='' ? '<font color="red">required!</font>' : '' ?><br/>
Level<br/>
<select name='year_level'>
	<?php for($x = 1; $x <= 10;$x++) {?>
		<option value=<?php echo $x; ?> <?php echo $result['year_level']==$x ? 'selected' : '' ?>>Grade <?php echo $x; ?></option>
	<?php } ?>
</select><br>
School Year<br/>
<select name='school_year'>
	<?php for($x = date("Y")-1; $x <= date("Y")+1;$x++) {?>
		<option value=<?php echo $x; ?> <?php echo $result['school_year']==$x ? 'selected' : '' ?>><?php echo $x.' - '.($x+1); ?></option>
	<?php } ?>
</select><br>
Adviser<br/>
<select name='teacher_adviser'>
	<?php
		if($result_teacher != null) {
			foreach($result_teacher as $row) {
			?>
				<option value=<?php echo $row['id'];?> <?php echo $result['adviser']==$row['id'] ? 'selected' : '' ?>><?php echo $row['l_name'].', '.$row['f_name']; ?></option>
			<?php
			}
		}
	?>
</select><br/><br/>
Subjects<br/>

<script>
function addMore() {
	var teacher_list = "<select name='teachers[]'  placeholder='Subject Name'>"
	<?php 
		if($result_teacher != null) {
			foreach($result_teacher as $row) {
			?>
				+"<option value=<?php echo $row['id'];?>><?php echo $row['l_name'].', '.$row['f_name']; ?></option>"
			<?php
			}
		}
	?>
	+"</select>";

	var div = document.createElement('div');
	div.innerHTML = "<input type='text' name='subjects[]'> "+teacher_list;
	document.getElementById('subj').appendChild(div	);
}
</script>
<dir id='subj'>
	<?php
	if($result_subject_list != null) {
		foreach($result_subject_list as $row_sub) {
	?>
					<input type='hidden' name='ids[]' value='<?php echo $row_sub['id']; ?>'/>
					<input type='text' name='subjects[]' placeholder='Subject Name' value='<?php echo $row_sub['name']; ?>'/>
					<select name='teachers[]'>
					<?php 
						if($result_teacher != null) {
							foreach($result_teacher as $row) {
							?>
								<option value=<?php echo $row['id'];?> <?php echo $row_sub['teacher']==$row['id'] ? 'selected' : '' ?>><?php echo $row['l_name'].', '.$row['f_name']; ?></option>
							<?php
							}
						}
					?>
					</select>
					<br/>
	<?php
				}
		}
	?>
</dir>
<br/><br><br>	
<?php
if(isset($_POST['save'])) {
	if(isset($status) && $status) {
		echo "<font color='green'>Save Successful</font><br>";
	}
}

?>
<input type='submit' name='save' value='Save'/>

</form>