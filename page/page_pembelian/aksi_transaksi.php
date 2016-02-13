<?php
session_start();
include "../../config/koneksi.php";

$page=$_GET[page];
$act=$_GET[act];

if ($page=='pembelian' AND $act=='hapus'){
  mysql_query("DELETE FROM _tmp_pembelian WHERE id='$_GET[id]'");
  header('location:../../main.php?page='.$page);
}

?>