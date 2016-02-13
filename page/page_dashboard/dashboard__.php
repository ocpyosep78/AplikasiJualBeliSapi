<?php
error_reporting(0);
?>
<html>
<head>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script src="js/highcharts.js" type="text/javascript"></script>
<script src="js/exporting.js" type="text/javascript"></script>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
<script type="text/javascript">
$(function() {
		$( "#periode1" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate : '0',
				dateFormat: "dd-mm-yy"
			});
		$( "#periode2" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate : '0',
				dateFormat: "dd-mm-yy"
			});
		});
var chart1;
var chart2;
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container1',
            type: 'column'
         },   
         title: {
            text: 'Grafik Pembelian Periode <?php echo $_POST['periode1']." s/d ".$_POST['periode2']; ?>'
         },
         xAxis: {
            categories: ['Tanggal']
         },
         yAxis: {
            title: {
               text: 'Pengeluaran'
            }
         },
              series:             
            [
            <?php 
        	include "config/koneksi.php";
			$tgl1 = explode("-",$_POST['periode1']);
			$tgl2 = explode("-",$_POST['periode2']);
			$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
			$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
			$sql2   = "SELECT DATE_FORMAT(tgl_faktur_pembelian,'%d-%m-%Y') AS tgl,sum(total_pembelian) as total from faktur_pembelian WHERE tgl_faktur_pembelian between '".$strtgl1."' AND '".$strtgl2."' group by tgl_faktur_pembelian";
			$query2 = mysql_query( $sql2 )  or die(mysql_error());
			while ($res = mysql_fetch_array( $query2 )){

				$tanggal=$res['tgl'];
				$total=$res['total'];
                  ?>
                  {
                      name: '<?php echo $tanggal; ?>',
                      data: [<?php echo $total; ?>]
                  },
                  <?php } ?>
            ]
      });
	  chart2 = new Highcharts.Chart({
         chart: {
            renderTo: 'container2',
            type: 'column'
         },   
         title: {
            text: 'Grafik Penjualan Periode <?php echo $_POST['periode1']." s/d ".$_POST['periode2']; ?>'
         },
         xAxis: {
            categories: ['Tanggal']
         },
         yAxis: {
            title: {
               text: 'Pendapatan'
            }
         },
              series:             
            [
            <?php 
        	include "config/koneksi.php";
			$tgl1 = explode("-",$_POST['periode1']);
			$tgl2 = explode("-",$_POST['periode2']);
			$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
			$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
			$sql2   = "SELECT DATE_FORMAT(tgl_faktur_penjualan,'%d-%m-%Y') AS tgl,sum(total_penjualan) as total from faktur_penjualan WHERE tgl_faktur_penjualan between '".$strtgl1."' AND '".$strtgl2."' group by tgl_faktur_penjualan";
			$query2 = mysql_query( $sql2 )  or die(mysql_error());
			while ($res = mysql_fetch_array( $query2 )){

				$tanggal=$res['tgl'];
				$total=$res['total'];
                  ?>
                  {
                      name: '<?php echo $tanggal; ?>',
                      data: [<?php echo $total; ?>]
                  },
                  <?php } ?>
            ]
      });
   });
</script>
</head>
<body>
<?php
echo "<h6 class='red'>Dashboard</h6>";
$tgl = date('d-m-Y');
	echo "
	<form method=POST action='?page=dashboard' >
	<br>
      <span>Periode</span>
	  <input type=text name='periode1' id='periode1' value='$tgl' > &nbsp; s/d &nbsp; <input type=text name='periode2' id='periode2' value='$tgl'>
	  <br><br>
	  <input type=submit value='     Proses     ' name='btnProses' >
	</form>";
	if($_POST['btnProses']){
		echo "<br><div id='container1'></div>";
		echo "<br><div id='container2'></div>";
	}
?>
</body>
</html>