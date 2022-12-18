<?php 
session_start();
include"config/koneksi.php";
$pengaturan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pengaturan WHERE id_pengaturan=1"));
if (isset($_POST['login'])) {
    $username=mysqli_real_escape_string($koneksi, $_POST['username']);
    $password=mysqli_real_escape_string($koneksi, md5($_POST['password']));
    $user=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' AND password='$password'");
    $cek_user=mysqli_num_rows($user);
    $data_user=mysqli_fetch_array($user);
    if ($cek_user > 0) {
        $_SESSION['id_user']=$data_user['id_user'];
        $_SESSION['nama_user']=$data_user['nama_user'];
        $_SESSION['username']=$data_user['username'];
        $_SESSION['level']=$data_user['level'];
        header("location: index.php?login=success");
    }else{
        header("location: index.php?gagal=login");
    }
}
if (isset($_SESSION['id_user'])) {
    header("location: dashboard.php");
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
            <form action="" method="post">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h3 class="text-primary"><img width="50" src="img/<?= $pengaturan['logo']; ?>"> <?= $pengaturan['nama_aplikasi']; ?></h3>
                                </a>
                                <h3></h3>
                            </div>
                            <?php 
                            if (isset($_GET['login'])=='success') {
                                ?>
                                <div class="alert alert-success" role="alert">
                                    login success
                                </div>
                                <script type="text/javascript">
                                    window.setTimeout(function(){
                                        window.location.replace('dashboard.php');
                                    },3000);
                                </script>
                            <?php } ?>
                            <?php 
                            if (isset($_GET['gagal'])=='login') {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    login gagal
                                </div>
                                <script type="text/javascript">
                                    window.setTimeout(function(){
                                        window.location.replace('index.php');
                                    },3000);
                                </script>
                            <?php } ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="username" autofocus="on" autocomplete="off" class="form-control" id="floatingInput" placeholder="Username" required>
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                </div>
                                <a href="lupa-pass.php">Lupa Password</a>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary py-3 w-100 mb-4">Masuk</button>
                        </div>
                    </div>
                </div>
            </form>
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