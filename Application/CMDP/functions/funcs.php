<?php
class Subject {
	public $id;
	public $name;
	public $teacher;
}

function unanchor_home() {
	if(isset($_SESSION["account_id"])) { echo "#"; } else { echo "?"; }
}

//---------------------------------------------------------------------
//Admin Functions ##Users
//---------------------------------------------------------------------
function searh_user($search,$type) {
	require("db/DBCONNECT.php");
	
	$search = mysqli_real_escape_string($conn, $search);
	$type_query = " AND type='$type'";
	if($type == -1) {
		$type_query = "";
	}

	$sql = "SELECT *
	FROM User
	WHERE
	(id like '%$search%' OR
	f_name like '%$search%' OR
	l_name like '%$search%' OR
	username like '%$search%') AND id != -1 $type_query ORDER BY type";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function get_user_info($id) {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM User WHERE id = '$id'";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function save_user($id,$f_name,$l_name,$m_name,$email,$type,$username,$password) {
	require("db/DBCONNECT.php");
	
	$f_name=mysqli_real_escape_string($conn, $f_name);
	$l_name=mysqli_real_escape_string($conn, $l_name);
	$m_name=mysqli_real_escape_string($conn, $m_name);
	$email=mysqli_real_escape_string($conn, $email);
	$username=mysqli_real_escape_string($conn, $username);
	$password=mysqli_real_escape_string($conn, $password);
	if(strlen($password) < 5) {
		$password = '';
	}
	$password_query = ",password='$password'";
	if($password == '') {
		$password_query = "";
	}

	$sql = "UPDATE User SET f_name='$f_name', l_name='$l_name', m_name='$m_name', email='$email', username='$username' $password_query
	WHERE id=$id";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function add_user($f_name,$l_name,$m_name,$email,$type) {
	require("db/DBCONNECT.php");
	
	$f_name=mysqli_real_escape_string($conn, $f_name);
	$l_name=mysqli_real_escape_string($conn, $l_name);
	$m_name=mysqli_real_escape_string($conn, $m_name);
	$email=mysqli_real_escape_string($conn, $email);
	$username=str_replace(" ","",strtolower($l_name)).str_replace(" ","",strtolower($m_name))."_".str_replace(" ","",strtolower($f_name));
	$password=str_replace(" ","",strtolower($l_name));
	

	$sql = "INSERT INTO User (f_name,l_name, m_name, email, username,password,type) VALUES ('$f_name','$l_name', '$m_name', '$email','$username','$password',$type)";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}
//---------------------------------------------------------------------
//Registrar Functions ##STUDENTS
//---------------------------------------------------------------------
function searh($search, $type) {
	require("db/DBCONNECT.php");
	
	$search = mysqli_real_escape_string($conn, $search);

	$sql = "SELECT *, User.id as stud_id, Section.id as sec_id FROM User INNER JOIN Section ON User.section = Section.id
	WHERE
	(User.f_name like '%$search%' OR
	User.l_name like '%$search%' OR
	User.username like '%$search%' OR
	Section.name like '%$search%') AND User.type=$type";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

//Search Student
function get_user($id) {
	require("db/DBCONNECT.php");

	$sql = "SELECT *, User.id as stud_id, Section.id as sec_id FROM User INNER JOIN Section ON User.section = Section.id
	WHERE
	User.id = '$id'";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function get_sections() {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM Section";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function save_student($id,$f_name,$l_name,$username,$password,$section) {
	require("db/DBCONNECT.php");
	
	$f_name=mysqli_real_escape_string($conn, $f_name);
	$l_name=mysqli_real_escape_string($conn, $l_name);
	$username=mysqli_real_escape_string($conn, $username);
	$password=mysqli_real_escape_string($conn, $password);
	$password_query = "password='$password',";
	if($password == '') {
		$password_query = "";
	}

	$sql = "UPDATE User SET f_name='$f_name', l_name='$l_name', username='$username',$password_query  section='$section',
	year_level=(SELECT year_level FROM Section WHERE id=$section)

	WHERE id=$id";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function unassign_student($id) {
	require("db/DBCONNECT.php");

	$sql = "UPDATE User SET section='0'
	WHERE id=$id";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function add_student($f_name,$l_name,$email,$username,$password,$section) {
	require("db/DBCONNECT.php");
	
	$f_name=mysqli_real_escape_string($conn, $f_name);
	$l_name=mysqli_real_escape_string($conn, $l_name);
	$l_name=mysqli_real_escape_string($conn, $email);
	$username=mysqli_real_escape_string($conn, $username);
	$password=mysqli_real_escape_string($conn, $password);

	$sql = "INSERT INTO User (f_name,l_name,email,username,password,year_level,section,type) VALUES ('$f_name','$l_name','$email','$username','$password',(SELECT year_level FROM Section WHERE id = $section),$section,2)";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}
//---------------------------------------------------------------------
//Registrar Functions ##TEACHER
//---------------------------------------------------------------------
function searh_teacher($search) {
	require("db/DBCONNECT.php");
	
	$search = mysqli_real_escape_string($conn, $search);

	$sql = "SELECT * FROM User 
	WHERE
	(f_name like '%$search%' OR
	l_name like '%$search%' OR
	username like '%$search%') AND type=3";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function get_teacher_info($id) {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM User WHERE id = '$id'";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function save_teacher($id,$f_name,$l_name,$username,$password,$unsubjects,$subjects) {
	require("db/DBCONNECT.php");
	
	$f_name=mysqli_real_escape_string($conn, $f_name);
	$l_name=mysqli_real_escape_string($conn, $l_name);
	$username=mysqli_real_escape_string($conn, $username);
	$password=mysqli_real_escape_string($conn, $password);
	$password_query = "password='$password',";
	if($password == '') {
		$password_query = "";
	}

	$sql = "UPDATE User SET f_name='$f_name', l_name='$l_name', $password_query username='$username' WHERE id = '$id'";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	foreach($subjects as $sub) {
		save_subject($sub,'-1',$id,-1);
	}
	
	foreach($unsubjects as $unsub) {
		save_subject($unsub,'-1',-1,-1);
	}
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function add_teacher($f_name,$l_name,$username,$password) {
	require("db/DBCONNECT.php");
	
	$f_name=mysqli_real_escape_string($conn, $f_name);
	$l_name=mysqli_real_escape_string($conn, $l_name);
	$username=mysqli_real_escape_string($conn, $username);
	$password=mysqli_real_escape_string($conn, $password);

	$sql = "INSERT INTO User (f_name,l_name,username,password,year_level,type) VALUES ('$f_name','$l_name','$username','$password',-1,3)";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

//---------------------------------------------------------------------
//Registrar Functions ##SECTIONS
//---------------------------------------------------------------------
function searh_section($search,$year_level) {
	require("db/DBCONNECT.php");
	
	$year_level_query = "AND year_level = $year_level";
	
	if($year_level == 0) {
		$year_level_query = "";
	}
	
	$search = mysqli_real_escape_string($conn, $search);

	$sql = "SELECT * FROM Section WHERE name like '%$search%' $year_level_query";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function get_section_info($id) {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM Section WHERE id = '$id'";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function save_section($id,$name,$year_level) {
	require("db/DBCONNECT.php");
	
	$name=mysqli_real_escape_string($conn, $name);
	
	$sql2 = "UPDATE Subject
	SET
	year_level=$year_level
	
	WHERE section = $id";
	
	$sql3 = "UPDATE User
	SET
	year_level=$year_level
	
	WHERE section = $id";
	
	mysqli_query($conn, $sql2) or die("Connection failed: " . $conn->error);
	mysqli_query($conn, $sql3) or die("Connection failed: " . $conn->error);

	$sql1 = "UPDATE Section
	SET
	name='$name',
	year_level=$year_level
	
	WHERE id = $id";
	$result = mysqli_query($conn, $sql1) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function add_section($name,$year_level) {
	require("db/DBCONNECT.php");
	
	$name=mysqli_real_escape_string($conn, $name);

	$sql = "INSERT INTO Section (name,year_level) VALUES ('$name',$year_level)";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}
//---------------------------------------------------------------------
//Registrar Functions ##SUBJECT
//---------------------------------------------------------------------

function searh_subject($search,$year_level,$teacher) {
	return searh_subject_section_isnot($search,$year_level,$teacher,-1,false);
}

function searh_subject_section($search,$year_level,$teacher,$section) {
	return searh_subject_section_isnot($search,$year_level,$teacher,-1, false);
}

function searh_subject_section_isnot($search,$year_level,$teacher,$section,$isnot) {
	require("db/DBCONNECT.php");
	
	$year_level_query = "AND Subject.year_level = $year_level";
	
	if($year_level == 0) {
		$year_level_query = "";
	}
	
	$isnot_query = "!";
	
	if($isnot) {
		$isnot_query = "";
	}
	
	$teacher_query = "AND User.id $isnot_query= $teacher";
	
	if($teacher == -1) {
		$teacher_query = "";
	}
	
	$section_query = "AND Subject.section = $section";
	
	if($section == -1) {
		$section_query = "";
	}
	
	$search = mysqli_real_escape_string($conn, $search);

	$sql = "SELECT *,
	Subject.id as subject_id,
	Subject.name as subject_name,
	CONCAT(User.l_name,', ',User.f_name) as teacher_name,
	Subject.year_level as subject_year_level,
	
	User.year_level as ignore_yl,
	
	Section.name as section_name
	
	FROM Subject
	INNER JOIN User ON Subject.teacher = User.id
	INNER JOIN Section ON Subject.section = Section.id
	
	WHERE Subject.name like '%$search%' $year_level_query $teacher_query $section_query
	
	";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function search_not_available_subject_for_teacher($teacher) {
	require("db/DBCONNECT.php");
	

	$sql = "SELECT *,
	Subject.id as subject_id,
	Subject.name as subject_name,
	CONCAT(User.l_name,', ',User.f_name) as teacher_name,
	Subject.year_level as subject_year_level,
	
	User.year_level as ignore_yl,
	
	Section.name as section_name
	
	FROM Subject
	INNER JOIN User ON Subject.teacher = User.id
	INNER JOIN Section ON Subject.section = Section.id
	
	WHERE Subject.teacher = $teacher AND Subject.teacher != -1";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function search_available_subject_for_teacher($teacher) {
	require("db/DBCONNECT.php");
	

	$sql = "SELECT *,
	Subject.id as subject_id,
	Subject.name as subject_name,
	CONCAT(User.l_name,', ',User.f_name) as teacher_name,
	Subject.year_level as subject_year_level,
	
	User.year_level as ignore_yl,
	
	Section.name as section_name
	
	FROM Subject
	INNER JOIN User ON Subject.teacher = User.id
	INNER JOIN Section ON Subject.section = Section.id
	
	WHERE Subject.teacher != $teacher AND Subject.teacher = -1";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function search_subject_for_teacher_per_section($teacher,$section) {
	require("db/DBCONNECT.php");
	
	$sql_teacher = "Subject.teacher = $teacher AND";
	
	if($teacher == -1) {
		$sql_teacher = "";
	}

	$sql = "SELECT *,
	Subject.id as subject_id,
	Subject.name as subject_name,
	CONCAT(User.l_name,', ',User.f_name) as teacher_name,
	Subject.year_level as subject_year_level,
	
	User.year_level as ignore_yl,
	
	Section.name as section_name
	
	FROM Subject
	INNER JOIN User ON Subject.teacher = User.id
	INNER JOIN Section ON Subject.section = Section.id
	
	WHERE $sql_teacher Subject.section = $section";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function get_subject_info($id) {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM Subject WHERE id = '$id'";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function save_subject($id,$name,$teacher,$section) {
	require("db/DBCONNECT.php");
	
	$name=mysqli_real_escape_string($conn, $name);
	
	$name_query = ",name='$name'";
	if($name=='-1') {
		$name_query = "";
	}
	
	$section_query = ",section=$section";
	$year_level_query = "year_level=(SELECT year_level FROM Section WHERE id = $section),";
	if($section==-1) {
		$section_query = "";
		$year_level_query = "";
	}
	
	

	$sql = "UPDATE Subject
	SET 
	 
	$year_level_query
	teacher=$teacher $section_query $name_query
	
	WHERE Subject.id = '$id'";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function add_subject($name,$teacher,$section) {
	require("db/DBCONNECT.php");
	
	$name=mysqli_real_escape_string($conn, $name);

	$sql = "INSERT INTO Subject (name,year_level,teacher,section) VALUES ('$name',(SELECT year_level FROM Section WHERE id = $section),$teacher,$section)";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

//---------------------------------------------------------------------
//Registrar Functions ##CLASS
//---------------------------------------------------------------------
function add_section_class($section_name, $year_level, $school_year, $teacher_adviser, $subjects) {
	require("db/DBCONNECT.php");
	
	$section_name=mysqli_real_escape_string($conn, $section_name);

	$sql = "INSERT INTO Section (name,year_level,school_year,adviser) VALUES ('$section_name',$year_level,$school_year ,$teacher_adviser)";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);

	foreach($subjects as $sub) {
		add_subject($sub->name,$sub->teacher,mysqli_insert_id($conn));
	}

	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function save_section_class($id, $section_name, $year_level, $school_year, $teacher_adviser, $subjects) {
	require("db/DBCONNECT.php");

	$section_name=mysqli_real_escape_string($conn, $section_name);
	
	
	$sql = "UPDATE Section
	SET
	name='$section_name',
	year_level=$year_level,
	school_year=$school_year,
	adviser=$teacher_adviser
	WHERE id=$id";
	
	
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);

	foreach($subjects as $sub) {
		save_subject($sub->id,$sub->name,$sub->teacher,$id);
	}

	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function list_available_student($subject) {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM User
	WHERE id NOT IN (SELECT student FROM Grade WHERE subject = $subject)
	AND section = 0 AND type = 2";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function add_student_to_class($section,$student) {
	require("db/DBCONNECT.php");

	$sql = "UPDATE User
	SET
	section = $section,
	year_level = (SELECT year_level FROM Section WHERE id=$section)
	WHERE id = $student";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	$subjects = get_subjects_from_section($section);
	foreach($subjects as $subject) {
		save_class($subject['id'],$student,$section); 
	}
	
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function save_class_info($section,$teacher_adviser) {
	require("db/DBCONNECT.php");
	
	$name=mysqli_real_escape_string($conn, $name);

	$sql1 = "UPDATE Section
	SET
	name='$name',
	year_level=$year_level
	
	WHERE id = $id";
	$result = mysqli_query($conn, $sql1) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function get_subjects_from_section($section) {
require("db/DBCONNECT.php");

	$sql = "SELECT * FROM Subject
	WHERE section = $section";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function save_class($subject,$student,$section) {
	require("db/DBCONNECT.php");

	$r = mysqli_query($conn, "SELECT * FROM Grade WHERE subject=$subject AND student=$student AND section=$section") or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($r) == 0) {
		$sql = "INSERT INTO Grade (subject,student,section) VALUES ($subject,$student,$section)";
		$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	}

	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function list_predefine_subjects($year_level) {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM predefine_subject
	WHERE year_level = $year_level";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function save_predefine_subjects($year_level, $subjects) {
	require("db/DBCONNECT.php");
	
	$sql = "DELETE FROM predefine_subject WHERE year_level = $year_level";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);

	foreach($subjects as $sub) {
		add_predefine_subject($year_level,$sub->name);
	}
}

function add_predefine_subject($year_level, $subject) {
	require("db/DBCONNECT.php");

	$subject=trim(mysqli_real_escape_string($conn, $subject));
	
	if(strlen($subject)>0) {
		$sql = "INSERT INTO predefine_subject (name,year_level) VALUES ('$subject',$year_level)";
		$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	}
	
	if(mysqli_affected_rows($conn) > 0) {
		return true;
	} else {
		return false;
	}
}

//---------------------------------------------------------------------
//Teacher Functions ##Manage Class
//---------------------------------------------------------------------
function list_teacher_sections($teacher) {
	require("db/DBCONNECT.php");
	
	$sql_teacher = " WHERE teacher = $teacher";
	
	if($teacher == -1) {
		$sql_teacher = "";
	}

	$sql = "SELECT * FROM Section WHERE id IN (SELECT DISTINCT(section) as section FROM Subject $sql_teacher)";
	
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function list_students_in_section($section) {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM User WHERE section = $section";
	
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function list_students_in_subject($subject) {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM User WHERE id IN (SELECT student FROM Grade WHERE subject = $subject)";
	
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function get_grades($subject, $student) {
	require("db/DBCONNECT.php");

	$sql = "SELECT * FROM Grade WHERE subject = $subject AND student = $student";
	
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function save_grades($subject, $student, $q1, $q2, $q3, $q4, $remarks) {
	require("db/DBCONNECT.php");

	$sql = "UPDATE Grade
	SET 
	grade_1 = $q1,
	grade_2 = $q2,
	grade_3 = $q3,
	grade_4 = $q4,
	remarks = '$remarks'
	WHERE subject = $subject AND student = $student";
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if(mysqli_affected_rows($conn) > 0){
		return true;
	} else {
		return false;
	}
}

function list_student_school_years($student) {
	require("db/DBCONNECT.php");

	$sql = "SELECT DISTINCT(Section.school_year) as school_year FROM Grade
	INNER JOIN Section
	ON Section.id = Grade.section
	WHERE Grade.student=$student
	ORDER BY Section.school_year DESC";
	
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function list_student_sections($student) {
	require("db/DBCONNECT.php");

	$sql = "SELECT DISTINCT(section) as section, Section.name as name, Section.school_year as school_year, Section.year_level as year_level FROM Grade
	INNER JOIN Section
	ON Grade.section = Section.id
	WHERE student=$student";
	
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

function get_student_section_grades($student, $section) {
	require("db/DBCONNECT.php");

	$sql = "SELECT *, Subject.name as name FROM Grade
	INNER JOIN Subject
	ON Grade.subject = Subject.id
	WHERE Grade.student=$student AND Grade.section=$section";
	
	$result = mysqli_query($conn, $sql) or die("Connection failed: " . $conn->error);
	
	if (mysqli_num_rows($result) > 0) {
		return mysqli_fetch_all($result,MYSQLI_ASSOC);
	} else {
		return null;
	}
}

//OTHERS
function to_level($year_level) {
	return 'Grade '.$year_level;
}
?>