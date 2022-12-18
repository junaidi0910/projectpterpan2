<table style="background-color: white; color: black; font-size: 10pt;" class="table text-start align-middle table-bordered table-hover mb-0">
    <tr class="text-dark">
        <th>Nama Driver</th>
        <th>No Telp</th>
        <th>Status</th>
    </tr>
    <?php 
    include"config/koneksi.php";
    $status_driver=mysqli_query($koneksi,"SELECT * FROM user WHERE level='driver'");
    while ($tampil_status=mysqli_fetch_array($status_driver)) {
        ?>
        <tr>
            <td><span class="badge bg-primary"><?= $tampil_status['nama_user']; ?></span></td>
            <td><?= $tampil_status['no_telp']; ?></td>
            <td><?= $tampil_status['status']; ?></td>
        </tr>
    <?php } ?>
</table>