<?php 
session_start();
include"config/koneksi.php";
if (!isset($_SESSION['id_user'])) {
    header("location: index.php");
}
$pengaturan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pengaturan WHERE id_pengaturan=1"));
if (isset($_POST['simpan'])) {
    $nama_user=mysqli_real_escape_string($koneksi, $_POST['nama_user']);
    $username=mysqli_real_escape_string($koneksi, $_POST['username']);
    $password=mysqli_real_escape_string($koneksi, md5($_POST['password']));
    $no_telp=mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $status=mysqli_real_escape_string($koneksi, $_POST['status']);
    $nip="";
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
                $input=mysqli_query($koneksi,"INSERT INTO user VALUES(NULL,'$nama_user','$nip','$username','$password','driver','$no_telp','$status','$x_foto_user')");
            } else {
                echo "<script>window.alert('Ukuran file foto melebihi batas !!!')
                window.location='data-driver.php'</script>";
            }
        }else{
            echo "<script>window.alert('ekstensi file tidak di perbolehkan !!!')
            window.location='data-driver.php'</script>";
        }
    }else{
        $x_foto_user="";
        $input=mysqli_query($koneksi,"INSERT INTO user VALUES(NULL,'$nama_user','$nip','$username','$password','driver','$no_telp','$status','$x_foto_user')");
    }
    header("location: data-driver.php?Berhasil=add");
}
// hapus
if (isset($_GET['aksi'])=="hapus") {
    $id_user=mysqli_real_escape_string($koneksi, $_GET['aqsw']);
    $hapus=mysqli_query($koneksi,"DELETE FROM user WHERE id_user='$id_user'");
    if ($hapus) {
        header("location: data-driver.php?hapus=success");
    }
}
// edit
if (isset($_POST['edit'])) {
    $id_user=mysqli_real_escape_string($koneksi, $_POST['id_user']);
    $nama_user=mysqli_real_escape_string($koneksi, $_POST['nama_user']);
    $username=mysqli_real_escape_string($koneksi, $_POST['username']);
    $no_telp=mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $status=mysqli_real_escape_string($koneksi, $_POST['status']);
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
                $update=mysqli_query($koneksi,"UPDATE user SET nama_user='$nama_user', username='$username', no_telp='$no_telp', status='$status', foto_user='$x_foto_user' WHERE id_user='$id_user'");
            } else {
                echo "<script>window.alert('Ukuran file foto melebihi batas !!!')
                window.location='data-driver.php'</script>";
            }
        }else{
            echo "<script>window.alert('ekstensi file tidak di perbolehkan !!!')
            window.location='data-driver.php'</script>";
        }
    }else{
        $x_foto_user="";
        $update=mysqli_query($koneksi,"UPDATE user SET nama_user='$nama_user', username='$username', no_telp='$no_telp', status='$status' WHERE id_user='$id_user'");
    }
    header("location: data-driver.php?update=success");
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

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Data Driver</h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Tambah Data</a>
                        <a href=""><img width="25" src="https://cdn-icons-png.flaticon.com/512/560/560512.png"> Refresh</a>
                    </div>
                    <div class="table-responsive">
                        <?php 
                        if (isset($_GET['Berhasil'])=='add') {
                            ?>
                            <div class="alert alert-success" role="alert">
                                success tambah data
                            </div>
                            <script type="text/javascript">
                                window.setTimeout(function(){
                                    window.location.replace('data-driver.php');
                                },3000);
                            </script>
                        <?php } ?>
                        <?php 
                        if (isset($_GET['hapus'])=='success') {
                            ?>
                            <div class="alert alert-success" role="alert">
                                success hapus data
                            </div>
                            <script type="text/javascript">
                                window.setTimeout(function(){
                                    window.location.replace('data-driver.php');
                                },3000);
                            </script>
                        <?php } ?>
                        <?php 
                        if (isset($_GET['update'])=='success') {
                            ?>
                            <div class="alert alert-success" role="alert">
                                success update data
                            </div>
                            <script type="text/javascript">
                                window.setTimeout(function(){
                                    window.location.replace('data-driver.php');
                                },3000);
                            </script>
                        <?php } ?>
                        <table style="font-size: 10pt;" class="bg-white text-dark table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Opsi</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama Driver</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">password Enkripsi</th>
                                    <th scope="col">No Telp</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $driver=mysqli_query($koneksi,"SELECT * FROM user WHERE level='driver'");
                                while ($tampil_driver=mysqli_fetch_array($driver)) {
                                 ?>
                                 <tr>
                                    <td>
                                        <a onclick="return confirm('Hapus driver <?= $tampil_driver['nama_user']; ?> ?')" href="data-driver.php?aksi=hapus&aqsw=<?= $tampil_driver['id_user']; ?>"><img width="30" src="https://cdn-icons-png.flaticon.com/512/5028/5028066.png"></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit<?= $tampil_driver['id_user']; ?>"><img width="30" src="https://cdn-icons-png.flaticon.com/512/5996/5996831.png"></a>
                                    </td>
                                    <td>
                                        <?php 
                                        if ($tampil_driver['foto_user']=="") {
                                            ?>
                                            <img width="50" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png">
                                        <?php }else{ ?>
                                            <img width="50" src="img/user/<?= $tampil_driver['foto_user']; ?>">
                                        <?php } ?>
                                    </td>
                                    <td><?= $tampil_driver['nama_user']; ?></td>
                                    <td><?= $tampil_driver['username']; ?></td>
                                    <td><?= $tampil_driver['password']; ?></td>
                                    <td><?= $tampil_driver['no_telp']; ?></td>
                                    <td><?= $tampil_driver['status']; ?></td>
                                </tr>
                                <div class="modal fade" id="edit<?= $tampil_driver['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Driver</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Nama Driver</label>
                                                        <input type="hidden" name="id_user" value="<?= $tampil_driver['id_user']; ?>">
                                                        <input type="text" name="nama_user" value="<?= $tampil_driver['nama_user']; ?>" autocomplete="off" placeholder="Nama Driver" class="form-control form-control-sm" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                                        <input type="text" name="username" autocomplete="off" value="<?= $tampil_driver['username']; ?>" placeholder="Username" class="form-control form-control-sm" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">No Telp</label>
                                                        <input type="text" autocomplete="off" name="no_telp" value="<?= $tampil_driver['no_telp']; ?>" placeholder="No Telp" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Status</label>
                                                        <input type="text" autocomplete="off" name="status" value="<?= $tampil_driver['status']; ?>" placeholder="Status" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Foto (Jika ada)</label><br>
                                                        <img width="50" src="img/user/<?= $tampil_driver['foto_user']; ?>"><br><br>
                                                        <input type="file" accept="image/*" name="foto_user" class="form-control form-control-sm">
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Driver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Driver</label>
                        <input autofocus="on" type="text" name="nama_user" autocomplete="off" placeholder="Nama Driver" class="form-control form-control-sm is-valid" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" name="username" autocomplete="off" placeholder="Username" class="form-control form-control-sm is-valid" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input type="text" autocomplete="off" name="password" placeholder="Buat Password" class="form-control form-control-sm is-valid" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No Telp</label>
                        <input type="text" autocomplete="off" name="no_telp" placeholder="No Telp" class="form-control form-control-sm is-valid">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <input type="text" autocomplete="off" name="status" placeholder="Status Driver" class="form-control form-control-sm is-valid">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Foto (Jika ada)</label>
                        <input type="file" accept="image/*" name="foto_user" class="form-control form-control-sm is-valid">
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
<script>
    window.setTimeout (function(){
        $ (".alert").fadeTo(500, 0). slideUp(500, function(){
            $(this).remove();
        });
    }, 2000);
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