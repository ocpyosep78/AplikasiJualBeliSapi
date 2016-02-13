<?php
session_start();
include "../../config/koneksi.php";

$page=$_GET[page];
$act=$_GET[act];

// Hapus pengguna
if ($page=='pengguna' AND $act=='hapus'){
  mysql_query("DELETE FROM pengguna WHERE username='$_GET[id]'");
  header('location:../../main.php?page='.$page);
}

// Input pengguna
elseif ($page=='pengguna' AND $act=='input'){
$username=mysql_real_escape_string($_POST[username]);
$password=md5(mysql_real_escape_string($_POST[password]));
$level=mysql_real_escape_string($_POST[level]);
mysql_query("INSERT INTO pengguna(
			      username,
					password,
					level) 
	                       VALUES(
				'$username',
				'$password',
				'$level')");
  header('location:../../main.php?page='.$page);
}

// Update pengguna
elseif ($page=='pengguna' AND $act=='update'){
$username=mysql_real_escape_string($_POST[username]);
$level=mysql_real_escape_string($_POST[level]);
  mysql_query("UPDATE pengguna SET
					username   = '$username',
					level	   = '$level'
                           WHERE username       = '$_POST[id]'");
  header('location:../../main.php?page='.$page);
 }
 
?>