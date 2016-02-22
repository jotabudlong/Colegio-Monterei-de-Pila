<?php
if(!isset($_GET['view']) || (isset($_GET['view']) && $_GET['view']=='users')) {
	if(isset($_GET['edit'])) {
		include('/db_admin_edit_user.php');
	} elseif(isset($_GET['add'])) {
		include('/db_admin_add_user.php');
	} else {
		include('/db_admin_view_user.php');
	}
} elseif((isset($_GET['view']) && $_GET['view']=='class')) {
	if(isset($_GET['edit'])) {
		include('/db_registrar_edit_class_subject_info.php');
	} elseif(isset($_GET['add'])) {
		include('/db_registrar_add_class.php');
	} elseif(isset($_GET['assign'])) {
		include('/db_registrar_assign_class.php');
	} else {
		include('/db_registrar_view_class.php');
	}
} elseif((isset($_GET['view']) && $_GET['view']=='grades')) {
	if(isset($_GET['manage'])) {
		include('/db_teacher_manage_class.php');
	} elseif(isset($_GET['add'])) {
		include('/db_registrar_add_student.php');
	} else {
		include('/db_teacher_view_class.php');
	}
} elseif(!isset($_GET['view']) || (isset($_GET['view']) && $_GET['view']=='predefine_subject')) {
	if(isset($_GET['manage'])) {
		include('/db_registrar_manage_predefine_subject.php');
	} else {
		include('/db_registrar_view_predefine_subject.php');
	}
}

?>