<?php
// update.php
session_start();
include_once 'db_connect.php';
include_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Fungsi untuk mengambil data mahasiswa berdasarkan NIM dari database
    function get_mahasiswa_by_nim($conn, $nim) {
        $sql = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    $mahasiswa = get_mahasiswa_by_nim($conn, $nim);

    if (!$mahasiswa) {
        header("Location: dashboard.php");
        exit;
    }
} else {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $periode = $_POST['periode'];
    $prodi = $_POST['prodi'];
    $foto = $_FILES['foto']['name'];
    // ... Proses validasi dan penyimpanan gambar ke folder "uploads"

    if (update_data_mahasiswa($conn, $nim, $nama, $periode, $prodi, $foto)) {
        generate_flash_message('success', 'Data mahasiswa berhasil diupdate');
    } else {
        generate_flash_message('error', 'Gagal mengupdate data mahasiswa');
    }
    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Ubah Mahasiswa - Manajemen Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <h1>Ubah Mahasiswa</h1>
        <?php display_flash_message(); ?>
        <form method="post" action="update.php" enctype="multipart/form-data">
            <input type="hidden" name="nim" value="<?= $mahasiswa['nim']; ?>">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" value="<?= $mahasiswa['nama_lengkap']; ?>" required>
            <br>
            <label for="periode">Periode Kelas:</label>
            <input type="text" id="periode" name="periode" value="<?= $mahasiswa['periode_kelas']; ?>" required>
            <br>
            <label for="prodi">Program Studi:</label>
            <input type="text" id="prodi" name="prodi" value="<?= $mahasiswa['program_studi']; ?>" required>
            <br>
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">
            <br>
            <input type="submit" name="submit" value="Ubah">
        </form>
        <br>
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>
</body>

</html>