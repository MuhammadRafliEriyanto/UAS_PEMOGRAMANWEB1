<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_kendaraan = input($_POST["id_kendaraan"]);
        $nopol = input($_POST["nopol"]);
        $nama_kendaraan = input($_POST["nama_kendaraan"]);
        $warna = input($_POST["warna"]);
        $merk_id_merk = input($_POST["merk_id_merk"]);
        $kubikasi_id_kubikasi = input($_POST["kubikasi_id_kubikasi"]);
        $jenis_id_jenis = input($_POST["jenis_id_jenis"]);
        $transmisi_id_transmisi = input($_POST["transmisi_id_transmisi"]);

        //Query input menginput data kedalam tabel kendaraan
        $sql = "INSERT INTO kendaraan (id_kendaraan, nopol, nama_kendaraan, warna, merk_id_merk, kubikasi_id_kubikasi, jenis_id_jenis, transmisi_id_transmisi) VALUES
		('$id_kendaraan', '$nopol', '$nama_kendaraan', '$warna', '$merk_id_merk', '$kubikasi_id_kubikasi', '$jenis_id_jenis', '$transmisi_id_transmisi')";

        //Mengeksekusi/menjalankan query diatas
        $hasil = mysqli_query($kon, $sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:kendaraanhome.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Input Data Kendaraan</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>ID Kendaraan:</label>
            <input type="text" name="id_kendaraan" class="form-control" placeholder="Masukkan ID Kendaraan" required />
        </div>
        <div class="form-group">
            <label>No Pol:</label>
            <input type="text" name="nopol" class="form-control" placeholder="Masukkan Nomor Polisi" required />
        </div>
        <div class="form-group">
            <label>Nama Kendaraan:</label>
            <input type="text" name="nama_kendaraan" class="form-control" placeholder="Masukkan Nama Kendaraan" required/>
        </div>
        <div class="form-group">
            <label>Warna :</label>
            <input type="text" name="warna" class="form-control" placeholder="Masukkan Warna Kendaraan" required/>
        </div>
        <div class="form-group">
            <label>Merk ID:</label>
            <select name="merk_id_merk" class="form-control" required>
                <!-- Mengambil data dari tabel 'merk' -->
                <?php
                $queryMerk = "SELECT * FROM merk";
                $resultMerk = mysqli_query($kon, $queryMerk);
                while ($rowMerk = mysqli_fetch_assoc($resultMerk)) {
                    echo "<option value='{$rowMerk['id_merk']}'>{$rowMerk['id_merk']} - {$rowMerk['nama_merk']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Kubikasi ID:</label>
            <select name="kubikasi_id_kubikasi" class="form-control" required>
                <!-- Mengambil data dari tabel 'kubikasi' -->
                <?php
                $queryKubikasi = "SELECT * FROM kubikasi";
                $resultKubikasi = mysqli_query($kon, $queryKubikasi);
                while ($rowKubikasi = mysqli_fetch_assoc($resultKubikasi)) {
                    echo "<option value='{$rowKubikasi['id_kubikasi']}'>{$rowKubikasi['id_kubikasi']} - {$rowKubikasi['besar_tenaga']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Jenis ID:</label>
            <select name="jenis_id_jenis" class="form-control" required>
                <!-- Mengambil data dari tabel 'jenis' -->
                <?php
                $queryJenis = "SELECT * FROM jenis";
                $resultJenis = mysqli_query($kon, $queryJenis);
                while ($rowJenis = mysqli_fetch_assoc($resultJenis)) {
                    echo "<option value='{$rowJenis['id_jenis']}'>{$rowJenis['id_jenis']} - {$rowJenis['jenis_kendaraan']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Transmisi ID:</label>
            <select name="transmisi_id_transmisi" class="form-control" required>
                <!-- Mengambil data dari tabel 'transmisi' -->
                <?php
                $queryTransmisi = "SELECT * FROM transmisi";
                $resultTransmisi = mysqli_query($kon, $queryTransmisi);
                while ($rowTransmisi = mysqli_fetch_assoc($resultTransmisi)) {
                    echo "<option value='{$rowTransmisi['id_transmisi']}'>{$rowTransmisi['id_transmisi']} - {$rowTransmisi['transmisi']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
