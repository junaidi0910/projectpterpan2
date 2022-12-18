<?php 
session_start();
include"config/koneksi.php";
if (!isset($_SESSION['id_user'])) {
    header("location: index.php");
}
$pengaturan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pengaturan WHERE id_pengaturan=1"));
if (isset($_POST['simpan'])) {
    $nama_mobil=mysqli_real_escape_string($koneksi, $_POST['nama_mobil']);
    $no_plat=mysqli_real_escape_string($koneksi, $_POST['no_plat']);
    $bahan_bakar=mysqli_real_escape_string($koneksi, $_POST['bahan_bakar']);
    $rand = rand();
    $ekstensi_diperbolehkan = array('png', 'jpg', 'JPG', 'PNG', 'jpeg', 'JPEG','HEIC');
    $foto_mobil = $_FILES['foto_mobil']['name'];
    if ($foto_mobil !== "") {
        $x = explode('.', $foto_mobil);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['foto_mobil']['size'];
        $file_tmp = $_FILES['foto_mobil']['tmp_name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran <= 5500000) {
                $x_foto_mobil = $rand . '_' . $foto_mobil;
                move_uploaded_file($file_tmp, 'img/mobil/' . $x_foto_mobil);
                $input=mysqli_query($koneksi,"INSERT INTO mobil VALUES(NULL,'$nama_mobil','$no_plat','$bahan_bakar','$x_foto_mobil')");
            } else {
                echo "<script>window.alert('Ukuran file foto mobil melebihi batas !!!')
                window.location='data-mobil.php'</script>";
            }
        }else{
            echo "<script>window.alert('ekstensi file tidak di perbolehkan !!!')
            window.location='data-mobil.php'</script>";
        }
    }else{
        $x_foto_mobil="";
        $input=mysqli_query($koneksi,"INSERT INTO mobil VALUES(NULL,'$nama_mobil','$no_plat','$bahan_bakar','$x_foto_mobil')");
    }
    echo "<script>window.alert('Mobil telah ditambahkan')
    window.location='data-mobil.php'</script>";
}
// hapus
if (isset($_GET['aksi'])=="hapus") {
    $id_mobil=mysqli_real_escape_string($koneksi, $_GET['aqsw']);
    $cek_data=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM mobil WHERE id_mobil='$id_mobil'"));
    $foto_mobil=$cek_data['foto_mobil'];
    if ($foto_mobil!=="") {
        unlink("img/mobil/$foto_mobil");
    }
    $hapus=mysqli_query($koneksi,"DELETE FROM mobil WHERE id_mobil='$id_mobil'");
    if ($hapus) {
        echo "<script>window.alert('Mobil telah dihapus !!!')
        window.location='data-mobil.php'</script>";
    }
}
// edit
if (isset($_POST['edit'])) {
    $id_mobil=mysqli_real_escape_string($koneksi, $_POST['id_mobil']);
    $nama_mobil=mysqli_real_escape_string($koneksi, $_POST['nama_mobil']);
    $no_plat=mysqli_real_escape_string($koneksi, $_POST['no_plat']);
    $bahan_bakar=mysqli_real_escape_string($koneksi, $_POST['bahan_bakar']);
    $rand = rand();
    $ekstensi_diperbolehkan = array('png', 'jpg', 'JPG', 'PNG', 'jpeg', 'JPEG','HEIC');
    $foto_mobil = $_FILES['foto_mobil']['name'];
    if ($foto_mobil !== "") {
        $x = explode('.', $foto_mobil);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['foto_mobil']['size'];
        $file_tmp = $_FILES['foto_mobil']['tmp_name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran <= 5500000) {
                $x_foto_mobil = $rand . '_' . $foto_mobil;
                move_uploaded_file($file_tmp, 'img/mobil/' . $x_foto_mobil);
                $input=mysqli_query($koneksi,"UPDATE mobil SET nama_mobil='$nama_mobil', no_plat='$no_plat', bahan_bakar='$bahan_bakar', foto_mobil='$x_foto_mobil' WHERE id_mobil='$id_mobil'");
            } else {
                echo "<script>window.alert('Ukuran file foto mobil melebihi batas !!!')
                window.location='data-mobil.php'</script>";
            }
        }else{
            echo "<script>window.alert('ekstensi file tidak di perbolehkan !!!')
            window.location='data-mobil.php'</script>";
        }
    }else{
        $input=mysqli_query($koneksi,"UPDATE mobil SET nama_mobil='$nama_mobil', no_plat='$no_plat', bahan_bakar='$bahan_bakar' WHERE id_mobil='$id_mobil'");
    }
    echo "<script>window.alert('Mobil telah diupdate')
    window.location='data-mobil.php'</script>";
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

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Data Mobil</h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Tambah Data</a>
                        <a href=""><img width="25" src="https://cdn-icons-png.flaticon.com/512/560/560512.png"> Refresh</a>
                    </div>
                    <div class="table-responsive">
                        <table style="font-size: 10pt;" class="bg-white text-dark table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Opsi</th>
                                    <th scope="col">Foto Mobil</th>
                                    <th scope="col">Nama Mobil</th>
                                    <th scope="col">No Plat</th>
                                    <th scope="col">Bahan bakar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $mobil=mysqli_query($koneksi,"SELECT * FROM mobil");
                                while ($tampil_mobil=mysqli_fetch_array($mobil)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a onclick="return confirm('Hapus mobil <?= $tampil_mobil['nama_mobil']; ?> ?')" href="data-mobil.php?aksi=hapus&aqsw=<?= $tampil_mobil['id_mobil']; ?>"><img width="30" src="https://cdn-icons-png.flaticon.com/512/5028/5028066.png"></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#edit<?= $tampil_mobil['id_mobil']; ?>"><img width="30" src="https://cdn-icons-png.flaticon.com/512/5996/5996831.png"></a>
                                        </td>
                                        <td style="text-align: center;"><img width="200" src="img/mobil/<?= $tampil_mobil['foto_mobil']; ?>"></td>
                                        <td><?= $tampil_mobil['nama_mobil']; ?></td>
                                        <td><mark style="background-color: red; color: white;"><?= $tampil_mobil['no_plat']; ?></mark></td>
                                        <td><?= $tampil_mobil['bahan_bakar']; ?></td>
                                    </tr>
                                    <div class="modal fade" id="edit<?= $tampil_mobil['id_mobil']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Mobil</h5>
                                                        <input type="hidden" name="id_mobil" value="<?= $tampil_mobil['id_mobil']; ?>">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Nama Mobil</label>
                                                            <input type="text" name="nama_mobil" value="<?= $tampil_mobil['nama_mobil']; ?>" autocomplete="off" placeholder="Nama Mobil" class="form-control form-control-sm" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">No Plat Mobil</label>
                                                            <input type="text" name="no_plat" value="<?= $tampil_mobil['no_plat']; ?>" autocomplete="off" placeholder="No Plat Mobil" class="form-control form-control-sm" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Bahan Bakar</label>
                                                            <input type="text" name="bahan_bakar" value="<?= $tampil_mobil['bahan_bakar']; ?>" autocomplete="off" placeholder="Bahan Bakar Mobil" class="form-control form-control-sm" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Foto Mobil (Jika ada)</label><br>
                                                            <img width="150" src="img/mobil/<?= $tampil_mobil['foto_mobil']; ?>"><br><br>
                                                            <input type="file" accept="image/*" name="foto_mobil" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mobil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Mobil</label>
                            <input type="text" name="nama_mobil" autocomplete="off" placeholder="Nama Mobil" class="form-control form-control-sm is-valid" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">No Plat Mobil</label>
                            <input type="text" name="no_plat" autocomplete="off" placeholder="No Plat Mobil" class="form-control form-control-sm is-valid" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Bahan Bakar</label>
                            <input type="text" name="bahan_bakar" autocomplete="off" placeholder="Bahan Bakar Mobil" class="form-control form-control-sm is-valid" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Foto Mobil (Jika ada)</label>
                            <input type="file" accept="image/*" name="foto_mobil" class="form-control form-control-sm is-valid">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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