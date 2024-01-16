<!DOCTYPE html>
<html>
<head>
    <title>Update Nama Montir</title>
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

        if (isset($_GET['id_montir'])) {
            $id_montir = input($_GET["id_montir"]);

            $sql = "SELECT * FROM montir WHERE id_montir=$id_montir";
            $hasil = mysqli_query($kon, $sql);

            if (!$hasil) {
                die("Gagal mengambil data: " . mysqli_error($kon));
            }

            $data = mysqli_fetch_assoc($hasil);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = input($_POST["nama"]);
            $id_montir = input($_POST["id_montir"]); // Memasukkan id_montir yang terdapat pada URL

            $sql = "UPDATE montir SET 
                nama='$nama'
                WHERE id_montir=$id_montir";

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: montirhome.php");
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>

        <h2>Update Nama Montir</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Nama Montir:</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Montir" required value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" />
            </div>
            <!-- Menambahkan hidden input untuk menyimpan id_montir -->
            <input type="hidden" name="id_montir" value="<?php echo isset($data['id_montir']) ? $data['id_montir'] : ''; ?>">

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
