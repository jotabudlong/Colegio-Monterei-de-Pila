<input type='button' value='Add Section' onclick='window.location = "?page=dashboard&view=class&add";'/>
<input type='button' value='Add Student/Teacher' onclick='window.location = "?page=dashboard&view=class&add_student";'/>
<br><br><br>

<form method='post'>
	<input type='text' name='search' size='50'>
	<select name='year_level'>
		<option value=0 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 0 ? "selected" : '' ?>>Any</option>
		<option value=1 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 1 ? "selected" : '' ?>>Grade 1</option>
		<option value=2 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 2 ? "selected" : '' ?>>Grade 2</option>
		<option value=3 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 3 ? "selected" : '' ?>>Grade 3</option>
		<option value=4 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 4 ? "selected" : '' ?>>Grade 4</option>
		<option value=5 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 5 ? "selected" : '' ?>>Grade 5</option>
		<option value=6 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 6 ? "selected" : '' ?>>Grade 6</option>
		<option value=7 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 7 ? "selected" : '' ?>>Grade 7</option>
		<option value=8 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 8 ? "selected" : '' ?>>Grade 8</option>
		<option value=9 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 9 ? "selected" : '' ?>>Grade 9</option>
		<option value=10 <?php echo isset($_POST['year_level']) && $_POST['year_level'] == 10 ? "selected" : '' ?>>Grade 10</option>
	</select>
	<select name='teacher'>
		<option value=-1 <?php echo isset($_POST['teacher']) && $_POST['teacher'] == -1 ? "selected" : '' ?>>Any</option>
		<?php 
		$result_teacher = searh_teacher('');
			if($result_teacher != null) {
				foreach($result_teacher as $row) {
				?>
					<option value=<?php echo $row['id'];?> <?php echo isset($_POST['teacher']) && $_POST['teacher'] == $row['id'] ? "selected" : '' ?>><?php echo $row['l_name'].', '.$row['f_name']; ?></option>
				<?php
				}
			}
		?>
	</select>
	<input type='submit' value='Search'>
	
</form>
<br><br>
<table width=100%>
	<tr>
		<th>Section ID</th>
		<th>Section Name</th>
		<th></th>
	<tr>
	<?php
		if(isset($_POST['search'])) {
			$result = searh_section($_POST['search'],$_POST['year_level']);
			
				if($result != null) {
					foreach($result as $row) {
					?>
					<tr>	
						<!--<td><?php //echo $row['id']; ?></td>-->
						<td><?php echo $row['name']; ?></td>
						<td>
							<input type='button' value='Assign Students' onclick='window.location = "<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&assign=$row[id]"; ?>";'/>
							<input type='button' value='Edit Section' onclick='window.location = "<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&edit=$row[id]"; ?>";'/>
						</td>
					</tr>
					<?php
					}
				} else {
					?>
					<tr>
						<!--<td></td>-->
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
	<?php
		}
	?>
</table>