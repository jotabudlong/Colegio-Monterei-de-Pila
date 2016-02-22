<?php
$user = get_user_info($_SESSION["account_id"]);
$user = $user[0];
?>
<font color='#555555'><i><b>
<?php
if($_SESSION["account_type"]==1) {
	echo "Admin";
} elseif($_SESSION["account_type"]==2) {
	echo "Student";
} elseif($_SESSION["account_type"]==3) {
	echo "Teacher";
} elseif($_SESSION["account_type"]==4) { //Registrar
	echo "Registrar";
}
?></i></b>

<h1>Welcome <b><?php echo $user['f_name']." ".$user['m_name'].". ".$user['l_name']; ?>!</b><br/>
</font>
</h1>
<?php
if($_SESSION["account_type"]==1) {
	include("/pages/db_admin.php");
} elseif($_SESSION["account_type"]==2) {
	include("/pages/db_student.php");
} elseif($_SESSION["account_type"]==3) {
	include("/pages/db_teacher.php");
} elseif($_SESSION["account_type"]==4) { //Registrar
	include("/pages/db_registrar.php");
}
?>