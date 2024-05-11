<?php

include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelp($i) . "</td>
			<td> <a class='btn btn-success' href='index.php?id_edit=" . $i . "'>Edit</a>
			<a class='btn btn-danger' href='index.php?id_hapus=" . $this->prosespasien->getId($i) . "'>Delete</a>
			</td>";
		}

		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function hapus($id)
	{
		$this->prosespasien->prosesDeleteData($id);
	}

	function tambah()
	{
		$data = null;

		$data .= '<form method="post" action="index.php">
        <br><br>
        <div class="card">
    
            <div class="card-header bg-primary">
            <h1 class="text-white text-center"> Tambah Data Pasien </h1>
            </div><br>
    
            <label> NIK: </label>
            <input type="text" name="nik" class="form-control" required> <br>
    
            <label> NAMA: </label>
            <input type="text" name="nama" class="form-control" required> <br>

            <label> TEMPAT: </label>
            <input type="text" name="tempat" class="form-control" required> <br>

            <label> TANGGAL LAHIR: </label>
            <input type="date" name="tl" class="form-control" required> <br>
            
            
            <label> GENDER: </label>
            <select required class="form-control" required name="gender" id="exampleFormControlSelect1">
				<option value="Laki-laki">Laki - Laki</option>
				<option value="Perempuan">Perempuan</option>
            </select> <br>

            <label> EMAIL: </label>
            <input type="text" name="email" class="form-control" required> <br>

            <label> NOMOR TELEPON: </label>
            <input type="text" name="telp" class="form-control" required> <br>
    
            <button class="btn btn-success" type="submit" name="add"> Submit </button><br>
            <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>
    
        </div>
        </form>';

		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("ISI_FORM", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function ubah($id)
	{
		// $this->prosespasien->prosesEditData($id);
		$this->prosespasien->prosesDataPasien();
		$data = null;

		$data .= '<form method="post" action="index.php">
        <br><br>
        <div class="card">
    
            <div class="card-header bg-primary">
            <h1 class="text-white text-center"> Ubah Data Pasien </h1>
            </div><br>

			<input type="hidden" name="id" value="' . $this->prosespasien->getId($id) . '" class="form-control"> <br>
    
            <label> NIK: </label>
            <input type="text" name="nik" value="'. $this->prosespasien->getNik($id) .'" class="form-control" required> <br>
    
            <label> NAMA: </label>
            <input type="text" name="nama" value="'. $this->prosespasien->getNama($id) .'" class="form-control" required> <br>

            <label> TEMPAT: </label>
            <input type="text" name="tempat" value="'. $this->prosespasien->getTempat($id) .'" class="form-control" required> <br>

            <label> TANGGAL LAHIR: </label>
            <input type="date" name="tl" class="form-control" value="'. $this->prosespasien->getTl($id) .'" required> <br>
            
            <label> GENDER: </label>
            <select required class="form-control" required name="gender" id="exampleFormControlSelect1">';
			
			$listGender = ['Laki-laki', "Perempuan"];

			foreach ($listGender as $gender) {
				if ($gender == $this->prosespasien->getGender($id)) { // jika group id dari database adalah group id pilihan user yang mau di update maka group id itu akan dikecualikan
				$data .= '<option value="' . $gender . '" selected>' . $gender . '</option>';
				} else {
				$data .= '<option value="' . $gender . '">' . $gender . '</option>';
				}
			}
			$data .= '
            </select> <br>

            <label> EMAIL: </label>
            <input value="'. $this->prosespasien->getEmail($id) .'" type="text" name="email" class="form-control" required> <br>

            <label> NOMOR TELEPON: </label>
            <input type="text" name="telp" value="'. $this->prosespasien->getTelp($id) .'" class="form-control" required> <br>
    
            <button class="btn btn-success" type="submit" name="edit"> Submit </button><br>
            <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>
    
        </div>
        </form>';

		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("ISI_FORM", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function addData($data) {
		$this->prosespasien->prosesTambahData($data);
	}

	function ubahData($data) {
		$this->prosespasien->prosesUbahData($data);
	}
}
