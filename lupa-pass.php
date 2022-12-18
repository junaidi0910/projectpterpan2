<?php 
session_start();
include"config/koneksi.php";
$pengaturan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pengaturan WHERE id_pengaturan=1"));
if (isset($_SESSION['id_user'])) {
    header("location: dashboard.php");
}
if (isset($_POST['simpan'])) {
    $username=mysqli_real_escape_string($koneksi, $_POST['username']);
    $password=mysqli_real_escape_string($koneksi, md5($_POST['password']));
    $update=mysqli_query($koneksi,"UPDATE user SET password='$password' WHERE username='$username'");
    if ($update) {
        echo "<script>window.alert('Password berhasil diubah, silahkan login menggunakan password baru anda !!!')
        window.location='index.php'</script>";
    }
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
    <style type="text/css">
        body{
            background-image: url('img/<?= $pengaturan['bg']; ?>');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <?php 
            if (!isset($_POST['cek'])) {
                ?>
                <form action="" method="post">
                    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" autofocus="on" autocomplete="off" class="form-control" id="floatingInput" placeholder="Cek Username" required>
                                    <label for="floatingInput">Username</label>
                                </div>
                                <button type="submit" name="cek" class="btn btn-primary py-3 w-100 mb-4">Cek Akun</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php }else{ 
                $username=mysqli_real_escape_string($koneksi, $_POST['username']);
                $cek_data=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'"));
                if ($cek_data > 0) {
                    ?>
                    <form action="" method="post">
                        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" name="username" value="<?= $username; ?>">
                                        <input type="text" name="password" autofocus="on" autocomplete="off" class="form-control" id="floatingInput" placeholder="Masukan password baru anda" required>
                                        <label for="floatingInput">Password baru</label>
                                    </div>
                                    <button type="submit" name="simpan" class="btn btn-primary py-3 w-100 mb-4">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php }else{
                    echo "<script>window.alert('Akun tidak ditemukan !!!')
                    window.location='lupa-pass.php'</script>";
                } 
            }
            ?>
        </div>
        <!-- Sign In End -->
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
    <script>
        window.setTimeout (function(){
            $ (".alert").fadeTo(500, 0). slideUp(500, function(){
                $(this).remove();
            });
        }, 2000);
    </script>
</body>

</html>