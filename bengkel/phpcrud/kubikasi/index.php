<!DOCTYPE html>
<html>
<head>
    <title>Bengkel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Bengkel Sejahtera</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR Manajemen Bengkel</center></h4>
        <?php
        include "koneksi.php";

        if (isset($_GET['id_kubikasi'])) {
            $id_kubikasi = htmlspecialchars($_GET["id_kubikasi"]);

            $sql = "DELETE FROM kubikasi WHERE id_kubikasi='$id_kubikasi'";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }

        $sql = "SELECT * FROM kubikasi ORDER BY id_kubikasi ASC";
        $hasil = mysqli_query($kon, $sql);
        $no = 0;
        ?>

        <table class="my-3 table table-bordered">
            <thead class="table-primary">
                <tr>           
                    <th>No</th>
                    <th>ID Kubikasi</th>
                    <th>Besar Tenaga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php
            while ($data = mysqli_fetch_array($hasil)) {
                $no++;
                ?>

                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $data["id_kubikasi"]; ?></td>
                    <td><?php echo $data["besar_tenaga"]; ?></td>
                    <td>
                        <a href="update.php?id_kubikasi=<?php echo htmlspecialchars($data['id_kubikasi']); ?>" class="btn btn-warning" role="button">Update</a>
                        <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_kubikasi=<?php echo $data['id_kubikasi']; ?>" class="btn btn-danger" role="button">Delete</a>
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
