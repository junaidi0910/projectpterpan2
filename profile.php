<?php 
session_start();
include"config/koneksi.php";
if (!isset($_SESSION['id_user'])) {
    header("location: index.php");
}
$pengaturan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pengaturan WHERE id_pengaturan=1"));
$id_user=$_SESSION['id_user'];
$data_user=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id_user'"));
if (isset($_POST['simpan'])) {
    $rand = rand();
    $ekstensi_diperbolehkan = array('png', 'jpg', 'JPG', 'PNG', 'jpeg', 'JPEG','HEIC');
    $foto_user = $_FILES['foto_user']['name'];
    if ($foto_user !== "") {
        $x = explode('.', $foto_user);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['foto_user']['size'];
        $file_tmp = $_FILES['foto_user']['tmp_name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran <= 5500000) {
                $x_foto_user = $rand . '_' . $foto_user;
                move_uploaded_file($file_tmp, 'img/user/' . $x_foto_user);
                $update=mysqli_query($koneksi,"UPDATE user SET foto_user='$x_foto_user' WHERE id_user='$id_user'");
                header("location: profile.php");
            } else {
                echo "<script>window.alert('Ukuran file foto melebihi batas !!!')
                window.location='profile.php'</script>";
            }
        }else{
            echo "<script>window.alert('ekstensi file tidak di perbolehkan !!!')
            window.location='profile.php'</script>";
        }
    }
}
if (isset($_POST['simpan_pass'])) {
    $password=mysqli_real_escape_string($koneksi, md5($_POST['password']));
    $update=mysqli_query($koneksi,"UPDATE user SET password='$password' WHERE id_user='$id_user'");
    echo "<script>window.alert('password anda telah diubah, silahkan masuk kembali menggunakan password baru anda')
    window.location='logout.php'</script>";
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
                <center>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Profile</h6>
                            <div class="owl-carousel testimonial-carousel">
                                <div class="testimonial-item text-center">
                                    <?php 
                                    if ($data_user['foto_user']=="") {
                                        ?>
                                        <img class="img-fluid rounded-circle mx-auto mb-4" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" style="width: 100px; height: 100px;">
                                    <?php }else{ ?>
                                        <img class="img-fluid rounded-circle mx-auto mb-4" src="img/user/<?= $data_user['foto_user']; ?>" style="width: 100px; height: 100px;">
                                    <?php } ?>
                                    <h5 class="mb-1"><?= $_SESSION['nama_user']; ?></h5>
                                    <p><?= $_SESSION['level']; ?></p>
                                    <center>
                                        <table>
                                            <tr>
                                                <td>
                                                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profile"><img style="width: 35px;" src="img/picture.png"></a>
                                                </td>
                                                <td>
                                                    <a href="" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#pass"><img style="width: 35px;" src="img/password.png"></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
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
    <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Foto Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Upload Foto</label>
                            <input type="file" accept="image/*" name="foto_user" class="form-control form-control-sm" required>
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

    <!-- pass -->
    <div class="modal fade" id="pass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Masukan Password baru</label>
                            <input type="password" name="password" placeholder="Masukan password baru" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="simpan_pass" class="btn btn-primary">Simpan</button>
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