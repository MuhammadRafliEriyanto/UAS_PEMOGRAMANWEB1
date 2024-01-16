<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Bengkel Sejahtera</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>Daftar Jenis Kendaraan</center></h4>
        <?php
        include "koneksi.php";

        if (isset($_GET['id_jenis'])) {
            $id_jenis = htmlspecialchars($_GET["id_jenis"]);

            $sql = "DELETE FROM jenis WHERE id_jenis='$id_jenis'";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: index.php"); // Ubah ke file yang sesuai
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }

        // Mengambil data jenis kendaraan
        $sql = "SELECT * FROM jenis ORDER BY id_jenis ASC";
        $hasil = mysqli_query($kon, $sql);
        $no = 0;
        ?>

        <table class="my-3 table table-bordered">
            <thead class="table-primary">
                <tr>           
                    <th>No</th>
                    <th>ID Jenis</th>
                    <th>Jenis Kendaraan</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php
            while ($data = mysqli_fetch_array($hasil)) {
                $no++;
                ?>

                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $data["id_jenis"]; ?></td>
                    <td><?php echo $data["jenis_kendaraan"]; ?></td>
                    <td>
                        <a href="update.php?id_jenis=<?php echo htmlspecialchars($data['id_jenis']); ?>" class="btn btn-warning" role="button">Update</a>
                        <a href="index.php?id_jenis=<?php echo $data['id_jenis']; ?>" class="btn btn-danger" role="button">Delete</a>
                    </td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>
</body>
</html>
