<?php 
$id_user=$_SESSION['id_user'];
$data_user=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id_user'"));
?>
<div class="modal fade" id="keluar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Notif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda ingin keluar dari aplikasi ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <a href="logout.php" class="btn btn-primary">Ya</a>
            </div>
        </div>
    </div>
</div>
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa me-2"><img width="25" src="img/<?= $pengaturan['logo']; ?>"></i><?= $pengaturan['nama_aplikasi']; ?></h3>
        </a>
        <a href="profile.php" style="text-decoration: none;">
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <?php 
                    if ($data_user['foto_user']=="") {
                        ?>
                        <img class="rounded-circle" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" style="width: 40px; height: 40px;">
                    <?php }else{ ?>
                        <img class="rounded-circle" src="img/user/<?= $data_user['foto_user']; ?>" alt="" style="width: 40px; height: 40px;">
                    <?php } ?>
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0"><?= $_SESSION['nama_user']; ?></h6>
                    <span><?= $_SESSION['level']; ?></span>
                </div>
            </div>
        </a>
        <div class="navbar-nav w-100">
            <a href="dashboard.php" class="nav-item nav-link active"><i class="fa fa me-2"><img style="width: 20px;" src="https://cdn-icons-png.flaticon.com/512/1828/1828673.png"></i>Dashboard</a>
            <?php 
            if ($_SESSION['level']=="pegawai" OR $_SESSION['level']=="driver"){ 
                ?>
                <a href="form-request-driver.php" class="nav-item nav-link"><i class="fa fa me-2"><img style="width: 26px;" src="https://cdn-icons-png.flaticon.com/512/4422/4422587.png"></i>Request Driver</a>
            <?php } ?>
             <?php 
            if ($_SESSION['level']=="driver"){ 
                ?>
                <a href="data-driver.php" class="nav-item nav-link"><i class="fa fa me-2"><img style="width: 20px;" src="https://cdn-icons-png.flaticon.com/512/4900/4900728.png"></i>Data Driver</a>
            <?php } ?>
            <?php 
            if ($_SESSION['level']=="admin"){ 
                ?>
                <a href="data-driver.php" class="nav-item nav-link"><i class="fa fa me-2"><img style="width: 20px;" src="https://cdn-icons-png.flaticon.com/512/4900/4900728.png"></i>Data Driver</a>
                <a href="data-mobil.php" class="nav-item nav-link"><i class="fa fa me-2"><img style="width: 20px;" src="https://cdn-icons-png.flaticon.com/512/1048/1048313.png"></i>Data Mobil</a>
                <a href="data-pegawai.php" class="nav-item nav-link"><i class="fa fa me-2"><img style="width: 26px;" src="https://cdn-icons-png.flaticon.com/512/6186/6186048.png"></i>Data Pegawai</a>
                <a href="pengaturan.php" class="nav-item nav-link"><i class="fa fa me-2"><img style="width: 20px;" src="https://cdn-icons-png.flaticon.com/512/3132/3132084.png"></i>Pengaturan</a>
            <?php } ?>
            <a href="#" data-bs-toggle="modal" data-bs-target="#keluar" class="nav-item nav-link"><i class="fa fa me-2"><img style="width: 20px;" src="https://cdn-icons-png.flaticon.com/512/1828/1828490.png"></i>Keluar</a>
        </div>
    </nav>
</div>