<?php

include "config/koneksi.php";
$page = $_GET['page'];

if ($page=="home" && $_SESSION['level']=="admin"){
echo '
<h6 class="red">Home</h6>		
<br />
<p>Selamat datang di halaman Admnistrator PT. Citra Agro Buana Semesta.<br>
Silahkan pilih menu untuk melakukan pengolahan data.</p>
';
}
if ($page=="home" && $_SESSION['level']=="kabag"){
echo '
<h6 class="red">Home</h6>		
<br />
<p>Selamat datang di halaman Kepala Bagian PT. Citra Agro Buana Semesta.<br>
Silahkan pilih menu untuk melakukan pengolahan data.</p>
';
}
if ($page=="pengguna"){
include "page/page_pengguna/pengguna.php";
}
if ($page=="pembeli"){
include "page/page_pembeli/pembeli.php";
}
if ($page=="sapi"){
include "page/page_sapi/sapi.php";
}
if ($page=="jenis"){
include "page/page_jenis/jenis.php";
}
if ($page=="penyuplai"){
include "page/page_penyuplai/penyuplai.php";
}
if ($page=="penjualan"){
include "page/page_penjualan/penjualan.php";
}
if ($page=="pembelian"){
include "page/page_pembelian/pembelian.php";
}
if ($page=="dashboard"){
include "page/page_dashboard/dashboard.php";
}
if ($page=="laporan"){
include "page/page_laporan/laporan.php";
}
if ($page=="password"){
include "password.php";
}
?>