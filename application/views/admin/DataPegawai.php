<!-- Begin Page Content -->
<div class="container-fluid" style="margin-bottom: 100px">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pegawai</h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php echo form_open('admin/DataPegawai/search') ?>
            <div class="input-group mb-3">
                <input type="text" name="keyword" class="form-control" placeholder="search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success">Cari</button>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>


    <?php echo $this->session->flashdata('pesan') ?>

    <a class="mb-2 mt-2 btn-sm btn-success" href="<?php echo base_url('admin/DataPegawai/TambahData') ?>"><i class="fas fa-plus"></i>Tambah Pegawai</a>

    <table class="table table-striped table-bordered">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIK</th>
            <th class="text-center">Nama Pegawai</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Pernikahan</th>
            <th class="text-center">Jabatan</th>
            <th class="text-center">Tanggal Masuk</th>
            <th class="text-center">Status</th>
            <th class="text-center">Photo</th>
            <th class="text-center">Hak Akses</th>
            <th class="text-center">Action</th>
        </tr>
        <?php $no = 1;
        foreach ($pegawai as $p) : ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $p->nik ?></td>
                <td><?php echo $p->nama_pegawai ?></td>
                <td><?php echo $p->jenis_kelamin ?></td>
                <td><?php echo $p->pernikahan ?></td>
                <td><?php echo $p->jabatan ?></td>
                <td><?php echo $p->tanggal_masuk ?></td>
                <td><?php echo $p->status ?></td>
                <td><img src="<?php echo base_url() . 'assets/photo/' . $p->photo ?>" width="75px"></td>

                <?php if ($p->hak_akses == '1') { ?>
                    <td>Admin</td>
                <?php } elseif ($p->hak_akses == '2') { ?>
                    <td>Pegawai</td>
                <?php } else { ?>
                    <td>Manajer</td>
                <?php } ?> ?>
                <td>
                    <center>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/DataPegawai/UpdateData/' . $p->id_pegawai) ?>"><i class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Apakah Yakin Ingin di Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/DataPegawai/DeleteData/' . $p->id_pegawai) ?>"><i class="fas fa-trash"></i></a>
                    </center>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

</div>