<?php
error_reporting(0);
?>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
		<script type="text/javascript">
		$(function() {
		$( "#beli1" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: 0,
				dateFormat: "yy-mm-dd"
			});
		$( "#beli2" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: 0,
				dateFormat: "yy-mm-dd"
			});
		$( "#jual1" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: 0,
				dateFormat: "yy-mm-dd"
			});
		$( "#jual2" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: 0,
				dateFormat: "yy-mm-dd"
			});
		});
		</script>
<?php
include "config/fungsi_alert.php";
$aksi="page/page_laporan/aksi_laporan.php";
switch($_GET[act]){
	
  default:

  include "config/koneksi.php";

    echo "<h6 class='red'>Laporan Transaksi</h6>";
	$tgl = date('Y-m-d');
	echo "
	<form method=POST action='$aksi?page=laporan&act=cetak' target='_blank'>
	<br>
	  <input class='radio' type='radio' name='laporan' value='beli' checked /> <span>Laporan Pembelian Periode</span>
	  <input type=text name='beli1' id='beli1' value='$tgl'>&nbsp; s/d &nbsp; <input type=text name='beli2' id='beli2' value='$tgl'><br><br>
	  <input class='radio' type='radio' name='laporan' value='jual' /> <span>Laporan Penjualan Periode</span>
	  <input type=text name='jual1' id='jual1' value='$tgl' > &nbsp; s/d &nbsp; <input type=text name='jual2' id='jual2' value='$tgl'>
	  <br><br>
	  <input type=submit value='     Cetak     ' name='btnCetak' >
	
	</form>";
	
	break;
}
?>