<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

interface KontrakView{
	public function tampil();
	public function add($data);
	public function edit($data);
	public function delete($data);
	public function Tampilformedit($id);
}
?>