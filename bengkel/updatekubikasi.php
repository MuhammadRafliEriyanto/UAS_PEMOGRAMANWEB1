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

        if (isset($_GET['id_kubikasi'])) {
            $id_kubikasi = input($_GET["id_kubikasi"]);

            $sql = "SELECT * FROM kubikasi WHERE id_kubikasi=$id_kubikasi";
            $hasil = mysqli_query($kon, $sql);
            $data = mysqli_fetch_assoc($hasil);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_kubikasi = htmlspecialchars($_POST["id_kubikasi"]);
            $besar_tenaga = input($_POST["besar_tenaga"]);

            $sql = "UPDATE kubikasi SET 
                besar_tenaga='$besar_tenaga'
                WHERE id_kubikasi=$id_kubikasi";

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: kubikasihome.php");
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>

        <h2>Update Data Kubikasi</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Besar Tenaga:</label>
                <input type="text" name="besar_tenaga" class="form-control" value="<?php echo $data['besar_tenaga']; ?>" required />
            </div>
            
            <input type="hidden" name="id_kubikasi" value="<?php echo $data['id_kubikasi']; ?>" />

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
