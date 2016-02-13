<?php
include "config/koneksi.php";
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
$(function() {
    
        var colors = Highcharts.getOptions().colors,
            categories = ['Bulan September', 'Bulan Oktober'],
            name = 'Penjualan',
            data = [{
                    y: <?php
					$tgl1 = explode("-",$_POST['periode1']);
					$tgl2 = explode("-",$_POST['periode2']);
					$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
					$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
					$sql2   = "SELECT sum(total_penjualan) as total from faktur_penjualan WHERE month(tgl_faktur_penjualan)='9' AND tgl_faktur_penjualan between '".$strtgl1."' AND '".$strtgl2."'";
					$query2 = mysql_query($sql2);
					$res = mysql_fetch_array($query2);
					echo $res['total'];
					?>,
                    color: colors[0],
                    drilldown: {
                        name: 'Bulan September',
                        categories: [<?php 
						$tgl1 = explode("-",$_POST['periode1']);
						$tgl2 = explode("-",$_POST['periode2']);
						$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
						$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];	
						$sql2   = "SELECT DISTINCT(DATE_FORMAT(tgl_faktur_penjualan,'%d-%m-%Y')) as tgl from faktur_penjualan where month(tgl_faktur_penjualan)='9' AND tgl_faktur_penjualan between '".$strtgl1."' AND '".$strtgl2."'";
						$query2 = mysql_query($sql2);
						while ($res = mysql_fetch_array($query2)){
							?>'<?php echo $res['tgl']; ?>',<?php
						}
						?>],
                        data: [<?php
						$tgl1 = explode("-",$_POST['periode1']);
						$tgl2 = explode("-",$_POST['periode2']);
						$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
						$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
						$sql2   = "SELECT DATE_FORMAT(tgl_faktur_penjualan,'%d-%m-%Y') AS tgl,sum(total_penjualan) as total from faktur_penjualan WHERE month(tgl_faktur_penjualan)='9' AND tgl_faktur_penjualan between '".$strtgl1."' AND '".$strtgl2."' group by tgl_faktur_penjualan";
						$query2 = mysql_query($sql2);
						while ($res = mysql_fetch_array($query2)){
							echo $res['total']; ?>,<?php
						}
						?>],
                        color: colors[0]
                    }
                }, {
                    y: <?php
					$tgl1 = explode("-",$_POST['periode1']);
					$tgl2 = explode("-",$_POST['periode2']);
					$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
					$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
					$sql2   = "SELECT sum(total_penjualan) as total from faktur_penjualan WHERE month(tgl_faktur_penjualan)='10' AND tgl_faktur_penjualan between '".$strtgl1."' AND '".$strtgl2."'";
					$query2 = mysql_query($sql2);
					$res = mysql_fetch_array($query2);
					echo $res['total'];
					?>,
                    color: colors[2],
                    drilldown: {
                        name: 'Bulan Oktober',
                        categories: [<?php 
						$tgl1 = explode("-",$_POST['periode1']);
						$tgl2 = explode("-",$_POST['periode2']);
						$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
						$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
						$sql2   = "SELECT DISTINCT(DATE_FORMAT(tgl_faktur_penjualan,'%d-%m-%Y')) as tgl from faktur_penjualan where month(tgl_faktur_penjualan)='10' AND tgl_faktur_penjualan between '".$strtgl1."' AND '".$strtgl2."'";
						$query2 = mysql_query($sql2);
						while ($res = mysql_fetch_array($query2)){
							?>'<?php echo $res['tgl']; ?>',<?php
						}
						?>],
                        data: [<?php
						$tgl1 = explode("-",$_POST['periode1']);
						$tgl2 = explode("-",$_POST['periode2']);
						$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
						$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
						$sql2   = "SELECT DATE_FORMAT(tgl_faktur_penjualan,'%d-%m-%Y') AS tgl,sum(total_penjualan) as total from faktur_penjualan WHERE month(tgl_faktur_penjualan)='10' AND tgl_faktur_penjualan between '".$strtgl1."' AND '".$strtgl2."' group by tgl_faktur_penjualan";
						$query2 = mysql_query($sql2);
						while ($res = mysql_fetch_array($query2)){
							echo $res['total']; ?>,<?php
						}
						?>],
                        color: colors[2]
                    }
                }];
    
        function setChart(name, categories, data, color) {
			chart.xAxis[0].setCategories(categories, false);
			chart.series[0].remove(false);
			chart.addSeries({
				name: name,
				data: data,
				color: color || 'white'
			}, false);
			chart.redraw();
        }
    
        var chart = $('#container1').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Penjualan Periode <?php echo $_POST['periode1']." sampai ".$_POST['periode2']; ?>'
            },
            subtitle: {
                text: 'Klik kolom untuk melihat informasi penjualan lebih detail. Klik lagi untuk kembali.'
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Jumlah Penjualan (Rp.)'
                }
            },
            plotOptions: {
                column: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                var drilldown = this.drilldown;
                                if (drilldown) { // drill down
                                    setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                } else { // restore
                                    setChart(name, categories, data);
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        color: colors[0],
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            return;
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = 'Total Penjualan :<b> Rp. '+ this.y +'</b><br/>';
                    if (point.drilldown) {
                        s += 'Klik untuk lebih detail';
                    } else {
                        s += 'Klik untuk kembali';
                    }
                    return s;
                }
            },
            series: [{
                name: name,
                data: data,
                color: 'white'
            }],
            exporting: {
                enabled: false
            }
        })
        .highcharts(); // return chart
    });

	$(function() {
    
        var colors = Highcharts.getOptions().colors,
            categories = ['Bulan September', 'Bulan Oktober'],
            name = 'Pembelian',
            data = [{
                    y: <?php
					$tgl1 = explode("-",$_POST['periode1']);
					$tgl2 = explode("-",$_POST['periode2']);
					$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
					$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
					$sql2   = "SELECT sum(total_pembelian) as total from faktur_pembelian WHERE month(tgl_faktur_pembelian)='9' AND tgl_faktur_pembelian between '".$strtgl1."' AND '".$strtgl2."'";
					$query2 = mysql_query($sql2);
					$res = mysql_fetch_array($query2);
					echo $res['total'];
					?>,
                    color: colors[3],
                    drilldown: {
                        name: 'Bulan September',
                        categories: [<?php 
						$tgl1 = explode("-",$_POST['periode1']);
						$tgl2 = explode("-",$_POST['periode2']);
						$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
						$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];	
						$sql2   = "SELECT DISTINCT(DATE_FORMAT(tgl_faktur_pembelian,'%d-%m-%Y')) as tgl from faktur_pembelian where month(tgl_faktur_pembelian)='9' AND tgl_faktur_pembelian between '".$strtgl1."' AND '".$strtgl2."'";
						$query2 = mysql_query($sql2);
						while ($res = mysql_fetch_array($query2)){
							?>'<?php echo $res['tgl']; ?>',<?php
						}
						?>],
                        data: [<?php
						$tgl1 = explode("-",$_POST['periode1']);
						$tgl2 = explode("-",$_POST['periode2']);
						$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
						$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
						$sql2   = "SELECT DATE_FORMAT(tgl_faktur_pembelian,'%d-%m-%Y') AS tgl,sum(total_pembelian) as total from faktur_pembelian WHERE month(tgl_faktur_pembelian)='9' AND tgl_faktur_pembelian between '".$strtgl1."' AND '".$strtgl2."' group by tgl_faktur_pembelian";
						$query2 = mysql_query($sql2);
						while ($res = mysql_fetch_array($query2)){
							echo $res['total']; ?>,<?php
						}
						?>],
                        color: colors[3]
                    }
                }, {
                    y: <?php
					$tgl1 = explode("-",$_POST['periode1']);
					$tgl2 = explode("-",$_POST['periode2']);
					$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
					$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
					$sql2   = "SELECT sum(total_pembelian) as total from faktur_pembelian WHERE month(tgl_faktur_pembelian)='10' AND tgl_faktur_pembelian between '".$strtgl1."' AND '".$strtgl2."'";
					$query2 = mysql_query($sql2);
					$res = mysql_fetch_array($query2);
					echo $res['total'];
					?>,
                    color: colors[4],
                    drilldown: {
                        name: 'Bulan Oktober',
                        categories: [<?php 
						$tgl1 = explode("-",$_POST['periode1']);
						$tgl2 = explode("-",$_POST['periode2']);
						$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
						$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
						$sql2   = "SELECT DISTINCT(DATE_FORMAT(tgl_faktur_pembelian,'%d-%m-%Y')) as tgl from faktur_pembelian where month(tgl_faktur_pembelian)='10' AND tgl_faktur_pembelian between '".$strtgl1."' AND '".$strtgl2."'";
						$query2 = mysql_query($sql2);
						while ($res = mysql_fetch_array($query2)){
							?>'<?php echo $res['tgl']; ?>',<?php
						}
						?>],
                        data: [<?php
						$tgl1 = explode("-",$_POST['periode1']);
						$tgl2 = explode("-",$_POST['periode2']);
						$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
						$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
						$sql2   = "SELECT DATE_FORMAT(tgl_faktur_pembelian,'%d-%m-%Y') AS tgl,sum(total_pembelian) as total from faktur_pembelian WHERE month(tgl_faktur_pembelian)='10' AND tgl_faktur_pembelian between '".$strtgl1."' AND '".$strtgl2."' group by tgl_faktur_pembelian";
						$query2 = mysql_query($sql2);
						while ($res = mysql_fetch_array($query2)){
							echo $res['total']; ?>,<?php
						}
						?>],
                        color: colors[4]
                    }
                }];
    
        function setChart(name, categories, data, color) {
			chart.xAxis[0].setCategories(categories, false);
			chart.series[0].remove(false);
			chart.addSeries({
				name: name,
				data: data,
				color: color || 'white'
			}, false);
			chart.redraw();
        }
    
        var chart = $('#container2').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Pembelian Periode <?php echo $_POST['periode1']." sampai ".$_POST['periode2']; ?>'
            },
            subtitle: {
                text: 'Klik kolom untuk melihat informasi pembelian lebih detail. Klik lagi untuk kembali.'
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Jumlah Pembelian (Rp.)'
                }
            },
            plotOptions: {
                column: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                var drilldown = this.drilldown;
                                if (drilldown) { // drill down
                                    setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                } else { // restore
                                    setChart(name, categories, data);
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        color: colors[0],
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            return;
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = 'Total Pembelian :<b> Rp. '+ this.y +'</b><br/>';
                    if (point.drilldown) {
                        s += 'Klik untuk lebih detail';
                    } else {
                        s += 'Klik untuk kembali';
                    }
                    return s;
                }
            },
            series: [{
                name: name,
                data: data,
                color: 'white'
            }],
            exporting: {
                enabled: false
            }
        })
        .highcharts(); // return chart
    });
</script>
</head>
<body>
<?php
$tgl = date('d-m-Y');
	echo "
	<form method=POST action='?page=dashboard' >
	<br><div>
      <span>Periode</span>
	  <input type=text name='periode1' id='periode1' value='$tgl' > &nbsp; s/d &nbsp; <input type=text name='periode2' id='periode2' value='$tgl'>
	  <br><br>
	  <input type=submit value='     Proses     ' name='btnProses' >
	</div>
	</form>";
	if($_POST['btnProses']){
		echo "<br><div id='container1'></div>";
		echo "<br><div id='container2'></div>";
	}	
?>
</body>
</html>