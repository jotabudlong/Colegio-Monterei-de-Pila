<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>


<?php
$school_years_result = list_student_school_years($_SESSION["account_id"]);
$user_result = get_user($_SESSION["account_id"]);
$user_result = $user_result[0];



if(isset($_GET['section'])) {
	$section_result = get_section_info($_GET['section'])[0];
	$section_grade_result = get_student_section_grades($user_result["stud_id"],$_GET['section']);
} else {
	$section_result = get_section_info($user_result['section'])[0];
	$section_grade_result = get_student_section_grades($user_result["stud_id"],$user_result['section']);
}
?>
<br>
Grade Archive
<ul>
<?php
if($school_years_result != null) {
	foreach($school_years_result as $row) {
?>
		<li><b><?php echo $row['school_year'].' - '.($row['school_year']+1); ?></b></li>
		<ul>
		<?php
			$section_ids_result = list_student_sections($_SESSION["account_id"]);
			if($section_ids_result != null) {
				foreach($section_ids_result as $row2) {
					if($row2['school_year']==$row['school_year']) {
						echo "<li><a href='?page=dashboard&section=$row2[section]'>$row2[name] - Grade $row2[year_level]</a></li>";
					}
				}
			}
?>
		</ul>
<?php
	}
}
?>
</ul>
<br>
<br>
<div id='grades'> <!-- Printable -->
	<i>Unofficial Copy of Grades</i></br>
	Name: <b><?php echo $user_result['f_name']." ".$user_result['m_name']." ".$user_result['l_name']; ?></b><br/>
	Section: <b><?php echo $section_result['name']." - ".to_level($section_result['year_level']); ?></b><br/>
	School Year: <b><?php echo $section_result['school_year'].' - '.($section_result['school_year']+1); ?><b/>
	<table width=100%>
		<tr>
			<th>Subject</th>
			<th>First Quarter</th>
			<th>Second Quarter</th>
			<th>Third Quarter</th>
			<th>Fourth Quarter</th>
			<th>Remarks</th>
		<tr>
		<?php
				if($section_grade_result != null) {
					foreach($section_grade_result as $row) {
					?>
						<tr>	
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['grade_1']==-1 ? '' : $row['grade_1']; ?></td>
							<td><?php echo $row['grade_2']==-1 ? '' : $row['grade_2']; ?></td>
							<td><?php echo $row['grade_3']==-1 ? '' : $row['grade_3']; ?></td>
							<td><?php echo $row['grade_4']==-1 ? '' : $row['grade_4']; ?></td>
							<td><?php echo $row['remarks']; ?></td>
							
						</tr>
					<?php
					}
				} else {
					?>
					<tr>	
						<td colspan=8>No grades</td>
					</tr>
					<?php
				}
		?>
	</table>
	
	<i>
	*Disclaimer: This document is for general information purposes <b>ONLY</b>. This is not an official copy of report card. If you need a certified copy of report card please secure a copy of grades from our school registrar.
	</i>
</div> <!-- Printable -->
<input type='button' value='PRINT' onclick="printContent('grades')"/>