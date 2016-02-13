<li><a href="main.php?page=home" <?php if($_GET['page']=="home") { echo 'class="active"'; } ?>><span>Home</span></a></li>
<?php
$page = $_GET['page'];
if ($_SESSION[level]=="admin") {
?>
<li><a href="main.php?page=pengguna" <?php if($_GET['page']=="pengguna") { echo 'class="active"'; } ?>><span>Data Pengguna</span></a></li>
<li><a href="main.php?page=pembeli" <?php if($_GET['page']=="pembeli") { echo 'class="active"'; } ?>><span>Data Pembeli</span></a></li>
<li><a href="main.php?page=penyuplai" <?php if($_GET['page']=="penyuplai") { echo 'class="active"'; } ?>><span>Data Penyuplai</span></a></li>
<li><a href="main.php?page=jenis" <?php if($_GET['page']=="jenis") { echo 'class="active"'; } ?>><span>Data Jenis</span></a></li>
<li><a href="main.php?page=sapi" <?php if($_GET['page']=="sapi") { echo 'class="active"'; } ?>><span>Data Sapi</span></a></li>
<li><a href="main.php?page=pembelian" <?php if($_GET['page']=="pembelian") { echo 'class="active"'; } ?>><span>Data Pembelian</span></a></li>
<li><a href="main.php?page=penjualan" <?php if($_GET['page']=="penjualan") { echo 'class="active"'; } ?>><span>Data Penjualan</span></a></li>
<?php
}
else if ($_SESSION[level]=="kabag") {
?>
<li><a href="main.php?page=dashboard" <?php if($_GET['page']=="dashboard") { echo 'class="active"'; } ?>><span>Dashboard</span></a></li>
<li><a href="main.php?page=laporan" <?php if($_GET['page']=="laporan") { echo 'class="active"'; } ?>><span>Laporan</span></a></li>
<?php
}
?>