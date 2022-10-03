<?php  
require 'functions.php';

// query isi tabel
$buku = query("SELECT * FROM buku");

if (isset($_POST['cari'])) {
	$buku = cari($_POST['keyword']);
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar Buku</title>
	<!-- CSS only -->
	<link rel="stylesheet" href="style.css">
<body class ="center" >
	<h3 >Daftar Buku</h3>
	<a href="tambah.php">Tambah data Buku</a>
		<br><br>

		<form action="" method="post">
			<input type="text" name="keyword" size="60" placeholder="masukkan keyword pencarian..." autocomplete="off" autofocus>
			<button type="submit" name="cari">Cari!</button>
		</form>
		<br>

	<table border="1" cellpadding="10" cellspacing="0s">
		<tr>
			<th>No</th>
			<th>Judul Buku</th>
			<th>Pengarang</th>
            <th>Gambar</th>
			<th>opsi</th>
		</tr>
		<?php if(empty($buku)) : ?>
		<tr>
			<td colspan="4">
				<p style="color: red; font-style: italic;">data mahasiswa tidak ditemukan!</p>
			</td>
		</tr>
		<?php endif; ?>

		<?php $i = 1; 
		foreach($buku as $bk) : ?>
		<tr>
			<td><?= $i++; ?></td>
            <td><?= $bk['judul_buku']; ?></td>
            <td><?= $bk['penerbit']; ?></td>
			<td><img src="assets/<?= $bk['gambar']; ?>" width = "80"></td>
			<td>
				<a href="ubah.php?id=<?= $bk['id']; ?>">ubah</a>
				<a href="hapus.php?id=<?= $bk['id']; ?>">hapus</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>