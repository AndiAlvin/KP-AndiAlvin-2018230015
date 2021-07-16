<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title float-left">Data Karyawan</h4>
                <div class="d-inline ml-auto float-right">
                    <a href="<?= base_url('manajer/karyawan/create') ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <th>No</th>
                            <th width="30%">Karyawan</th>
                            <th>Info</th>
                            <th>Aksi</th>
                            <!-- <th></th> -->
                        </thead>
                        <tbody>
                            <?php foreach ($karyawan as $i => $k) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-4 pr-1">
                                                <img src="<?= base_url('assets/photo/' . $k->photo) ?>" alt="Img Profil" class="img-thumbnail rounded-circle w-100">
                                            </div>
                                            <div class="col-8 pl-1 mt-3">
                                                <span class="font-weight-bold"><?= $k->nama_pegawai ?></span> <br>
                                                <span class="text-muted">Div. <?= $k->jabatan ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <address>
                                            Tanggal Masuk: <?= $k->tanggal_masuk ?> <br>
                                            Tanggal Masuk: <?= $k->status ?>
                                        </address>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('manajer/karyawan/edit/' . $k->id_pegawai) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="<?= base_url('manajer/karyawan/destroy/' . $k->id_pegawai) ?>" class="btn btn-danger btn-sm btn-delete ml-2" onclick="return false"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>