<!DOCTYPE html>
<html>
<head>
    <title>Input Jenis Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php
        // Include file koneksi, untuk koneksikan ke database
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
            $id_jenis = input($_POST["id_jenis"]);
            $jenis_kendaraan = input($_POST["jenis_kendaraan"]);

            // Query input menginput data ke dalam tabel jenis
            $sql = "INSERT INTO jenis (id_jenis, jenis_kendaraan) VALUES ('$id_jenis', '$jenis_kendaraan')";

            // Mengeksekusi/menjalankan query di atas
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
            if ($hasil) {
                header("Location: jenishome.php");
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>

        <h2>Input Jenis Kendaraan</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>ID Jenis:</label>
                <input type="text" name="id_jenis" class="form-control" placeholder="Masukkan ID Jenis" required />
            </div>
            <div class="form-group">
                <label>Jenis Kendaraan:</label>
                <input type="text" name="jenis_kendaraan" class="form-control" placeholder="Masukkan Jenis Kendaraan" required/>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
