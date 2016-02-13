<?php
require_once "../config/koneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "
SELECT * FROM sapi join jenis using(kode_jenis_sapi) where keterangan_sapi LIKE '%$q%' or kode_sapi LIKE '%$q%'
";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['kode_sapi'] . " - " . $rs['keterangan_sapi'];
	echo "$cname\n";
}
?>