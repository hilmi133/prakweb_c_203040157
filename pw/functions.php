<?php  

function koneksi()
{
	return mysqli_connect('localhost', 'root', '', 'prakweb_c_203040157');
}

function query($query)
{
	$conn = koneksi();

	$result = mysqli_query($conn, $query);

	// Jika hasilnya hanya 1 data
	if (mysqli_num_rows($result) == 1) {
		return mysqli_fetch_assoc($result);
	}

	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}

function tambah($data)
{
	$conn = koneksi();

	$judul_buku = htmlspecialchars($data['nama_buku']);
	$penerbit = htmlspecialchars($data['penerbit']);
	$gambar = htmlspecialchars($data['gambar']);
	$query = "INSERT INTO
	            buku
	            VALUES
	          (null, '$nama_buku', '$penerbit', '$gambar');
	          ";
	mysqli_query($conn, $query);
	
	return mysqli_affected_rows($conn);
}

function hapus($id)
{
	$conn = koneksi();
	mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die(mysqli_query($conn));
	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	$conn = koneksi();

	$id = ($data['id']);
	$judul_buku = htmlspecialchars($data['judul_buku']);
	$penerbit = htmlspecialchars($data['penerbit']);
	$gambar= htmlspecialchars($data['gambar']);
	
	$query = "UPDATE buku SET
				judul_buku = '$judul_buku',
				penerbit = '$penerbit',
				gambar = '$gambar'
				WHERE id = $id";
	mysqli_query($conn, $query) or die(mysqli_error($conn));
	
	return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $conn = koneksi();

  $query = "SELECT * FROM buku
              WHERE 
            judul_buku LIKE '%$keyword%' OR
            penerbit LIKE '%$keyword%'
            ";

  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}
?>