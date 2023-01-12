<?php

use CodeIgniter\Database\BaseUtils;
?>
<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title') ?> <?= $title ?> <?= $this->endsection(); ?>
<?= $this->section('title-content') ?> <?= $title ?> <?= $this->endsection(); ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="javascript:void(0)" data-action="<?= base_url('admin/news/store') ?>" class="btn btn-primary add" style="float: right;">Add Item</a>
                <h5 class="card-title">Data News</h5>

            </div>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismiss fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismiss fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Poster</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($newss as $news) :
                                $no++; ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $news['title'] ?></td>
                                    <td><?= $news['category'] ?></td>
                                    <td><?= $news['author'] ?></td>
                                    <td>
                                        <img class="rounded img-fluid" style="width: 60px;" src="<?= base_url('assets/upload/' . $news['poster'])  ?>">
                                    </td>
                                    <td class="text-end">
                                        <a href="<?= base_url('admin/news/view/' . $news['id_news']) ?>" class="btn btn-success view"><i class="bi bi-eye"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-primary edit" data-action="<?= base_url('admin/news/update/' . $news['id_news']) ?>" data-get="<?= base_url('admin/news/get/' . $news['id_news']) ?>" data-title="<?= $news['title'] ?>" data-category="<?= $news['id_category']  ?>" data-author="<?= $news['author'] ?>" data-content="<?= $news['content'] ?>" data-poster="<?= $news['poster'] ?>"><i class="bi bi-pen"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger delete" data-action="<?= base_url('admin/news/delete/' . $news['id_news']) ?>"><i class="bi bi-x"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endsection(); ?>

<?= $this->section('modal'); ?>
<div class="modal fade" tabindex="-1" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add News</h5>
                <button class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="id_category">Category</label>
                        <select name="id_category" id="" class="form-control" required>
                            <option value="" selected disabled>Select One</option>
                            <?php foreach ($category as $cat) : ?>
                                <option value="<?= $cat['id_category'] ?>"><?= $cat['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea type="text" name="content" id="summernote" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="poster">Poster</label>
                        <input type="file" class="form-control image-preview-filepond" name="poster" id="">
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
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-light">Realy ?</h5>
            </div>
            <div class="modal-body">
                <p>Do you want to continue?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="get">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').dataTable();
    });
    $('.add').on('click', function() {
        const modal = $('#myModal');
        var action = $(this).data('action');

        modal.find('.modal-title').text('Add News');
        modal.find('.save').text('Submit');
        modal.find('#myForm').attr('action', action);
        modal.modal('show')

    });

    $('.edit').on('click', function() {
        const modal = $('#myModal');
        var action = $(this).data('action');
        var get = $(this).data('get');
        var title = $(this).data('title');
        var category = $(this).data('category');
        var author = $(this).data('author');
        var content = $(this).data('content');
        var poster = $(this).data('poster');

        // url = get;
        // console.log(url);
        // $.get(get, function(data, status) {
        //     console.log('data :' + data + 'status ' + status);
        //     $('textarea[name=content]').val(data)
        // });

        modal.find('.modal-title').text('Update News');
        modal.find('input[name=title]').val(title)
        modal.find('select[name=id_category]').val(category)
        modal.find('input[name=author]').val(author)
        // modal.find('textarea[name=content]').val(content)
        $('#summernote').summernote('code', content)

        modal.find('#myForm').attr('action', action);
        modal.find('.save').text('Save change');
        modal.modal('show');
    });

    $('.delete').on('click', function() {
        let modal = $('#deleteModal');
        var action = $(this).data('action');

        modal.find('form').attr('action', action)
        modal.modal('show')
    })

    $('#myModal').on('hidden.bs.modal', function() {
        $('#myModal').find('form')[0].reset();
        $('#summernote').summernote('reset');
    });
    $(document).ready(function() {
        $('#summernote').summernote();
    });

    $(".alert-dismiss").fadeTo(2000, 500).slideUp(500, function() {
        $(".alert-dismiss").slideUp(500);
    });
</script>

<?= $this->endsection() ?>