<!DOCTYPE html>
<html>
<head>
    <title>Update Data Kendaraan</title>
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

        if (isset($_GET['id_kendaraan'])) {
            $id_kendaraan = input($_GET["id_kendaraan"]);

            $sql = "SELECT * FROM kendaraan WHERE id_kendaraan=$id_kendaraan";
            $hasil = mysqli_query($kon, $sql);
            $data = mysqli_fetch_assoc($hasil);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_kendaraan = htmlspecialchars($_POST["id_kendaraan"]);
            $nopol = input($_POST["nopol"]);
            $nama_kendaraan = input($_POST["nama_kendaraan"]);
            $warna = input($_POST["warna"]);
            $merk_id_merk = input($_POST["merk_id_merk"]);
            $kubikasi_id_kubikasi = input($_POST["kubikasi_id_kubikasi"]);
            $jenis_id_jenis = input($_POST["jenis_id_jenis"]);
            $transmisi_id_transmisi = input($_POST["transmisi_id_transmisi"]);

            $sql = "UPDATE kendaraan SET 
                nopol='$nopol', 
                nama_kendaraan='$nama_kendaraan', 
                warna='$warna', 
                merk_id_merk='$merk_id_merk', 
                kubikasi_id_kubikasi='$kubikasi_id_kubikasi', 
                jenis_id_jenis='$jenis_id_jenis', 
                transmisi_id_transmisi='$transmisi_id_transmisi' 
                WHERE id_kendaraan=$id_kendaraan";

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: kendaraanhome.php");
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>

        <h2>Update Data Kendaraan</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>No Pol:</label>
                <input type="text" name="nopol" class="form-control" value="<?php echo $data['nopol']; ?>" required />
            </div>
            <div class="form-group">
                <label>Nama Kendaraan:</label>
                <input type="text" name="nama_kendaraan" class="form-control" value="<?php echo $data['nama_kendaraan']; ?>" required />
            </div>
            <div class="form-group">
                <label>Warna:</label>
                <input type="text" name="warna" class="form-control" value="<?php echo $data['warna']; ?>" required />
            </div>
            <div class="form-group">
                <label>Merk ID:</label>
                <select name="merk_id_merk" class="form-control" required>
                    <!-- Mengambil data dari tabel 'merk' -->
                    <?php
                    $queryMerk = "SELECT * FROM merk";
                    $resultMerk = mysqli_query($kon, $queryMerk);
                    while ($rowMerk = mysqli_fetch_assoc($resultMerk)) {
                        $selected = ($rowMerk['id_merk'] == $data['merk_id_merk']) ? 'selected' : '';
                        echo "<option value='{$rowMerk['id_merk']}' $selected>{$rowMerk['id_merk']} - {$rowMerk['nama_merk']}</option>";
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
                        $selected = ($rowKubikasi['id_kubikasi'] == $data['kubikasi_id_kubikasi']) ? 'selected' : '';
                        echo "<option value='{$rowKubikasi['id_kubikasi']}' $selected>{$rowKubikasi['id_kubikasi']} - {$rowKubikasi['besar_tenaga']}</option>";
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
                        $selected = ($rowJenis['id_jenis'] == $data['jenis_id_jenis']) ? 'selected' : '';
                        echo "<option value='{$rowJenis['id_jenis']}' $selected>{$rowJenis['id_jenis']} - {$rowJenis['jenis_kendaraan']}</option>";
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
                        $selected = ($rowTransmisi['id_transmisi'] == $data['transmisi_id_transmisi']) ? 'selected' : '';
                        echo "<option value='{$rowTransmisi['id_transmisi']}' $selected>{$rowTransmisi['id_transmisi']} - {$rowTransmisi['transmisi']}</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="hidden" name="id_kendaraan" value="<?php echo $data['id_kendaraan']; ?>" />

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
