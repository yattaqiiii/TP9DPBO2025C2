<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
	private $prosesmahasiswa; // Presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosesmahasiswa = new ProsesMahasiswa();
	}

	function tampil()
	{
		$this->prosesmahasiswa->prosesDataMahasiswa();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosesmahasiswa->getNim($i) . "</td>
			<td>" . $this->prosesmahasiswa->getNama($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTl($i) . "</td>
			<td>" . $this->prosesmahasiswa->getGender($i) . "</td>
			<td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTelp ($i) . "</td> 
			<td>
                  <a href='index.php?id_edit=" . $this->prosesmahasiswa->getID($i) .  "' class='btn btn-warning mb-2 mb-md-0 mb-lg-0 mb-xl-0' '>Edit</a>
                  <a href='index.php?id_hapus=" . $this->prosesmahasiswa->getID($i) . "' class='btn btn-danger' '>Hapus</a>
            </td></tr>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function renderFormEdit($data)
	{
		// Data yang dikembalikan adalah baris tunggal dari hasil database
		$id = $data['id'];
		$nim = $data['nim'];
		$nama = $data['nama'];
		$tempat = $data['tempat'];
		$tl = $data['tl'];
		$gender = $data['gender'];
		$email = $data['email'];
		$telp = $data['telp'];
		
		$tpl = new Template("templates/editjir.html");
		$tpl->replace("DATA_ID", $id);
		$tpl->replace("DATA_nim", $nim);
		$tpl->replace("DATA_nama", $nama);
		$tpl->replace("DATA_tempat", $tempat);
		$tpl->replace("DATA_tl", $tl);
		
		// Handle gender selection
		if ($gender == "Laki-laki") {
			$tpl->replace("DATA_gender_laki", "selected");
			$tpl->replace("DATA_gender_perempuan", "");
		} else {
			$tpl->replace("DATA_gender_laki", "");
			$tpl->replace("DATA_gender_perempuan", "selected");
		}
		
		$tpl->replace("DATA_email", $email);
		$tpl->replace("DATA_telp", $telp);
		$tpl->write();
	}
		
	function add($data){
		$this->prosesmahasiswa->add($data);
		header("location:index.php");
	}

	function edit($data){
		$this->prosesmahasiswa->edit($data);
		header("location:index.php");
	}

	function Tampilformedit($id){
		$this->prosesmahasiswa->formEdit($id);
	}
	
	function delete($id){
		$this->prosesmahasiswa->delete($id);
		header("location:index.php");
	}

}
