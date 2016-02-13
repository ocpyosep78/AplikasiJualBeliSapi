<?php
switch($_GET[act]){
default:
echo "<h6 class='red'>Update Password</h6>
		<form method='post' action='?page=password&act=updatepassword'>
		<table>
		<tr><td>Masukkan password lama</td><td><input type='password' name='oldPass' /></td></tr>
		<tr><td>Masukkan password baru</td><td><input type='password' name='newPass1' /></td></tr>
		<tr><td>Masukkan kembali password baru</td><td><input type='password' name='newPass2' /></td></tr>
		<tr><td></td><td>
		<input type=image src=images/save.png name=submit width='40' height='40' title='Simpan' alt='Simpan'>
		<input type='hidden' name='pass' value='".$_SESSION[password]."'>
		<input type='hidden' name='nama' value='".$_SESSION[username]."'></td></tr>
		</table>		
		</form>";
break;

case "updatepassword":

$pengacak = $_POST['pass'];
include "config/koneksi.php";

$user = $_POST['nama'];
$passwordlama = $_POST['oldPass'];
$passwordbaru1 = $_POST['newPass1'];
$passwordbaru2 = $_POST['newPass2'];

$query = "SELECT * FROM pengguna WHERE username = '$user'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);

if ($data['password'] ==  md5($passwordlama))
{
	if ($passwordbaru1 == $passwordbaru2)
	{
		$passwordbaruenkrip = md5($passwordbaru1);
		
		$query = "UPDATE pengguna SET password = '$passwordbaruenkrip' WHERE username = '$user' ";
		$hasil = mysql_query($query);
		
		if ($hasil) echo "Update password sukses";
	}
	else echo "Password baru Anda tidak sama";
}
else echo "Password lama Anda salah";
break;
}
?>