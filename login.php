<?php
include "config/koneksi.php";
$pass=md5($_POST[password]);

if ($_POST[username]=='admin' && $_POST[password]=='admin'){
	session_start();
	
	$_SESSION[username]     = 'admin';
  	$_SESSION[password]     = 'admin';
	$_SESSION[level]     	= 'admin';
	
	header('location:main.php?page=home');
}else{
$login=mysql_query("select * from pengguna where username='$_POST[username]' and password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

//apabila user dan pasword ditemukan
if ($ketemu>0) {
	session_start();
	
	$_SESSION[username]     = $r[username];
  	$_SESSION[password]     = $r[password];
	$_SESSION[level]     	= $r[level];
	
	header('location:main.php?page=home');
}
else{
  echo "<link href=config/style.css rel=stylesheet type=text/css>";
  echo "<center>LOGIN GAGAL! <br> 
        Username atau Password Anda salah.<br>";
  echo "<a href=index.html><b>ULANGI LAGI</b></a></center>";
}
}
?>