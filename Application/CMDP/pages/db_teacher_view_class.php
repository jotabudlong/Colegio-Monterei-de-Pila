<br><br>
<table width=100%>
	<tr>
		<th colspan=3>Sections</th>
	<tr>
	<?php
	if($_SESSION["account_type"]==1) {
		$result = list_teacher_sections(-1);
	} else {
		$result = list_teacher_sections($_SESSION["account_id"]);
	}
		if($result != null) {
			foreach($result as $row) {
			?>
				<tr>	
					<th class='subth'><?php echo $row['name']; ?></th>
					<th class='subth'>Year Level - <?php echo $row['year_level']; ?></th>
					<th class='subth'></th>
				</tr>
			<?php
				if($_SESSION["account_type"]==1) {
					$subjec_result = search_subject_for_teacher_per_section(-1,$row['id']);
				} else {
					$subjec_result = search_subject_for_teacher_per_section($_SESSION["account_id"],$row['id']);
				}
				if($subjec_result != null) {
					foreach($subjec_result as $row_subject) {
			?>
						<tr>	
							<td  colspan=2>Subject: <b><?php echo $row_subject['subject_name']; ?></b>
							<?php if($_SESSION["account_type"]==1) { ?>
							<br>Teacher: <b><?php
							$t = get_user_info($row_subject['teacher'])[0];
							echo $t['f_name'].' '.$t['m_name'].'. '.$t['l_name']; ?></b></td>
							<?php } ?>
							<td><a href='<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&manage=$row_subject[subject_id]"; ?>'>[MANAGE CLASS]</a></td>
						</tr>
			<?php
					}
				} else {
			?>
				<tr>	
					<td colspan=5>No subjects in this class</td>
				</tr>
			<?php
				}
			}
		} else {
			?>
			<tr>	
				<td colspan=5>No sections</td>
			</tr>
			<?php
		}
	?>
</table>