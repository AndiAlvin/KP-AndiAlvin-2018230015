<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <div class="card" style="width: 50%">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('pegawai/GantiPassword/GantiPasswordAksi') ?>">
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="PassBaru" class="form-control">
                    <?php echo form_error('PassBaru', '<div class="text-small text-danger"></div>') ?>

                </div>
                <div class="form-group">
                    <label>Ulangi Password</label>
                    <input type="password" name="UlangiPass" class="form-control">
                    <?php echo form_error('UlangiPass', '<div class="text-small text-danger"></div>') ?>

                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>