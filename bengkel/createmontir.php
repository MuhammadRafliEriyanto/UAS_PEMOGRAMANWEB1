<!DOCTYPE html>
<html>
<head>
    <title>Input Montir</title>
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
            $id_montir = input($_POST["id_montir"]);
            $nama = input($_POST["nama"]);

            // Query input menginput data ke dalam tabel jenis
            $sql = "INSERT INTO montir (id_montir, nama) VALUES ('$id_montir', '$nama')";

            // Mengeksekusi/menjalankan query di atas
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
            if ($hasil) {
                header("Location: montirhome.php");
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>

        <h2>Input Montir</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>ID Montir:</label>
                <input type="text" name="id_montir" class="form-control" placeholder="Masukkan ID Montir" required />
            </div>
            <div class="form-group">
                <label>Nama Montir:</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Montir" required/>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
