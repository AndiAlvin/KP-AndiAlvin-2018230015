<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <?php foreach ($set_jam as $sj); ?>

    <div class="card" style="width: 60%;margin-bottom: 100px;">
        <div class="card-body">

            <form method="POST" action="<?php echo base_url('manajer/Jam/UpdateDataAksi') ?>">
                <div class="form-group">
                    <label>Jenis Mulai</label>
                    <input type="hidden" name="id_jam" class="form-control" value="<?php echo $sj->id_jam ?>">
                    <input type="time" name="start" class="form-control" value="<?php echo $sj->start ?>">
                </div>
                <div class="form-group">
                    <label>Jam Selesai</label>
                    <input type="time" name="finish" class="form-control" value="<?php echo $sj->finish ?>">
                </div>
                <button type="submit" class="btn btn-success">update</button>
            </form>
        </div>
    </div>



</div>