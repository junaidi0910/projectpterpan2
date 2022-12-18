<?php 
session_start();
include"config/koneksi.php";
if (!isset($_SESSION['id_user'])) {
    header("location: index.php");
}
$pengaturan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pengaturan WHERE id_pengaturan=1"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $pengaturan['nama_aplikasi']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?= $pengaturan['nama_aplikasi']; ?>" name="keywords">
    <meta content="<?= $pengaturan['nama_aplikasi']; ?>" name="description">

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
    <div id="notif">
    </div>
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


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6">
                        <div style="background-color: #00b4d8; color: black;" class=" rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa fa-3x text-primary"><img style="width: 50px;" src="https://cdn-icons-png.flaticon.com/512/4900/4900728.png"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Driver</p>
                                <h6 class="mb-0">
                                    <?php 
                                    $driver=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM user WHERE level='driver'"));
                                    ?>
                                    <?= $driver; ?> Orang
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div style="background-color: #90e0ef; color: black;" class=" rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa fa-3x text-primary"><img style="width: 50px;" src="https://cdn-icons-png.flaticon.com/512/1048/1048313.png"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Mobil</p>
                                <h6 class="mb-0">
                                    <?php 
                                    $mobil=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM mobil"));
                                    ?>
                                    <?= $mobil; ?> Unit
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-8">
                        <div style="background-color: #ffb703;" class="text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Realtime Status Driver</h6>
                            </div>
                            <div id="statusdriver">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div style="background-color: #fff3b0; color: black;" class="h-100 rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Kalender</h6>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div style="background-color: #2ec4b6;" class="text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Realtime Permintaan Driver</h6>
                    </div>
                    <div class="table-responsive">
                        <div id="permintaandriver">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->

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
    <script type="text/javascript">
      function loadDriver() {
        setInterval(function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("statusdriver").innerHTML = this.responseText;
              }
          };
          xhttp.open("GET", "get_status_driver.php", true);
          xhttp.send();
      },1500);
    }
    loadDriver();
</script>
<script type="text/javascript">
  function loadDoc() {
    setInterval(function(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("permintaandriver").innerHTML = this.responseText;
          }
      };
      xhttp.open("GET", "get_request_driver.php", true);
      xhttp.send();
  },1500);
}
loadDoc();
</script>
<script type="text/javascript">
  function loadNotif() {
    setInterval(function(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("notif").innerHTML = this.responseText;
          }
      };
      xhttp.open("GET", "get_notif.php", true);
      xhttp.send();
  },1500);
}
loadNotif();
</script>
</body>

</html>