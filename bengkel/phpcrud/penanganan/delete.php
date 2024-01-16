<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Memeriksa apakah ID penanganan ada
if (isset($_GET['id'])) {
    // Memilih record yang akan dihapus
    $stmt = $pdo->prepare('SELECT * FROM penanganan WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $penanganan = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$penanganan) {
        exit('Penanganan tidak ditemukan dengan ID tersebut!');
    }
    // Memastikan pengguna mengonfirmasi sebelum penghapusan
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // Pengguna mengklik tombol "Yes", hapus record
            $stmt = $pdo->prepare('DELETE FROM penanganan WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Anda telah menghapus data penanganan!';
        } else {
            // Pengguna mengklik tombol "No", redirect kembali ke halaman baca (read)
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('Tidak ada ID yang ditentukan!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
    <h2>Hapus Kontak #<?=$penanganan['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Apakah Anda yakin ingin menghapus penanganan #<?=$penanganan['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$penanganan['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$penanganan['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
