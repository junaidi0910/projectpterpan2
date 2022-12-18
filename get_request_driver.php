<table style="background-color: white; color: black; font-size: 10pt;" class="table text-start align-middle table-bordered table-hover mb-0">
    <thead>
        <tr class="text-dark">
            
            <th scope="col">Nama Pemohon</th>
            <th scope="col">Unit Kerja</th>
            <th scope="col">Kegiatan</th>
            <th scope="col">Tujuan</th>
            <th scope="col">Tgl</th>
            <th scope="col">Mulai Jam</th>
            <th scope="col">Sampai Jam</th>
            <th scope="col">Jumlah Penumpang</th>
            <th scope="col">Nama Driver</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        include"config/koneksi.php";
        function formatTanggal($date){
 // ubah string menjadi format tanggal
            return date('d-M-Y', strtotime($date));
        }
        $permintaan_driver=mysqli_query($koneksi,"SELECT * FROM tbl_kegiatan
            INNER JOIN user ON tbl_kegiatan.id_pegawai=user.id_user ORDER BY id_kegiatan DESC");
        while ($tampil_permintaan=mysqli_fetch_array($permintaan_driver)) {
            ?>
            <tr>
                
                <td><?= $tampil_permintaan['nama_user']; ?></td>
                <td><?= $tampil_permintaan['unit_kerja']; ?></td>
                <td><?= $tampil_permintaan['kegiatan']; ?></td>
                <td><?= $tampil_permintaan['tujuan']; ?></td>
                <td><span class="badge bg-primary"><?= formatTanggal($tampil_permintaan['tgl']); ?></span></td>
                <td><?= $tampil_permintaan['mulai_jam']; ?></td>
                <td><?= $tampil_permintaan['sampai_jam']; ?></td>
                <td style="text-align: center;"><?= $tampil_permintaan['jumlah_penumpang']; ?></td>
                <td><span class="badge bg-primary"><?= $tampil_permintaan['nama_driver']; ?></span></td>
            </tr>
        <?php } ?>
    </tbody>
</table>