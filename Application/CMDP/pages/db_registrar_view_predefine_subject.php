<?php

?>


<?php
for($x = 1; $x <= 10; $x++) {
	echo "<h1>Grade $x <input type='button'  onclick='window.location = \"?page=dashboard&view=predefine_subject&manage=$x\";' value='Manage'/></h1>";
	$predefine_subjects = list_predefine_subjects($x);
	
	if($predefine_subjects != null) {
		echo "<table>";
		echo "<tr>
				<th>Subject Name</th>
			  </tr>";
		foreach($predefine_subjects as $row) {
?>
			<tr>
				<td><?php echo $row['name'];?></td>
			</tr>
<?php
		}
		echo "</table>";
	} else {
		echo "<font color='red'>No Predefined Subjects</font>";
	}
	echo "<br><br>";
}
?>