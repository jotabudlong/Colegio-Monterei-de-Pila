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


	var div = document.createElement('div');
	div.setAttribute("id", e_id);
	div.innerHTML = "<input type='text' name='subjects[]'> <input type='button' value='Remove' onclick='remove_element("+e_id+")'>";
	document.getElementById('subj').appendChild(div);
	e_id++;
}

function remove_element(id) {
	document.getElementById(id).remove();
}
</script>

<?php
if(isset($_POST['save'])) {
	$subjects = array();

	for($x = 0; $x < sizeof($_POST['subjects']);$x++) {
		$subject = new Subject;
		$subject->name = $_POST['subjects'][$x];
		array_push($subjects,$subject);
	}
	
	$status = save_predefine_subjects($_GET['manage'], $subjects);
}
?>

<input type='button' value='BACK' onclick='window.location = "?page=dashboard&view=predefine_subject"'/>
<br><br><br>

<h1>Grade <?php echo $_GET['manage']; ?> - Predefine Subjects</h1>
<form method='post'>
<div id='subj'>
<div id='<?php echo $xx;?>'>
<?php
	$predefine_subjects = list_predefine_subjects($_GET['manage']);

	if(sizeof($predefine_subjects)==0) {
?>
		<input type='text' name='subjects[]' value='' placeholder='Subject Name'>
<?php
	}
?>
</div>
<?php

	$xx = 1000;
	if($predefine_subjects != null) {
		foreach($predefine_subjects as $row) {
?>
			<div id='<?php echo $xx;?>'>
			<input type='text' name='subjects[]' value='<?php echo $row['name'];?>'>
			<input type='button' value='Remove' onclick='remove_element(<?php echo $xx; ?>)'>
			</div>
<?php
			$xx++;
		}
	}
?>

</div>
<br>
<input type='button' id='add_more' value='Add More' onclick='addMore()'/> 


<input type='submit' name='save' value='SAVE'/>
</form>
