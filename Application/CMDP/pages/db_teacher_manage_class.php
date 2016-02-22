<?php
$min_grade = 60;
$max_grade = 100;


if(isset($_POST['save'])) {
	$status = save_grades($_GET['manage'],$_POST['student'],$_POST['q1'],$_POST['q2'],$_POST['q3'],$_POST['q4'],$_POST['remarks']);
}
?>

<br>
<table width=100%>
	<tr>
		<th>Last Name</th>
		<th>First Name</th>
		<th>Q1</th>
		<th>Q2</th>
		<th>Q3</th>
		<th>Q4</th>
		<th></th>
		<th></th>
	<tr>
	<?php
	if(isset($_GET["manage"])) {
		$result = list_students_in_subject($_GET["manage"]);
			if($result != null) {
			
				foreach($result as $row) {
					$grade_result = get_grades($_GET["manage"],$row['id']);
					$row_grade = $grade_result[0];
				?>
					<tr>	
						<td><?php echo $row['l_name']; ?></td>
						<td><?php echo $row['f_name']; ?></td>
						
						
						<form method='post'>
						
						<td><select name='q1'>
						<option value='-1'  selected <?php if($row_grade['grade_1']==-1) { echo "selected";} ?>>--none--</option>
						<?php for($x=$min_grade;$x<=$max_grade;$x++) { ?> 
						<option value='<?php echo $x; ?>' <?php if($row_grade['grade_1']==$x) { echo "selected";} ?>><?php echo $x; ?></option> <?php } ?></select></td>
						
						<td><select name='q2'>
						<option value='-1' <?php if($row_grade['grade_2']==-1) { echo "selected";} ?>>--none--</option>
						<?php for($x=$min_grade;$x<=$max_grade;$x++) { ?> 
						<option value='<?php echo $x; ?>' <?php if($row_grade['grade_2']==$x) { echo "selected";} ?>><?php echo $x; ?></option> <?php } ?></select></td>
						
						<td><select name='q3'>
						<option value='-1' <?php if($row_grade['grade_3']==-1) { echo "selected";} ?>>--none--</option>
						<?php for($x=$min_grade;$x<=$max_grade;$x++) { ?> 
						<option value='<?php echo $x; ?>' <?php if($row_grade['grade_3']==$x) { echo "selected";} ?>><?php echo $x; ?></option> <?php } ?></select></td>
						
						<td><select name='q4'>
						<option value='-1' <?php if($row_grade['grade_4']==-1) { echo "selected";} ?>>--none--</option>
						<?php for($x=$min_grade;$x<=$max_grade;$x++) { ?> 
						<option value='<?php echo $x; ?>' <?php if($row_grade['grade_4']==$x) { echo "selected";} ?>><?php echo $x; ?></option> <?php } ?></select></td>
						<td>
						<input type='text' name='remarks' placeholder='Remarks' value='<?php echo $row_grade['remarks']; ?>'/>
						</td>
						<td>
						<input type='hidden' name='student' value='<?php echo $row['id']; ?>'/>
						<input type='submit' value='SAVE' name='save'/>
						</td>

						</form>
						
					</tr>
				<?php
				}
			} else {
				?>
				<tr>	
					<td colspan=8>No students</td>
				</tr>
				<?php
			}
		}
	?>
</table>