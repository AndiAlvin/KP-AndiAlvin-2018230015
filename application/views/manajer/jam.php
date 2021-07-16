<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>No.</th>
                    <th>Keterangan</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($set_jam as $sj) : ?>
                        <tr>

                            <td><?php echo $no++ ?></td>
                            <td><?php echo $sj->keterangan ?></td>
                            <td><?php echo $sj->start ?></td>
                            <td><?php echo $sj->finish ?></td>
                            <td>
                                <center>
                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('manajer/Jam/UpdateData/' . $sj->id_jam) ?>"><i class="fas fa-edit"></i></a>

                                </center>
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