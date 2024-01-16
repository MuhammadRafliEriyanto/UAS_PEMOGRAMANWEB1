<!DOCTYPE html>
<html>
<head>
    <title>Update Data Penanganan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php
        include "koneksi.php";

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $data = []; // Inisialisasi $data sebagai array kosong

        if (isset($_GET['id'])) {
            $id_penanganan = input($_GET["id"]);

            $sql = "SELECT * FROM penanganan WHERE id=$id_penanganan";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil && mysqli_num_rows($hasil) > 0) {
                $data = mysqli_fetch_assoc($hasil);
                // Tampilkan formulir untuk mengupdate data
                ?>
                <h2>Update Data Penanganan</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label>Tanggal:</label>
                        <input type="date" name="tanggal" class="form-control" value="<?php echo $data['tanggal'] ?? ''; ?>" required />
                    </div>
                    <!-- Tambahkan input lain sesuai kebutuhan -->
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?? ''; ?>" />
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>
                <?php
            } else {
                echo "<div>Data tidak ditemukan.</div>";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lakukan penanganan data yang di-submit
        }
        ?>
    </d
