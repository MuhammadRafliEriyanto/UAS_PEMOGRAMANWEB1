<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Kubikasi Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    // Include file koneksi untuk menghubungkan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_kubikasi = input($_POST["id_kubikasi"]); // Sesuaikan dengan nama input yang digunakan pada form
        $besar_tenaga = input($_POST["besar_tenaga"]); // Sesuaikan dengan nama input yang digunakan pada form

        // Query input untuk menyimpan data ke dalam tabel kubikasi
        $sql = "INSERT INTO kubikasi (id_kubikasi, besar_tenaga) VALUES ('$id_kubikasi', '$besar_tenaga')";

        // Mengeksekusi/menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:kubikasihome.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Input Data Kubikasi Kendaraan</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>ID Kubikasi:</label>
            <input type="text" name="id_kubikasi" class="form-control" placeholder="Masukkan ID Kubikasi" required/>
        </div>
        <div class="form-group">
            <label>Besar Tenaga:</label>
            <input type="text" name="besar_tenaga" class="form-control" placeholder="Masukkan Besar Tenaga" required/>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
