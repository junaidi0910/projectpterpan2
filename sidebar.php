<?php 
$id_user=$_SESSION['id_user'];
$data_user=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id_user'"));
?>
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
               <!--  <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form> -->
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                       <!--  <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a> -->
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <?php 
                        if ($_SESSION['level']=="driver") {
                            ?>
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-bell me-lg-2">
                                    <span class="badge bg-primary">
                                        <?php 
                                        $jum_notif=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbl_kegiatan WHERE status_read=1"));
                                        echo $jum_notif;
                                        ?>
                                    </span></i>
                                    <span class="d-none d-lg-inline-flex">Pemberitahuan</span>
                                </a>
                            <?php } ?>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <?php 
                                $notif=mysqli_query($koneksi,"SELECT * FROM tbl_kegiatan INNER JOIN user ON tbl_kegiatan.id_pegawai=user.id_user WHERE status_read=1 ORDER BY id_kegiatan DESC");
                                while ($row_notif=mysqli_fetch_array($notif)) {
                                    ?>
                                    <a href="form-request-driver.php" class="dropdown-item">
                                        <h6 class="fw-normal mb-0"><b>Pemohon</b>: <?= $row_notif['nama_user']; ?></h6>
                                        <small>Tujuan: <span class="badge bg-primary"><?= $row_notif['tujuan']; ?></span></small>
                                    </a>
                                    <hr class="dropdown-divider">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <?php 
                                if ($data_user['foto_user']=="") {
                                    ?>
                                    <img class="rounded-circle me-lg-2" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt="" style="width: 40px; height: 40px;">
                                <?php }else{ ?>
                                    <img class="rounded-circle me-lg-2" src="img/user/<?= $data_user['foto_user']; ?>" alt="" style="width: 40px; height: 40px;">
                                <?php } ?>
                                <span class="d-none d-lg-inline-flex"><?= $_SESSION['nama_user']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="profile.php" class="dropdown-item">My Profile</a>
                                <!-- <a href="#" class="dropdown-item">Settings</a> -->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#keluar" class="dropdown-item">Keluar</a>
                            </div>
                        </div>
                    </div>
                </nav>