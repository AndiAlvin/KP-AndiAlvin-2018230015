<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php echo form_open('admin/DataJabatan/search') ?>
            <div class="input-group mb-3">
                <input type="text" name="keyword" class="form-control" placeholder="search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success">Cari</button>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-sm btn-success mb-3" href="<?php echo base_url('admin/DataJabatan/TambahData') ?>"><i class="fas fa-plus">Tambah Data</i></a>
    <?php echo $this->session->flashdata('pesan') ?>
    <table class="table table-bordered tabel-striped mt-2">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Jabatan</th>
            <th class="text-center">Gaji Pokok</th>
            <th class="text-center">Tunjangan Transport</th>
            <th class="text-center">Uang Makan</th>
            <th class="text-center">Total</th>
            <th class="text-center">Action</th>
        </tr>
        <?php $No = 1;
        foreach ($jabatan as $j) : ?>
            <tr>
                <td><?php echo $No++ ?></td>
                <td><?php echo $j->nama_jabatan ?></td>
                <td>Rp. <?php echo number_format($j->gaji_pokok, 0, ',', '.') ?></td>
                <td>Rp. <?php echo number_format($j->tj_transport, 0, ',', '.') ?></td>
                <td>Rp. <?php echo number_format($j->uang_makan, 0, ',', '.') ?></td>
                <td>Rp. <?php echo number_format($j->gaji_pokok + $j->tj_transport + $j->uang_makan, 0, ',', '.') ?></td>
                <td>
                    <center>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/DataJabatan/UpdateData/' . $j->id_jabatan) ?>"><i class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Apakah Yakin Ingin di Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/DataJabatan/DeleteData/' . $j->id_jabatan) ?>"><i class="fas fa-trash"></i></a>
                    </center>
                </td>



            </tr>
        <?php endforeach; ?>
    </table>

</div>