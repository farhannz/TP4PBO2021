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

// Memanggil method getData
$otask->getData($_GET['id_edit']);

$abc = $otask->getResult();

// echo '<pre>';
// print_r($abc);
// echo '</pre>';


// Proses mengisi tabel dengan data
$data = null;
$no = 1;

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/edit.html");



if(isset($_POST['edit'])){

	$nama = $_POST['tname'];
	$email = $_POST['temail'];
	$alamat = $_POST['talamat'];
	$kota = $_POST['tkota'];
	$provinsi = $_POST['tprovinsi'];
	$kelas = $_POST['tsubject'];
	$otask->open();
	$otask->updateData($_GET['id_edit'],$nama,$email,$alamat,$kota,$provinsi,$kelas);
	$otask->close();
	header("Location:index.php");
}
if(isset($_POST['kembali']))
    header("Location:index.php");

// Menampilkan ke layar
$tpl->write();
$tpl->isiForm($abc['nama'],$abc['email'],$abc['alamat'],$abc['kota'],$abc['provinsi'],$abc['kelas']);
// echo"
// <script>
//     document.getElementsByName('tname')[0].value = '{$abc['nama']}';
//     document.getElementsByName('temail')[0].value = '{$abc['email']}';
//     document.getElementsByName('talamat')[0].value = '{$abc['alamat']}';
//     document.getElementsByName('tkota')[0].value = '{$abc['kota']}';
//     document.getElementsByName('tprovinsi')[0].value = '{$abc['provinsi']}';
//     // console.log(document.getElementsByName('tsubject').value);
//     radios = document.getElementsByName('tsubject');
//     for (var j = 0; j < radios.length; j++) {
//         if (radios[j].value == '{$abc['kelas']}') {
//             radios[j].checked = true;
//             break;
//         }
//     }
// </script>
// ";