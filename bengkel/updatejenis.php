<?php
include "koneksi.php";

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$data = [];

if (isset($_GET['id_jenis'])) {
    $id_jenis = input($_GET["id_jenis"]);

    $sql = "SELECT * FROM jenis WHERE id_jenis=?";
    $stmt = mysqli_prepare($kon, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_jenis);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Gagal mengambil data: " . mysqli_error($kon));
    }

    $data = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_kendaraan = input($_POST["jenis_kendaraan"]);
    $id_jenis = input($_POST["id_jenis"]);

    echo "ID Jenis: " . $id_jenis;
    echo "Jenis Kendaraan: " . $jenis_kendaraan;

    $sql = "UPDATE jenis SET jenis_kendaraan=? WHERE id_jenis=?";
    $stmt = mysqli_prepare($kon, $sql);
    mysqli_stmt_bind_param($stmt, "si", $jenis_kendaraan, $id_jenis);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: jenishome.php");
    } else {
        echo "<div class='alert alert-danger'>Data Gagal disimpan. Pesan Kesalahan: " . mysqli_error($kon) . "</div>";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Jenis Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Update Jenis Kendaraan</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Jenis Kendaraan:</label>
                <input type="text" name="jenis_kendaraan" class="form-control" placeholder="Masukkan Jenis Kendaraan" required value="<?php echo isset($data['jenis_kendaraan']) ? $data['jenis_kendaraan'] : ''; ?>" />
            </div>
            <input type="hidden" name="id_jenis" value="<?php echo isset($data['id_jenis']) ? $data['id_jenis'] : ''; ?>">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
