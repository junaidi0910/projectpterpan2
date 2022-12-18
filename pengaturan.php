<?php 
session_start();
include"config/koneksi.php";
if (!isset($_SESSION['id_user'])) {
    header("location: index.php");
}
$pengaturan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pengaturan WHERE id_pengaturan=1"));
if (isset($_POST['simpan'])) {
    $nama_aplikasi=mysqli_real_escape_string($koneksi, $_POST['nama_aplikasi']);
    $copyright=mysqli_real_escape_string($koneksi, $_POST['copyright']);
    $rand = rand();
    $ekstensi_diperbolehkan = array('png', 'jpg', 'JPG', 'PNG', 'jpeg', 'JPEG','HEIC');
    $bg = $_FILES['bg']['name'];
    if ($bg !== "") {
        $x = explode('.', $bg);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['bg']['size'];
        $file_tmp = $_FILES['bg']['tmp_name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran <= 5500000) {
                $x_bg = $rand . '_' . $bg;
                move_uploaded_file($file_tmp, 'img/' . $x_bg);
                $input=mysqli_query($koneksi,"UPDATE pengaturan SET nama_aplikasi='$nama_aplikasi', copyright='$copyright', bg='$x_bg' WHERE id_pengaturan=1");
            } else {
                echo "<script>window.alert('Ukuran file gambar melebihi batas !!!')
                window.location='pengaturan.php'</script>";
            }
        }else{
            echo "<script>window.alert('ekstensi file tidak di perbolehkan !!!')
            window.location='pengaturan.php'</script>";
        }
    }else{
        $input=mysqli_query($koneksi,"UPDATE pengaturan SET nama_aplikasi='$nama_aplikasi', copyright='$copyright' WHERE id_pengaturan=1");
    }
    $logo = $_FILES['logo']['name'];
    if ($logo !== "") {
        $x = explode('.', $logo);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran <= 5500000) {
                $x_logo = $rand . '_' . $logo;
                move_uploaded_file($file_tmp, 'img/' . $x_logo);
                $input=mysqli_query($koneksi,"UPDATE pengaturan SET nama_aplikasi='$nama_aplikasi', copyright='$copyright', logo='$x_logo' WHERE id_pengaturan=1");
            } else {
                echo "<script>window.alert('Ukuran file gambar melebihi batas !!!')
                window.location='pengaturan.php'</script>";
            }
        }else{
            echo "<script>window.alert('ekstensi file tidak di perbolehkan !!!')
            window.location='pengaturan.php'</script>";
        }
    }else{
        $input=mysqli_query($koneksi,"UPDATE pengaturan SET nama_aplikasi='$nama_aplikasi', copyright='$copyright' WHERE id_pengaturan=1");
    }
    echo "<script>window.alert('Pengaturan disimpan')
    window.location='pengaturan.php'</script>";
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
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Pengaturan</h6>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Aplikasi</label>
                                    <input type="text" name="nama_aplikasi" class="form-control is-valid" id="nama_aplikasi" value="<?= $pengaturan['nama_aplikasi']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Background Login</label><br>
                                    <img width="200" src="img/<?= $pengaturan['bg']; ?>"><br><br>
                                    <input type="file" class="form-control  is-valid" name="bg">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Icon/Logo</label><br>
                                    <img width="50" src="img/<?= $pengaturan['logo']; ?>"><br><br>
                                    <input type="file" class="form-control is-valid" name="logo">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Copyright</label>
                                    <input type="text" class="form-control is-valid" value="<?= $pengaturan['copyright']; ?>" name="copyright" required>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
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