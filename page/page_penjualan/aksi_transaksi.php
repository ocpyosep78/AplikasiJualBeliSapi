<?php
session_start();
include "../../config/koneksi.php";

$page=$_GET[page];
$act=$_GET[act];

if ($page=='penjualan' AND $act=='hapus'){
  mysql_query("DELETE FROM _tmp_penjualan WHERE id='$_GET[id]'");
  header('location:../../main.php?page='.$page);
}

?>