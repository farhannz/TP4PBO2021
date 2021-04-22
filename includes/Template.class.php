<?php

/******************************************
PRAKTIKUM RPL
 ******************************************/

class Template{
	var $filename = ''; // handle file
	var $content = ''; // handle isi file

	function Template($filename = ''){
		// konstruktor
		$this->filename = $filename;

		// membaca file tampilan
		$this->content = implode('', @file($filename));
	}

	function clear(){
		// membersihkan isi kode yang seharusnya diganti
		// mengganti tulisan Data_... dengan kosong jika ada yang lupa untuk diganti
		// jika  tidak ingin menggunakan kode DATA_... dapat diganti di bagian pola ekspresi reguler
		$this->content = preg_replace("/DATA_[A-Z|_|0-9]+/", "", $this->content);

	}

	function write(){
		// menulis isi file ke layar
		// menghapus DATA_ yang belum diganti
		$this->clear();
		// tampilkan tampilan yang telah diganti ke layar
		print $this->content;

	}

	function getContent(){
		// mengambil isi file yang sudah di proses
		// mengahpus DATA_..  yang belum diganti
		$this->clear();

		// mengembalikan isi tampilan
		return $this->content;
	}

	function isiForm($nama,$email,$alamat,$kota,$provinsi,$kelas){
		echo "
			<script>
				document.getElementsByName('tname')[0].value = '{$nama}';
				document.getElementsByName('temail')[0].value = '{$email}';
				document.getElementsByName('talamat')[0].value = '{$alamat}';
				document.getElementsByName('tkota')[0].value = '{$kota}';
				document.getElementsByName('tprovinsi')[0].value = '{$provinsi}';
				// console.log(document.getElementsByName('tsubject').value);
				radios = document.getElementsByName('tsubject');
				for (var j = 0; j < radios.length; j++) {
					if (radios[j].value == '{$kelas}') {
						radios[j].checked = true;
						break;
					}
				}
			</script>
			";
	}

	function replace($old = '', $new = ''){
		// mengganti kode dalam file (DATA_...)
		// pemrosesan nilai yang akan menggantikan
		if(is_int($new)){
			// jika penggantinya bilangan bulat (diubah ke formatnya ke teks)
			$value = sprintf("%d", $new);

		}elseif(is_float($new)){
			// jika penggantinya bilangan real *diubah formatnya ke teks
			$value = sprintf("%f", $new);
		}elseif(is_array($new)){
			// jika penggantinya bilangan array/tabel *diubah formatnya ke teks
			$value = '';
			// pemrosesan setiap elemen array/tabel
			foreach( $new as $item){
				$value .= $item. '';
			}

		}else{
			// jika selain tipe yang ada diatas maka langsung diisikan untuk menggantikan
			$value = $new;
		}

		// menggantikan suatu teks dengan teks baru (misal DATA_... diganti dengan <table> </table>)
		$this->content = preg_replace("/$old/",  $value, $this->content);

	}
}

 ?>