<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	function getTask($sort){
		// Query mysql select data ke tb_to_do
		$query = "";
		switch($sort){
			// reset
			case 0:
				$query = "SELECT * FROM data";
				return $this->execute($query);
				break;
			// subject
			case 1:
				$query = "SELECT * FROM data ORDER BY nama ASC";
				return $this->execute($query);
				break;
			// priority
			case 2:
				$query = "SELECT * FROM data ORDER BY kota ASC" ;
				return $this->execute($query);
				break;
			// deadline
			case 3:
				$query = "SELECT * FROM data ORDER BY provinsi ASC";
				return $this->execute($query);
				break;
			// status
			case 4:
				$query = "SELECT * FROM data ORDER BY kelas ASC";
				return $this->execute($query);
				break;
		}

		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function getData($id){
		$query = "SELECT * FROM data WHERE id = {$id} limit 1";
		return $this->execute($query);
	}

	// delete data
	function delete($id){
		$query = "DELETE FROM data WHERE id = {$id}";
		$this->execute($query);
	}


	function updateData($id,$nama,$email,$alamat,$kota,$provinsi,$kelas){
		$query = "UPDATE data SET nama = '{$nama}',email = '{$email}',alamat = '{$alamat}',kota = '{$kota}',provinsi = '{$provinsi}',kelas = '{$kelas}' WHERE id = {$id} ";
		$this->execute($query);
	}

	function insertData($nama,$email,$alamat,$kota,$provinsi,$kelas){
		$query = "INSERT INTO data (nama,email,alamat,kota,provinsi,kelas) 
		VALUES('{$nama}','{$email}','{$alamat}','{$kota}','{$provinsi}','{$kelas}')";

		$this->execute($query);
	}

}



?>
