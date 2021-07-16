<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Karyawan</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php foreach ($karyawan as $i => $k) : ?>
                            <tr>
                                <td><?= ($i + 1) ?></td>
                                <td><?= $k->nama_pegawai ?></td>
                                <td><?php echo anchor('manajer/absensi/detail/' . $k->id_pegawai, '<div class = "btn btn-success btn-sm"><i class = "fa fa-search-plus"></i></div>') ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>