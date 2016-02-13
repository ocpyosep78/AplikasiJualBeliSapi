<?php
error_reporting(0);
session_start();
include "../../pdf/fpdf.php";
include "../../config/koneksi.php";

$id=$_GET[id];

$sql1 = mysql_query("select * from faktur_penjualan join pembeli using(kode_pembeli) where no_faktur_penjualan='$id'");
$data1 = mysql_fetch_array($sql1);

$pdf = new FPDF();
$pdf->AddPage('L');
$pdf->setFont('Arial','B',10);
$pdf->setXY(10,5); $pdf->cell(30,6,'No Faktur Penjualan : '.$data1[no_faktur_penjualan]);
$pdf->setXY(10,10); $pdf->cell(30,6,'Nama Pembeli : '.$data1[nama_pembeli]);
$pdf->setXY(10,15); $pdf->cell(30,6,'No Telepon : '.$data1[no_telp_pembeli]);
$pdf->setXY(10,20); $pdf->cell(30,6,'Tgl Penjualan : '.$data1[tgl_faktur_penjualan]);

$y_initial = 36;
$y_axis1 = 30;

$pdf->setFillColor(233,233,233);
$pdf->setY($y_axis1);
$pdf->setX(5);

$pdf->cell(50,6,'Jenis Sapi',1,0,'C',1);
$pdf->cell(50,6,'Banyaknya',1,0,'C',1);
$pdf->cell(50,6,'Harga',1,0,'C',1);
$pdf->cell(50,6,'Jumlah',1,0,'C',1);

$y = $y_initial + $row;

$sql = mysql_query("select * from transaksi_penjualan where no_faktur_penjualan='$id'");
$row = 6;
while ($data = mysql_fetch_array($sql))
{
	$pdf->setY($y);
	$pdf->setX(5);
	
				$sql2=mysql_query("SELECT * FROM sapi join jenis using(kode_jenis_sapi) where kode_sapi='$data[kode_sapi]'");
				$rs2=mysql_fetch_array($sql2);
				$pdf->cell(50,6,$rs2[keterangan_sapi],1,0,'L');
				$pdf->cell(50,6,$data[jumlah_sapi_penjualan],1,0,'C');
				$pdf->cell(50,6,$rs2[harga_sapi],1,0,'C');
				$jml = $data[jumlah_sapi_penjualan] * $rs2[harga_sapi];
				$pdf->cell(50,6,$jml,1,0,'C');
				
	$y = $y + $row;
}
$pdf->setXY(165,$y); $pdf->cell(30,6,'Total : '.$data1[total_penjualan]);

$pdf->Output();

?>