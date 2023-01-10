<?= $this->extend('admin/layout/base') ?>

<?= $this->section('title') ?> <?= $title ?> <?= $this->endsection() ?>
<?= $this->section('title-content') ?> <?= $title ?> <?= $this->endsection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="javascript:void(0)" class="btn btn-primary add" style="float: right;">Add Item</a>
                <h5 class="card-title">Data Category</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($category as $k) :
                                $no++; ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $k['name'] ?></td>
                                    <td class="text-end">
                                        <a href="javascript:void(0)" data-action="<?= base_url('admin/category/update/' . $k['id_category']) ?>" data-category="<?= $k['name'] ?>" data-toggle="modal" data-target="#myModalEdit" class="btn btn-success edit"><i class="bi bi-pen"></i></a>
                                        <a href="javascript:void(0)" data-action="<?= base_url('admin/category/delete/' . $k['id_category']) ?>" class="btn btn-danger delete"><i class="bi bi-x"></i></a>
                                    </td>
                                </tr>
                                <!-- modal edit -->
                                <div class="modal fade" tabindex="-1" role="dialog" id="myModalEdit">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Category</h5>
                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('admin/category/store') ?>" method="post" id="myForm">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" value="" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endsection(); ?>

<?= $this->section('modal'); ?>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="<?= base_url('admin/category/store') ?>" method="post" id="myForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-light">Realy ?</h5>
            </div>
            <div class="modal-body">
                <p>Do you want to continue?</p>
            </div>
            <form action="" method="get" id="formDelete">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').DataTable();
    })
    $('.add').on('click', function() {
        let modal = $('#myModal');
        modal.find('.modal-title').text('Add Catergory');
        modal.modal('show');
    });
    $('.edit').on('click', function() {
        let modal = $('#myModal');
        var category = $(this).data('category');
        var action = $(this).data('action');

        modal.find('.modal-title').text('Update Category');
        modal.find('input[name=name]').val(category);
        modal.find('#myForm').attr('action', action);
        modal.find('.save').text('Save')
        modal.modal('show');
    });
    $('.delete').on('click', function() {
        let modal = $('#modalDelete');
        var action = $(this).data('action');

        modal.find('#formDelete').attr('action', action);
        modal.modal('show')
    });
    $('#myModal').on('hidden.bs.modal', function() {
        $('#myModal').find('form')[0].reset();
    });
</script>
<?= $this->endSection(); ?>