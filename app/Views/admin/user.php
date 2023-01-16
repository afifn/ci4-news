<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<?= $this->endSection(); ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endsection(); ?>
<?= $this->section('title-content') ?>
<?= $title; ?>
<?= $this->endsection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="javascript:void(0)" data-action="<?= base_url('admin/user/store') ?>" type="button" class="btn btn-primary add" style="float: right;">Add Item</a>
                <h5 class="card-title">Data user</h5>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismiss fade show mt-4" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismiss fade show mt-4" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($users as $user) :
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td class="text-end">
                                        <a href="javascript:void(0)" data-name="<?= $user['name'] ?>" data-email="<?= $user['email'] ?>" data-action="<?= base_url('admin/user/update/' . $user['id_user']) ?>" class="btn btn-primary update"><i class="bi bi-pen"></i></a>
                                        <a href="javascript:void(0)" data-action="<?= base_url('admin/user/delete/' . $user['id_user']) ?>" class="btn btn-danger delete"><i class="bi bi-x"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>

<?= $this->section('modal'); ?>
<div class="modal fade" tabindex="-1" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group oldPassword">
                        <label for="old_password">Old password</label>
                        <input type="password" name="old_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="modal" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="text-light">Realy ?</h5>
            </div>
            <div class="modal-body">
                <p>Do you want to continue?</p>
            </div>
            <form action="" method="get">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>

<?= $this->section('js'); ?>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').dataTable();
    });
    $('.add').on('click', function() {
        let modal = $('#myModal');
        let action = $(this).data('action');

        modal.find('input[name=email]').attr('disabled', false)
        modal.find('.oldPassword').hide()
        modal.find('form').attr('action', action);
        modal.modal('show');
    });
    $('.update').on('click', function() {
        let modal = $('#myModal');
        let name = $(this).data('name')
        let email = $(this).data('email')
        let action = $(this).data('action')

        modal.find('input[name=name]').val(name)
        modal.find('input[name=email]').val(email)
        modal.find('input[name=email]').attr('disabled', true)
        modal.find('form').attr('action', action);
        modal.find('.oldPassword').show()
        modal.modal('show');
    })

    $('.delete').on('click', function() {
        let modal = $('#deleteModal');
        let action = $(this).data('action');

        modal.find('form').attr('action', action);
        modal.modal('show');
    });
    $('.alert-dismiss').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-dismiss').slideUp(500);
    });
</script>
<?= $this->endsection(); ?>