<?php
define('DB_NAMA', 'c0dentamedica'); // sesuaikan dengan nama database anda
define('DB_USER', 'tes'); // sesuaikan dengan nama pengguna database anda
define('DB_PASSWORD', 'Imma1234'); // sesuaikan dengan kata sandi database anda
define('DB_HOST', 'localhost'); // ganti jika letak database mysql di komputer lain

// fungsi untuk melakukan koneksi ke database mysql
function koneksi_buka() {
	mysql_select_db(DB_NAMA,mysql_connect(DB_HOST,DB_USER,DB_PASSWORD));
}

// fungsi untuk menutup koneksi ke database mysql
function koneksi_tutup() {
	mysql_close(mysql_connect(DB_HOST,DB_USER,DB_PASSWORD));
}
?>
