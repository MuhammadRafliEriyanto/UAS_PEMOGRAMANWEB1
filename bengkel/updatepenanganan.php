<!DOCTYPE html>
<html>
<head>
    <title>Update Penanganan</title>
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

        $data = []; // Deklarasi data sebagai array kosong

        if (isset($_GET['id'])) {
            $id_penanganan = input($_GET["id"]);

            $sql = "SELECT * FROM penanganan WHERE id=$id_penanganan";
            $hasil = mysqli_query($kon, $sql);

            if (!$hasil) {
                die("Gagal mengambil data: " . mysqli_error($kon));
            }

            $data = mysqli_fetch_assoc($hasil);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tanggal = input($_POST["tanggal"]);
            $keluhan = input($_POST["keluhan"]);
            $penanggungjawab = input($_POST["penanggungjawab"]);
            $montir_id = input($_POST["montir_id"]);
            $kendaraan_id = input($_POST["kendaraan_id"]);
            $id_penanganan = input($_POST["id_penanganan"]); // Memasukkan id_penanganan yang terdapat pada URL

            $sql = "UPDATE penanganan SET 
                tanggal='$tanggal',
                keluhan='$keluhan',
                penanggungjawab='$penanggungjawab',
                montir_id_montir='$montir_id',
                kendaraan_id_kendaraan='$kendaraan_id'
                WHERE id=$id_penanganan";

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: penangananhome.php");
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>

        <h2>Update Penanganan</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" required value="<?php echo isset($data['tanggal']) ? $data['tanggal'] : ''; ?>" />
            </div>
            <div class="form-group">
                <label>Keluhan:</label>
                <input type="text" name="keluhan" class="form-control" placeholder="Masukkan Keluhan" required value="<?php echo isset($data['keluhan']) ? $data['keluhan'] : ''; ?>" />
            </div>
            <div class="form-group">
                <label>Penanggungjawab:</label>
                <input type="text" name="penanggungjawab" class="form-control" placeholder="Masukkan Penanggungjawab" required value="<?php echo isset($data['penanggungjawab']) ? $data['penanggungjawab'] : ''; ?>" />
            </div>
            <div class="form-group">
                <label>ID Montir:</label>
                <input type="text" name="montir_id" class="form-control" placeholder="Masukkan ID Montir" required value="<?php echo isset($data['montir_id_montir']) ? $data['montir_id_montir'] : ''; ?>" />
            </div>
            <div class="form-group">
                <label>ID Kendaraan:</label>
                <input type="text" name="kendaraan_id" class="form-control" placeholder="Masukkan ID Kendaraan" required value="<?php echo isset($data['kendaraan_id_kendaraan']) ? $data['kendaraan_id_kendaraan'] : ''; ?>" />
            </div>
            <!-- Menambahkan hidden input untuk menyimpan id_penanganan -->
            <input type="hidden" name="id_penanganan" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>">

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
