<?php
session_start();
include "../../config/koneksi.php";

$page=$_GET[page];
$act=$_GET[act];

// Hapus faktur_penjualan
if ($page=='penjualan' AND $act=='hapus'){
  mysql_query("DELETE FROM faktur_penjualan WHERE no_faktur_penjualan='$_GET[id]'");
  mysql_query("DELETE FROM transaksi_penjualan WHERE no_faktur_penjualan='$_GET[id]'");
  header('location:../../main.php?page='.$page);
}
 
?>