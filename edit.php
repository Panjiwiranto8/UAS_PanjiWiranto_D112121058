<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_tedc');

$nim = $_GET['nim'];
$mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$result = $mahasiswa->fetch_assoc();

$nama = $result['nama'];
$periode = $result['periode'];
$kelas = $result['kelas'];
$prodi = $result['prodi'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-3" style="text-align: center;">Ubah Mahasiswa</h1>
        
        <form action="update.php" method="POST">
            <div class="mb-3 row">
                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $nim; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-10">
                    <select class="form-control" name="periode" id="periode">
                        <?php
                            $year = date('Y'); 
                            for ($i=$year; $i > $year-5 ; $i--) { ?>
                              <option value="<?= $i; ?>" <?= $periode == $i ? 'selected' : ''; ?> ><?= $i; ?></option>
                        <?php }  ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $kelas ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $prodi; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
            </div>
    
            <button type="submit" class="btn btn-primary float-end">Simpan</button>
            <a href="index.php" class="btn btn-warning float-end me-2">Kembali</a>
        </form>
    </div>
</body>
</html>