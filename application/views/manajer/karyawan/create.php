<div class="row">
    <div class="col-12">
        <div class="card">
            <form action="<?= base_url('manajer/karyawan/store') ?>" method="post">
                <div class="card-header">
                    <h4 class="card-title">Tambah Karyawan</h4>
                </div>
                <div class="card-body border-top py-0 my-3">
                    <h4 class="text-muted my-3">Profil</h4>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="nik">NIk : </label>
                                <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukan NIK Karyawan" required="reuqired" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="nama_pegawai">Nama Lengkap : </label>
                                <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" placeholder="Masukana Nama Lengkap Karyawan" required="reuqired" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk : </label>
                                <input type="date name=" tanggal_masuk" id="tanggal_masuk" class="form-control" placeholder="Masukan No. Telp" required="reuqired" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="status">Status : </label>
                                <select name="status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="Pegawai Tetap">Pegawai Tetap</option>
                                    <option value="Pegawai Tidak Tetap">Pegawai Tidak Tetap</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="divisi">Divisi : </label>
                                <select name="divisi" id="divisi" class="form-control">
                                    <option value="" disabled selected>-- Pilih Divisi --</option>
                                    <?php foreach ($divisi as $d) : ?>
                                        <option value="<?= $d->id_jabatan ?>"><?= $d->nama_jabatan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-0 my-3">
                    <h4 class="text-muted my-3">Akun</h4>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Masukan Username" required="reuqired" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="********" required="reuqired" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>