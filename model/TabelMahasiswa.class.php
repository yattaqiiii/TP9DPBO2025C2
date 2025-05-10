<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

// Kelas yang berisikan tabel dari mahasiswa
class TabelMahasiswa extends DB
{
	function getMahasiswa()
	{
		// Query mysql select data mahasiswa
		$query = "SELECT * FROM mahasiswa";
		
		// Mengeksekusi query
		return $this->execute($query);
	}
	function getMahasiswaByID($id)
    {
        $query = "SELECT * FROM mahasiswa WHERE id = $id";
        return $this->execute($query);
    }

    function add($data)
    {
        // Lengkapi Query
        $nim = $data['nim'];
        $nama = $data['nama'];
        $tempat = $data['tempat'];
        $tl = $data['tl'];
        $gender = $data['gender'];
        $email = $data['email'];
        $telp = $data['telp'];
        
        $query = "INSERT INTO mahasiswa values ('', '$nim', '$nama', '$tempat', '$tl', '$gender', '$email', '$telp')";
        
        // Mengeksekusi query
        return $this->execute($query);
    }
    
    function delete($id)
    {
        // Lengkapi Query
        $query = "DELETE from mahasiswa WHERE id = '$id'";
        
        // Mengeksekusi query
        return $this->execute($query);
    }
    
    // Perbaikan fungsi edit pada class TabelMahasiswa
    function edit($data)
    {
        $id = $data['id'];
        $nim = $data['nim'];
        $nama = $data['nama'];
        $tempat = $data['tempat'];
        $tl = $data['tl'];
        $gender = $data['gender'];
        $email = $data['email'];
        $telp = $data['telp'];
        
        // Hapus koma pada bagian akhir SET clause sebelum WHERE
        $query = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', tempat = '$tempat', tl = '$tl', gender = '$gender', email = '$email', telp = '$telp' WHERE id = '$id'";
        
        // Mengeksekusi query
        return $this->execute($query);
    }
}
