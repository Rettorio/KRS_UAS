<?php
require_once "config/koneksi.php";
require_once "function.php";

$msg = isset($_SESSION['alert']) ? $_SESSION['alert']['alertMessage'] : "BELUM ADA ALERT";
$script = "listenCheck();
            console.log('$msg');";

$smtQuery = "SELECT * FROM semester WHERE status = 'Aktif';";
$matkulQuery = "SELECT * FROM matakuliah WHERE semester % 2 = ";
$kelasQuery = "SELECT * FROM kelas";
$krsQuery = "SELECT krs.id,mk.nama_mk,kl.nama_kelas
             FROM krs
             INNER JOIN matakuliah mk ON krs.kode_mk = mk.kode_mk
             INNER JOIN kelas kl ON krs.id_kelas = kl.id_kelas
             WHERE nim = ? AND id_smt = ?";

//fetch semester dan kelas terlebih dahulu
$smt = $dbFetcher($smtQuery, false);
$kelas = $dbFetcher($kelasQuery);
$krs = $dbFetcher($krsQuery, true, array($nim, $smt['id_smt']));
//apakah mhs sudah mengisi krs pada smt aktif
$adaKrs = !empty($krs);

switch ($smt['semester']) {
    case 'Ganjil':
        $matkulQuery .= "'1';";
        break;
    case 'Genap' :
        $matkulQuery .= "'0';";
        break;
}
$matkul = $dbFetcher($matkulQuery);
?>

<div class="row mb-5">
    <div class="col-md-4 mb-4 mb-md-0">
        <?php
            if($isAlert) {
                include("svg-icon.php");
                showAlert($alertType,$alertMessage);
            }
        ?>
        <div class="card text-sm">
            <div class="card-header">
                ~ KRS ~
            </div>
            <div class="card-body table-responsive-xl">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Matakuliah</th>
                            <th class="text-center">Kelas</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($krs as $i => $k) {
                                $no = $i+1;
                                echo "<tr>
                                    <td class='text-center'>$no</td>
                                    <td>$k[nama_mk]</td>
                                    <td class='text-center'>$k[nama_kelas]</td>
                                    <td><form action='?page=krs_hapus' method='POST'>
                                        <input type='hidden' name='krs_id' value=$k[id]>
                                        <button type='submit' class='btn btn-sm btn-danger'><i class='bi bi-trash-fill'></i></button></form></td>
                                </tr>";
                            }

                        ?>
                    </tbody>
                </table>
                <?= $adaKrs ? '' : '<p class="text-center text-sm">Belum ada matakuliah yang dipilih.</p>'  ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card text-sm mb-4">
            <div class="card-header">
                profil
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">NIM&ensp;: <?= $nim ?></div>
                    <div class="col-6">TAHUN&ensp;: <?= $smt['tahun'] ?></div>
                </div>
                <div class="row">
                    <div class="col-6">NAMA&ensp;: <?= $nama ?></div>
                    <div class="col-6">SEMESTER&ensp;: <?= $smt['semester'] ?></div>
                </div>
            </div>
        </div>
        <form id="pilihMatkul" class="card text-sm" action="?page=krs_save" method="POST">
            <input type="hidden" name="nim" value="<?= $nim ?>">
            <input type="hidden" name="id_smt" value="<?= $smt['id_smt'] ?>">
            <div class="card-header">
                Pilih Matakuliah
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Matakuliah</th>
                            <th class="text-center">SEMESTER</th>
                            <th class="text-center">SKS</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach($matkul as $m) {
                                $checkId = "check$no-";
                                $checkValue = $m['kode_mk'].'-';
                                $tbRow =  "
                                    <tr>
                                        <td>$no</td>
                                        <td>$m[kode_mk]</td>
                                        <td role='button'>$m[nama_mk]</td>
                                        <td class='text-center'>$m[semester]</td>
                                        <td class='text-center'>$m[sks]</td>
                                        <td>";
                                foreach($kelas as $kls) {
                                    $klsColor = $kls['id_kelas'] % 2 ? "text-indigo" : "text-warning";
                                    $tbRow .= '
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" '."id=$checkId$kls[id_kelas] name='matkul-$no' value='$checkValue$kls[id_kelas]'>".
                                                '<label class="form-check-label '.$klsColor.'"'."for='$checkId$kls[id_kelas]'>".$kls['nama_kelas'].'</label>
                                            </div>'                                   
                                    ;
                                }
                                $tbRow .= "</td>";
                                echo $tbRow;
                                $no++;
                            }

                        ?>
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="sumbit" class="btn btn-success btn-sm">Simpan Pilihan</button>
            </div>
        </form>

    </div>
</div>