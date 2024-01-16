<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Penanganan</title>
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tanggal = input($_POST["tanggal"]);
        $keluhan = input($_POST["keluhan"]);
        $montir_id = input($_POST["montir_id"]);
        $kendaraan_id = input($_POST["kendaraan_id"]);

        $queryLastId = "SELECT MAX(id) AS last_id FROM penanganan";
        $resultLastId = mysqli_query($kon, $queryLastId);
        $rowLastId = mysqli_fetch_assoc($resultLastId);
        $lastId = $rowLastId['last_id'];
        $id_penanganan = $lastId + 1;

        $sql = "INSERT INTO penanganan (id, tanggal, keluhan, penanggungjawab, montir_id_montir, kendaraan_id_kendaraan) 
                VALUES ('$id_penanganan', '$tanggal', '$keluhan', (SELECT nama FROM montir WHERE id_montir = '$montir_id'), '$montir_id', '$kendaraan_id')";

        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            header("Location: index.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
        }
    }
    ?>

    <h2>Input Data Penanganan</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Keluhan:</label>
            <input type="text" name="keluhan" class="form-control" placeholder="Masukkan Keluhan" required />
        </div>
        <div class="form-group">
            <label>Penanggungjawab:</label>
            <select name="penanggungjawab" class="form-control" required>
                <!-- Mengambil data dari tabel 'montir' -->
                <?php
                $queryPenanggungjawab = "SELECT * FROM montir";
                $resultPenanggungjawab = mysqli_query($kon, $queryPenanggungjawab);
                while ($rowPenanggungjawab = mysqli_fetch_assoc($resultPenanggungjawab)) {
                    echo "<option value='{$rowPenanggungjawab['id_montir']}'>{$rowPenanggungjawab['nama']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Montir ID:</label>
            <select name="montir_id" class="form-control" required>
                <!-- Mengambil data dari tabel 'montir' -->
                <?php
                $queryMontir = "SELECT * FROM montir";
                $resultMontir = mysqli_query($kon, $queryMontir);
                while ($rowMontir = mysqli_fetch_assoc($resultMontir)) {
                    echo "<option value='{$rowMontir['id_montir']}'>{$rowMontir['id_montir']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>ID Kendaraan:</label>
            <input type="text" name="kendaraan_id" class="form-control" placeholder="Masukkan ID Kendaraan" required />
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</
