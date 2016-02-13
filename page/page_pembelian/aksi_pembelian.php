<?php
session_start();
include "../../config/koneksi.php";

$page=$_GET[page];
$act=$_GET[act];

// Hapus faktur_pembelian
if ($page=='pembelian' AND $act=='hapus'){
  mysql_query("DELETE FROM faktur_pembelian WHERE no_faktur_pembelian='$_GET[id]'");
  mysql_query("DELETE FROM transaksi_pembelian WHERE no_faktur_pembelian='$_GET[id]'");
  header('location:../../main.php?page='.$page);
}
 
?>