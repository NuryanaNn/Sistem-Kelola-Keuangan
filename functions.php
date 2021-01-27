<?php
// Bagian Function Kategori
$conn = mysqli_connect("localhost", "root", "", "db_kelola_uang");

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data)
{
	global $conn;
	$nama_kategori = htmlspecialchars($data["nama_kategori"]);

	//insert data
	$query = "INSERT INTO kategori
			VALUES
			('','$nama_kategori')
			";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}


//Hapus data barang
function hapus($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM kategori WHERE id = $id");


	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	global $conn;

	$id = $data['id'];
	$nama_kategori = htmlspecialchars($data["nama_kategori"]);

	$query = "UPDATE kategori SET 
			id = '$id',
			nama_kategori = '$nama_kategori'

			WHERE id = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// Akhir Bagian Kategori

// Bagian Transaksi
function tambahtransaksi($data)
{
	global $conn;
	$tanggal = htmlspecialchars($data["tanggal"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$keterangan = htmlspecialchars($data["keterangan"]);
	$jenis = ($data["jenis"]);

	//insert data
	$query = "INSERT INTO transaksi
			VALUES
			('','$tanggal', '$kategori', '$keterangan', '$jenis')
			";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}


//Hapus data barang
function hapustransaksi($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");


	return mysqli_affected_rows($conn);
}

function ubahtransaksi($data)
{
	global $conn;

	$id = $data['id'];
	$tanggal = htmlspecialchars($data["tanggal"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$keterangan = htmlspecialchars($data["keterangan"]);
	$jenis = htmlspecialchars($data["jenis"]);

	$query = "UPDATE transaksi SET 
			id = '$id',
			tanggal = '$tanggal',
			kategori = '$kategori',
			keterangan = '$keterangan', 
			jenis = '$jenis'

			WHERE id = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
// Akhir Bagian Transaksi

// Bagian Utang

// Bagian Transaksi
function tambahutang($data)
{
	global $conn;
	$kode = htmlspecialchars($data["kode"]);
	$tanggal = htmlspecialchars($data["tanggal"]);
	$keterangan = htmlspecialchars($data["keterangan"]);
	$nominal = htmlspecialchars($data["nominal"]);

	//insert data
	$query = "INSERT INTO utang
			VALUES
			('','$kode', '$tanggal', '$keterangan', '$nominal')
			";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}


//Hapus data barang
function hapusutang($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM utang WHERE id = $id");


	return mysqli_affected_rows($conn);
}

function ubahutang($data)
{
	global $conn;

	$id = $data['id'];
	$kode = htmlspecialchars($data["kode"]);
	$tanggal = htmlspecialchars($data["tanggal"]);
	$keterangan = htmlspecialchars($data["keterangan"]);
	$nominal = htmlspecialchars($data["nominal"]);

	$query = "UPDATE utang SET 
			id = '$id',
			kode = '$kode',
			tanggal = '$tanggal',
			keterangan = '$keterangan', 
			nominal = '$nominal'

			WHERE id = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
