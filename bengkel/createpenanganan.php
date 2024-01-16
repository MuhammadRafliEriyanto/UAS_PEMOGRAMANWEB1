<!DOCTYPE html>
<html>
<head>
    <title>Input Penanganan</title>
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

        // Ambil data montir dari database
        $query_montir = "SELECT id_montir, nama FROM montir";
        $result_montir = mysqli_query($kon, $query_montir);

        // Cek apakah form telah disubmit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Ambil ID Penanganan terakhir dan tambahkan satu
            $query_last_id = "SELECT MAX(id) AS last_id FROM penanganan";
            $result_last_id = mysqli_query($kon, $query_last_id);
            $row_last_id = mysqli_fetch_assoc($result_last_id);
            $next_penanganan_id = $row_last_id['last_id'] + 1;

            $tanggal = input($_POST["tanggal"]);
            $keluhan = input($_POST["keluhan"]);
            $penanggungjawab_id = input($_POST["penanggungjawab"]);
            $kendaraan_id = input($_POST["kendaraan_id"]); // Menggunakan input manual dari pengguna

            // Ambil nama montir berdasarkan id
            $query_nama_montir = "SELECT nama FROM montir WHERE id_montir = '$penanggungjawab_id'";
            $result_nama_montir = mysqli_query($kon, $query_nama_montir);
            $row_nama_montir = mysqli_fetch_assoc($result_nama_montir);
            $penanggungjawab_nama = $row_nama_montir['nama'];

            // Query input menginput data ke dalam tabel penanganan
            $sql = "INSERT INTO penanganan (id, tanggal, keluhan, penanggungjawab, montir_id_montir, kendaraan_id_kendaraan) VALUES ('$next_penanganan_id', '$tanggal', '$keluhan', '$penanggungjawab_nama', '$penanggungjawab_id', '$kendaraan_id')";

            // Mengeksekusi/menjalankan query di atas
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
            if ($hasil) {
                echo "<div class='alert alert-success'>Data Berhasil disimpan.</div>";
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>

        <h2>Input Penanganan</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" id="penangananForm">
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="keluhan">Keluhan:</label>
                <input type="text" name="keluhan" id="keluhan" class="form-control" placeholder="Masukkan Keluhan" required />
            </div>
            <div class="form-group">
                <label for="penanggungjawab">Penanggungjawab:</label>
                <select name="penanggungjawab" id="penanggungjawab" class="form-control" required>
                    <?php
                    while ($row_montir = mysqli_fetch_assoc($result_montir)) {
                        echo "<option value='{$row_montir['id_montir']}'>{$row_montir['nama']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kendaraan_id">ID Kendaraan:</label>
                <input type="text" name="kendaraan_id" id="kendaraan_id" class="form-control" value="" />
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="penangananhome.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
