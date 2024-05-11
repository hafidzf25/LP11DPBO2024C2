<?php

interface KontrakView{
	public function tampil();
	public function hapus($id);
	public function tambah();
	public function ubah($id);
	public function addData($data);
	public function ubahData($data);
}

?>