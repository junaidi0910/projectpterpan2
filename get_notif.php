<?php 
include"config/koneksi.php";
$jum_notif=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbl_kegiatan WHERE status_read=1"));
if ($jum_notif !==0) {
    ?>
    <iframe src="lib/notif.wav" allow="autoplay" id="audio" style="display:none"></iframe>
    <?php } ?>