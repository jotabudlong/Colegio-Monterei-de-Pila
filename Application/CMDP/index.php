<?php 
	session_start();
	include('/functions/funcs.php');
	include('/functions/f_login.php');
	
	if(isset($_GET['logout'])) {
		session_destroy();
		
		header("Location: ?");
die();
		
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>CMDP</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="clear"> 
    <!-- ################################################################################################ -->
    <nav>
      <ul>
		<?php
		if(!isset($_SESSION["account_id"])) {
		?>
        
        <li><a href="?page=login"> | Login | </a></li>
		<?php
		} else {
		?>
        <li><a href="?logout">Logout</a></li>
		<?php
		}
		?>
      </ul>
    </nav>
    <!-- ################################################################################################ --> 
  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="<?php unanchor_home(); ?>">Colegio Monterei de Pila</h1>

    </div>
    <div class="fl_right"><!--
      <form class="clear" method="post" action="#">
        <fieldset>
          <legend>Search:</legend>
          <input type="text" value="" placeholder="Search Here">
          <button class="fa fa-search" type="submit" title="Search"><em>Search</em></button>
        </fieldset>
      </form>-->
    </div>	
    <!-- ################################################################################################ --> 
  </header>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->

<div class="">
  <div class="rounded">
    <nav id="mainav" class="clear"> 
	<?php
	if(!isset($_SESSION["account_id"])) {
	?>
      <!-- ################################################################################################ -->
      <ul class="clear">
        <li <?php echo !isset($_GET['page']) ? 'class="active"' : '' ?>><a class="" href="?">Home</a>
       
        <li><a class="" href="#">Gallery</a>
          
        </li>
        
        <li <?php echo isset($_GET['page']) && $_GET['page']=='grade_viewer' ? 'class="active"' : '' ?>><a href="?page=grade_viewer">Online Grade Viewer</a></li>
      
      </ul>
      </li>
	<?php
	} elseif($_SESSION["account_type"]==4) {
	?>
	<ul class="clear">
        <li <?php echo !isset($_GET['view']) || (isset($_GET['view']) && $_GET['view']=='class') ? 'class="active"' : '' ?>><a href="?page=dashboard&view=class">Manage Class</a></li>
		
		<li  <?php echo !isset($_GET['view']) || (isset($_GET['view']) && $_GET['view']=='predefine_subject') ? 'class="active"' : '' ?>><a href="?page=dashboard&view=predefine_subject">Manage Predefined Subjects</a></li>
      </ul>
	<?php
	} elseif($_SESSION["account_type"]==3) {
	?>
	<ul class="clear">
        <li><a href="?page=dashboard&view=class">Manage Grades</a></li>
      </ul>
	<?php
	} elseif($_SESSION["account_type"]==1) {
	?>
	<ul class="clear">
        <li <?php echo !isset($_GET['view']) || (isset($_GET['view']) && $_GET['view']=='users') ? 'class="active"' : '' ?>><a href="?page=dashboard&view=users">Manage Users</a></li>
	<li <?php echo !isset($_GET['view']) || (isset($_GET['view']) && $_GET['view']=='class') ? 'class="active"' : '' ?>><a href="?page=dashboard&view=class">Manage Class</a></li>
	
        <li  <?php echo !isset($_GET['view']) || (isset($_GET['view']) && $_GET['view']=='grades') ? 'class="active"' : '' ?>><a href="?page=dashboard&view=grades">Manage Grades</a></li>
		
		<li  <?php echo !isset($_GET['view']) || (isset($_GET['view']) && $_GET['view']=='predefine_subject') ? 'class="active"' : '' ?>><a href="?page=dashboard&view=predefine_subject">Manage Predefine Subjects</a></li>
      </ul>
	<?php
	}
	?>
      <!-- ################################################################################################ --> 
    </nav>
  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->



<?php
if(!isset($_GET['page'])) {
?>
<div class="wrapper">
  <div id="slider">
    <div id="slide-wrapper" class="rounded clear"> 
      <!-- ################################################################################################ -->
      <figure id="slide-1"><a class="view" href="#"><img src="images/demo/slider/CMP.jpg"  style="width:960px;height:500px;" alt=""></a>
        <figcaption>
          <h2>Colegio Monterei de Pila</h2>
          <p>"empty".</p>
          <p class="right"><a href="#">Continue Reading &raquo;</a></p>
        </figcaption>
      </figure>
      <figure id="slide-2"><a class="view" href="#"><img src="images/demo/slider/CMP Mission.jpg" style="width:960px;height:500px;" alt=""></a>
        <figcaption>
          <h2>Mission</h2>
          <p>To provide a solid foundation of learmning based on spirituality, positive values
      and innovative teaching strategies in order to
      promote the total development of the child.</p>
          <p class="right"><a href="#">Continue Reading &raquo;</a></p>
        </figcaption>
      </figure>
      <figure id="slide-3"><a class="view" href="#"><img src="images/demo/slider/CMPVission.jpg" style="width:960px;height:500px;" alt=""></a>
        <figcaption>
          <h2>Vision</h2>
          <p>A center of excellence in the education 
      offering a virtues-laden curriculum in nurturing 
      environtment focused on man's conduct and
      harmonious relationship with others</p>
          <p class="right"><a href="#">Continue Reading &raquo;</a></p>
        </figcaption>
      </figure>
      <figure id="slide-4"><a class="view" href="#"><img src="images/fss.jpg" alt=""></a>
        <figcaption>
          <h2>" "</h2>
          <p>" "</p>
          <p class="right"><a href="#">Continue Reading &raquo;</a></p>
        </figcaption>
      </figure>
      <figure id="slide-5"><a class="view" href="#"><img src="images/demo/slider/5.png" alt=""></a>
        <figcaption>
          <h2>Welcome new applicants!</h2>
          <p>We are now entertaining new applicants. Enroll now!</p>
          <p class="right"><a href="#">Continue Reading &raquo;</a></p>
        </figcaption>
      </figure>
      <!-- ################################################################################################ -->
      <ul id="slide-tabs">
        <li><a href="#slide-1">All About The CMP</a></li>
        <li><a href="#slide-2">Why You Should Study With Us</a></li>
        <li><a href="#slide-3">Our Vision For Learners</a></li>
        <li><a href="">"ETC"</a></li>
        <li><a href="">"ETC"</a></li> 
      </ul>
      <!-- ################################################################################################ --> 
    </div>
  </div>
</div>
<?php
}
?>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <div class="rounded">
  <?php
  
    if(isset($_GET['page'])) {
      if($_GET['page']=='school_faciities') {
        include("/pages/gallery_school_facilities.php");
      } elseif ($_GET['page']=='school_staff') {
        include("/pages/gallery_school_staff.php");
      } elseif ($_GET['page']=='information') {
        include("/pages/information.php");
      } elseif ($_GET['page']=='login') {
        include("/pages/login.php");
      } elseif ($_GET['page']=='dashboard') {
        include("/pages/dashboard.php");
      } elseif ($_GET['page']=='grade_viewer') {
        include("/pages/login_student.php");
      }
    }
  ?>

  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <div class="rounded">
    <footer id="footer" class="clear"> 
      <!-- ################################################################################################ -->
    
      
    
      <!-- ################################################################################################ --> 
    </footer>
  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->

<!-- JAVASCRIPTS --> 
<script src="layout/scripts/jquery.min.js"></script> 
<script src="layout/scripts/jquery.fitvids.min.js"></script> 
<script src="layout/scripts/jquery.mobilemenu.js"></script> 
<script src="layout/scripts/tabslet/jquery.tabslet.min.js"></script>
</body>
</html>