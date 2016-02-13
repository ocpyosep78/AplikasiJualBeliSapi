<?php
error_reporting(0);
session_start();
if (empty($_SESSION[username]) and empty($_SESSION[password])) {
	echo "<link href='config/style.css' rel='stylesheet' type='text/css'>
 	<center>Untuk mengakses halaman Administrator, Anda harus login <br>";
  	echo "<a href=index.html><b>LOGIN</b></a></center>";
	}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Halaman Administrator - PT. Citra Agro Buana Semesta</title>
	<link rel="stylesheet" href="css/stylemain.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/paging.css" type="text/css" />
	<script type="text/javascript" src="js/jquery-1.8.2.min.js" ></script>
</head>
<body>
	<!-- Header -->
	<div id="header">
		<div class="shell">
			
			<div id="head">
				<h1><a href="#">PT. Citra Agro Buana Semesta</a></h1>
				<div class="right">
					<p>
						Selamat Datang, <a href="#"><strong><?php echo $_SESSION['username']; ?></strong></a> |
						<a href="main.php?page=password">Ubah Password</a> |
						<a href="logout.php">Logout</a>
					</p>
				</div>
			</div>
			
			<!-- Navigation -->
			<div id="navigation">
				<ul>
				    <?php include "menu.php"; ?>
				</ul>
			</div>
			<!-- End Navigation -->
			
		</div>
	</div>
	<!-- End Header -->
	
	<!-- Content -->
	<div id="content" class="shell">
		
		<?php include "content.php"; ?>
	
	<!-- End Content -->
</div>

<!-- Footer -->
<div id="footer">
	<p>&copy; 2013 PT. Citra Agro Buana Semesta.</a></p>
</div>
<!-- End Footer -->
</body>
</html>
<?php
}
?>