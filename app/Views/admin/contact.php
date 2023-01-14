<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?>
Contact
<?= $this->endsection(); ?>
<?= $this->section('title-content'); ?>
Contact
<?= $this->endsection(); ?>

<?= $this->section('content'); ?>
<section class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <h5 class="card-title">Title</h5>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Message</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($contacts as $c) :
                                    $no++;
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $c['name'] ?></td>
                                        <td><?= $c['message'] ?></td>
                                        <td class="text-end">
                                            <a href="mailto:<?= $c['email'] ?>" class="btn btn-success btn-icon"><i class="bi bi-envelope"></i> </a>
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
</section>
<?= $this->endsection(); ?>