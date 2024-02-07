<?php
require_once 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3 p-0">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <div class="container">
                        <a class="navbar-brand" href="#">Navbar</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <a class="nav-link active" aria-current="page" href="#"><i class="bi-house-door-fill"></i> Home</a>
                                <a class="nav-link" href="#">Features</a>
                                <a class="nav-link" href="#">Pricing</a>
                                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Form Input Mahasiswa
                    </div>
                    <div class="card-body">
                        <form action="index.php?page=mahasiswa_save" method="POST">
                            <div class="mb-2">
                                <label class="form-label" for="">NIM</label>
                                <input class="form-control" type="text" name="nim" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="">Nama</label>
                                <input class="form-control" type="text" name="nama" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="">Jurusan</label>
                                <input class="form-control" type="text" name="jurusan" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="">Alamat</label>
                                <input class="form-control" type="text" name="alamat" required>
                            </div>
                            <div class="mb-2 d-grid">
                                <button class="btn btn-primary" name="cetak" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Data Mahasiswa
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                    <th>JURUSAN</th>
                                    <th>ALAMAT</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = $con->query("SELECT * FROM mahasiswa");
                                while ($row = $sql->fetch()) {
                                    echo "<tr>
                                            <td>$row[nim]</td>
                                            <td>$row[nama]</td>
                                            <td>$row[jurusan]</td>
                                            <td>$row[alamat]</td>
                                            <td>
                                                <a class='btn btn-sm btn-warning' href='index.php?page=mahasiswa_edit&nim=$row[nim]'>Edit</a>
                                                <a class='btn btn-sm btn-danger' href='index.php?page=mahasiswa_delete&nim=$row[nim]' onclick=\"return confirm('Hapus Data?')\">Delete</a>
                                            </td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>