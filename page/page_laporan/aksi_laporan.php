<?php
error_reporting(0);
session_start();
include "../../pdf/fpdf.php";
include "../../config/koneksi.php";
require('../../pdf/mc_table.php');

$page=$_GET[page];
$act=$_GET[act];

if ($page=='laporan' AND $act=='cetak'){

if($_POST[laporan]=='beli'){
$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->setFont('Arial','B',16);
$pdf->setXY(10,10); $pdf->cell(30,6,'Data Pembelian');
$pdf->setXY(10,18); $pdf->cell(30,6,'Periode : '.$_POST[beli1].' s/d '.$_POST[beli2]);
$pdf->setXY(10,26); $pdf->cell(30,6,'PT. Citra Agro Buana Semesta');
$pdf->setFont('Arial','B',10);

$y_initial = 44;
$y_axis1 = 38;

$pdf->setFont('Arial','',10);

$pdf->setFillColor(233,233,233);
$pdf->setY($y_axis1);
$pdf->setX(10);

$pdf->SetWidths(array(8,30,30,35,35,45));
$pdf->Row(array("NO","NO FAKTUR","TGL FAKTUR","KODE PENYUPLAI","NAMA PENYUPLAI","TOTAL PEMBELIAN"));

$y = $y_initial + $row;

$sql = mysql_query("select * from faktur_pembelian join penyuplai using(kode_penyuplai) WHERE tgl_faktur_pembelian between '$_POST[beli1]' AND '$_POST[beli2]'");
$no = 0;
$row = 8;
while ($data = mysql_fetch_array($sql))
{
	$no++;

	$pdf->Row(array($no,$data[no_faktur_pembelian],$data[tgl_faktur_pembelian],$data[kode_penyuplai],$data[nama_penyuplai],$data[total_pembelian]));
	$y = $y + $row;
}
$sql2 = mysql_query("SELECT sum(total_pembelian) as total FROM faktur_pembelian WHERE tgl_faktur_pembelian between '$_POST[beli1]' AND '$_POST[beli2]'");

$data2 = mysql_fetch_array($sql2);
$pdf->Row(array("","","","","TOTAL",$data2[total],"",""));
$pdf->Output();

}elseif($_POST[laporan]=='jual'){
$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->setFont('Arial','B',16);
$pdf->setXY(10,10); $pdf->cell(30,6,'Data Penjualan');
$pdf->setXY(10,18); $pdf->cell(30,6,'Periode : '.$_POST[beli1].' s/d '.$_POST[beli2]);
$pdf->setXY(10,26); $pdf->cell(30,6,'PT. Citra Agro Buana Semesta');

$pdf->setFont('Arial','B',10);

$y_initial = 44;
$y_axis1 = 38;

$pdf->setFont('Arial','',10);

$pdf->setFillColor(233,233,233);
$pdf->setY($y_axis1);
$pdf->setX(10);

$pdf->SetWidths(array(8,30,30,35,35,45));
$pdf->Row(array("NO","NO FAKTUR","TGL FAKTUR","KODE PEMBELI","NAMA PEMBELI","TOTAL PENJUALAN"));

$y = $y_initial + $row;

$sql = mysql_query("select * from faktur_penjualan join pembeli using(kode_pembeli) WHERE tgl_faktur_penjualan between '$_POST[jual1]' AND '$_POST[jual2]'");
$no = 0;
$row = 6;
while ($data = mysql_fetch_array($sql))
{
	$no++;

	$pdf->Row(array($no,$data[no_faktur_penjualan],$data[tgl_faktur_penjualan],$data[kode_pembeli],$data[nama_pembeli],$data[total_penjualan]));
	
	$y = $y + $row;
}
$sql2 = mysql_query("SELECT sum(total_penjualan) as total FROM faktur_penjualan WHERE tgl_faktur_penjualan between '$_POST[jual1]' AND '$_POST[jual2]'");

$data2 = mysql_fetch_array($sql2);

$pdf->Row(array("","","","","TOTAL",$data2[total],"",""));
$pdf->Output();
}

header('location:../../main.php?page='.$page);
}
 
?>