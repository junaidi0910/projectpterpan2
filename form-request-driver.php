<?php 
session_start();
include"config/koneksi.php";
$id_user=$_SESSION['id_user'];
date_default_timezone_set('Asia/Jakarta');
if (!isset($_SESSION['id_user'])) {
    header("location: index.php");
}
mysqli_query($koneksi,"UPDATE tbl_kegiatan SET status_read=0");
$pengaturan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pengaturan WHERE id_pengaturan=1"));
if (isset($_POST['simpan'])) {
    $id_pegawai=mysqli_real_escape_string($koneksi, $_POST['id_pegawai']);
    $unit_kerja=mysqli_real_escape_string($koneksi, $_POST['unit_kerja']);
    $kegiatan=mysqli_real_escape_string($koneksi, $_POST['kegiatan']);
    $tujuan=mysqli_real_escape_string($koneksi, $_POST['tujuan']);
    $tgl=mysqli_real_escape_string($koneksi, $_POST['tgl']);
    $mulai_jam=mysqli_real_escape_string($koneksi, $_POST['mulai_jam']);
    $sampai_jam=mysqli_real_escape_string($koneksi, $_POST['sampai_jam']);
    $jumlah_penumpang=mysqli_real_escape_string($koneksi, $_POST['jumlah_penumpang']);
    $nama_driver=mysqli_real_escape_string($koneksi, $_POST['nama_driver']);
    $status_read=1;
    $sql_cek_mulai_jam = mysqli_query($koneksi, "SELECT * FROM tbl_kegiatan WHERE mulai_jam = '$mulai_jam'") or die (mysqli_error($koneksi));
    
    if(mysqli_num_rows($sql_cek_mulai_jam) > 0) {
        echo "<script>alert('Waktu Berangkat sudah dipilih,silahkan pilih waktu lain!'); window.location='form-request-driver.php'</script>";
    } else{
        mysqli_query($koneksi,"INSERT INTO tbl_kegiatan VALUES(NULL,'$id_pegawai','$unit_kerja','$kegiatan','$tujuan','$tgl','$mulai_jam','$sampai_jam','$jumlah_penumpang','$nama_driver','$status_read')");
    echo "<script>alert('Submit Berhasil'); window.location='form-request-driver.php'</script>";
    }
    
}
if (isset($_GET['aksi'])=="hapus") {
    $id_kegiatan=mysqli_real_escape_string($koneksi, $_GET['aqsw']);
    $hapus=mysqli_query($koneksi,"DELETE FROM tbl_kegiatan WHERE id_kegiatan='$id_kegiatan'");
    echo "<script>window.alert('Hapus berhasil')
    window.location='form-request-driver.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $pengaturan['nama_aplikasi']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/<?= $pengaturan['logo']; ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php 
        require_once"menu.php";
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php 
            require_once"sidebar.php";
            ?>
            <!-- Navbar End -->

            <div class="container-fluid pt-4 px-4">
                <div style="background-color: #2ec4b6;" class="text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">List Permintaan Driver</h6>
                    </div>
                    <div class="table-responsive">
                        <table style="background-color: white; color: black; font-size: 10pt;" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Opsi</th>
                                    <th scope="col">Nama Pemohon</th>
                                    <th scope="col">Unit Kerja</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Tujuan</th>
                                    <th scope="col">Tgl</th>
                                    <th scope="col">Mulai Jam</th>
                                    <th scope="col">Sampai Jam</th>
                                    <th scope="col">Jumlah Penumpang</th>
                                    <th scope="col">Nama Driver</th>
                                    <th scope="col">Nama Mobil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                include"config/koneksi.php";
                                function formatTanggal($date){
                                    return date('d-M-Y', strtotime($date));
                                }
                                $nama_driver=$_SESSION['nama_user'];
                                if ($_SESSION['level']=="pegawai") {
                                    $permintaan_driver=mysqli_query($koneksi,"SELECT * FROM tbl_kegiatan
                                        INNER JOIN user ON tbl_kegiatan.id_pegawai=user.id_user WHERE tbl_kegiatan.id_pegawai='$id_user' ORDER BY id_kegiatan DESC");
                                }else{
                                    $permintaan_driver=mysqli_query($koneksi,"SELECT * FROM tbl_kegiatan
                                        INNER JOIN user ON tbl_kegiatan.id_pegawai=user.id_user WHERE tbl_kegiatan.nama_driver='$nama_driver' ORDER BY id_kegiatan DESC");
                                }
                                while ($tampil_permintaan=mysqli_fetch_array($permintaan_driver)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a onclick="return confirm('Hapus data ini ?')" href="form-request-driver.php?aksi=hapus&aqsw=<?= $tampil_permintaan['id_kegiatan']; ?>"><img width="30" src="https://cdn-icons-png.flaticon.com/512/5028/5028066.png"></a>
                                        </td>
                                        <td><?= $tampil_permintaan['nama_user']; ?></td>
                                        <td><?= $tampil_permintaan['unit_kerja']; ?></td>
                                        <td><?= $tampil_permintaan['kegiatan']; ?></td>
                                        <td><?= $tampil_permintaan['tujuan']; ?></td>
                                        <td><span class="badge bg-primary"><?= formatTanggal($tampil_permintaan['tgl']); ?></span></td>
                                        <td><?= $tampil_permintaan['mulai_jam']; ?></td>
                                        <td><?= $tampil_permintaan['sampai_jam']; ?></td>
                                        <td style="text-align: center;"><?= $tampil_permintaan['jumlah_penumpang']; ?></td>
                                        <td><span class="badge bg-primary"><?= $tampil_permintaan['nama_driver']; ?></span></td>
                                        <td><?= $tampil_permintaan['nama_mobil']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Blank Start -->
            <?php 
            if ($_SESSION['level']=="pegawai") {
                ?>
                <div class="container-fluid pt-4 px-4">

                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Form Request Driver</h6>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nama pemohon" class="form-label">Nama Pemohon</label>
                                            <select class="form-select form-select-sm" name="id_pegawai" required>
                                                <option value="">--Pilih--</option>
                                                <?php 
                                                $peg=mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id_user'");
                                                while ($row_peg=mysqli_fetch_array($peg)) {
                                                    ?>
                                                    <option value="<?= $row_peg['id_user']; ?>"><?= $row_peg['nama_user']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="unit kerja" class="form-label">Unit Kerja</label>
                                            <input type="text" autocomplete="off" class="form-control form-control-sm" placeholder="Unit Kerja" name="unit_kerja" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kegiatan" class="form-label">Kegiatan</label>
                                            <textarea class="form-control" name="kegiatan" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="unit kerja" class="form-label">Tujuan</label>
                                            <input type="text" autocomplete="off" class="form-control form-control-sm" placeholder="Tujuan" name="tujuan" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="unit kerja" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control form-control-sm" placeholder="" name="tgl" value="<?= date('Y-m-d'); ?>" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="unit kerja" class="form-label">Mulai jam</label>
                                                    <input type="time" class="form-control form-control-sm" placeholder="Mulai Jam" name="mulai_jam" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="unit kerja" class="form-label">Sampai jam</label>
                                                    <input type="time" class="form-control form-control-sm" placeholder="Sampai Jam" name="sampai_jam" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="unit kerja" class="form-label">Jumlah Penumpang</label>
                                            <input type="number" name="jumlah_penumpang" class="form-control" placeholder="Jumlah Penumpang" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama pemohon" class="form-label">Pilih Driver</label>
                                            <select class="form-select form-select-sm" name="nama_driver" required>
                                                <option value="">--Pilih--</option>
                                                <?php 
                                                $driver=mysqli_query($koneksi,"SELECT * FROM user WHERE level='driver'");
                                                while ($row_driver=mysqli_fetch_array($driver)) {
                                                    ?>
                                                    <option value="<?= $row_driver['nama_user']; ?>"><?= $row_driver['nama_user']; ?> - <?= $row_driver['status']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        
                                        <div class="mb-3">
                                            <label for="nama mobil" class="form-label">Pilih Mobil</label>
                                            <select class="form-select form-select-sm" name="nama_mobil" required>
                                                <option value="">--Pilih--</option>
                                                <?php 
                                                $mobil=mysqli_query($koneksi,"SELECT * FROM mobil");
                                                while ($row_mobil=mysqli_fetch_array($mobil)) {
                                                    ?>
                                                    <option value="<?= $row_mobil['nama_mobil']; ?>"><?= $row_mobil['nama_mobil']; ?> - <?= $row_mobil['no_plat']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            <?php } ?>
            <!-- Blank End -->


            <!-- Footer Start -->
            <?php 
            require_once"footer.php";
            ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>