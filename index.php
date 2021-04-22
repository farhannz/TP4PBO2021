<?php

/******************************************
PRAKTIKUM RPL
******************************************/
//  Saya Farhan Nurzaman mengerjakan evaluasi Tugas Praktikum 4 DPBO 
//  dalam mata kuliah Desain dan Pemrograman Berorientasi Objek 
//  untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. 
//  Aamiin.

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$sort = 0;

if(isset($_POST['resetsort'])) $sort = 0;
if(isset($_POST['nama'])) $sort = 1;
if(isset($_POST['kota'])) $sort = 2;
if(isset($_POST['provinsi'])) $sort = 3;
if(isset($_POST['kelas'])) $sort = 4;


$otask->getTask($sort);

// Proses mengisi tabel dengan data
$data = null;
$no = 1;



while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	$data .= "<tr>
	<td>" . $no . "</td>
	<td>" . $tname . "</td>
	<td>" . $tdetails . "</td>
	<td>" . $tsubject . "</td>
	<td>" . $tpriority . "</td>
	<td>" . $tdeadline . "</td>
	<td>" . $tstatus . "</td>
	<td>
	<button class='btn btn-danger' name='hapus' id ='hapus'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
	<button class='btn btn-primary' name='edit' id ='edit'><a href='edit.php?id_edit=" . $id . "' style='color: white; font-weight: bold;'>Edit</a></button>
	</td>
	</tr>";
	$no++;
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);


if(isset($_POST['add'])){
	$nama = $_POST['tname'];
	$email = $_POST['temail'];
	$alamat = $_POST['talamat'];
	$kota = $_POST['tkota'];
	$provinsi = $_POST['tprovinsi'];
	$kelas = $_POST['tsubject'];
	$otask->open();
	$otask->insertData($nama,$email,$alamat,$kota,$provinsi,$kelas);
	$otask->close();
	header("Location:index.php");
}
if(isset($_GET['id_hapus'])){
	$otask->open();
	$otask->delete($_GET['id_hapus']);
	$otask->close();
	header("Location:index.php");
}


// Menampilkan ke layar
$tpl->write();