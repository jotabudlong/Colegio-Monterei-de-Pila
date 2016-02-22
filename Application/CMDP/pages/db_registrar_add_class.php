<?php
$pre_id = 9999;
$predefine_subjects = list_predefine_subjects(1);

if(isset($_POST['add']) && $_POST['name'] != '') {

	$subjects = array();

	for($x = 0; $x < sizeof($_POST['subjects']);$x++) {
		$subject = new Subject;
		$subject->name = $_POST['subjects'][$x];
		$subject->teacher = $_POST['teachers'][$x];
		array_push($subjects,$subject);
	}

	$status = add_section_class($_POST['name'],$_POST['year_level'],$_POST['school_year'],$_POST['teacher_adviser'],$subjects);
}

if(isset($_GET['edit'])) {
	$result = get_teacher_info($_GET['edit']);
	$result = $result[0];
}

$result_teacher = searh_teacher('');
?>

<input type='button' value='BACK' onclick='window.location = "?page=dashboard&view=class"'/>
<br><br><br>
<h1>Section Information</h1>

<form method='post'>
<input type='hidden' name='id'/>
Section Name<br/>
<input type='text' name='name' placeholder='Section Name'/> <?php echo isset($_POST['name']) && $_POST['name']=='' ? '<font color="red">required!</font>' : '' ?><br/>
Level<br/>
<select name='year_level' onchange='set_predefine_subjects(this)'>
	<?php for($x = 1; $x <= 10;$x++) {?>
		<option value=<?php echo $x; ?>>Grade <?php echo $x; ?></option>
	<?php } ?>
</select><br>
School Year<br/>
<select name='school_year'>
	<?php for($x = date("Y")-1; $x <= date("Y")+1;$x++) {?>
		<option value=<?php echo $x; ?>><?php echo $x.' - '.($x+1); ?></option>
	<?php } ?>
</select><br>
Adviser<br/>
<select name='teacher_adviser'>
	<?php
		if($result_teacher != null) {
			foreach($result_teacher as $row) {
			?>
				<option value=<?php echo $row['id'];?>><?php echo $row['l_name'].', '.$row['f_name']; ?></option>
			<?php
			}
		}
	?>
</select><br/><br/>

<script>
var e_id = 1;

Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = 0, len = this.length; i < len; i++) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}

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
	div.setAttribute("id", e_id);
	div.innerHTML = "<input type='text' name='subjects[]' placeholder='Subject Name'> "+teacher_list+" <input type='button' value='Remove' onclick='remove_element("+e_id+")'>";
	document.getElementById('subj').appendChild(div	);
	e_id++;
}

var pre_id = 7000;
function set_predefine_subjects(sel) {
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

	var year_level = sel.value;
	document.getElementById('subj').remove();
	
	var div = document.createElement('div');
	div.setAttribute("id", "subj");
	switch(year_level) {
		<?php
			for($i = 1; $i <= 10; $i++) {
				echo "case '$i':\n\n";
				$pre_sub = "";
				$ps = list_predefine_subjects($i);
				if($ps != null) {
						foreach($ps as $row) {
							$pre_sub .= "<div id=\"$pre_id\"> <input type=\"text\" name=\"subjects[]\" placeholder=\"Subject Name\" value=\"$row[name]\"> '+teacher_list+' <input type=\"button\" value=\"Remove\" onclick=\"remove_element($pre_id)\"></div>";
							$pre_id++;
						}
				} else {
					$pre_sub .= "<input type=\"text\" name=\"subjects[]\" placeholder=\"Subject Name\" > '+teacher_list+' <input type=\"button\" value=\"Remove\" onclick=\"remove_element($pre_id)\">";
				}
				
				echo "div.innerHTML = '".
				$pre_sub.
				"';"
				;
				echo "\n\nbreak;\n\n";
			}
		?>
	}
	
	document.getElementById('main').appendChild(div);
}

function remove_element(id) {
	document.getElementById(id).remove();
}
</script>


Subjects<br/>
<div id='main'>
<div id='subj'>
	<?php
		$xx=1000;
		if($predefine_subjects != null) {
			foreach($predefine_subjects as $row) {
	?>
	<div id='<?php echo $xx; ?>'>
	<input type='text' name='subjects[]' placeholder='Subject Name' value='<?php echo $row['name'];?>'/> <select name='teachers[]'>
	<?php 
		if($result_teacher != null) {
			foreach($result_teacher as $row) {
			?>
				<option value=<?php echo $row['id'];?>><?php echo $row['l_name'].', '.$row['f_name']; ?></option>
			<?php
			}
		}
	?>
	</select>
	 <input type='button' value='Remove' onclick='remove_element(<?php echo $xx; ?>)'>
	</div>
	<?php
				$xx++;
			}
		} else {
	?>
	
		<input type='text' name='subjects[]' placeholder='Subject Name'/> <select name='teachers[]'>
			<?php 
				if($result_teacher != null) {
					foreach($result_teacher as $row) {
					?>
						<option value=<?php echo $row['id'];?>><?php echo $row['l_name'].', '.$row['f_name']; ?></option>
					<?php
					}
				}
			?>
		</select>

<?php
		}
?>
</div>
</div>
<input type='button' id='add_more' value='Add More' onclick='addMore()'/> 
<br/><br><br>	
<?php
if(isset($_POST['add'])) {
	if(isset($status) && $status) {
		echo "<font color='green'>Add Successful</font><br>";
	}
}

?>
<input type='submit' name='add' value='ADD'/>

</form>