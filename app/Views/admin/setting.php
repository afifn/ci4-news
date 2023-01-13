<?= $this->extend('admin/layout/base'); ?>
<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/extensions/filepond/filepond.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css" />
<?= $this->endsection(); ?>
<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endsection(); ?>
<?= $this->section('title-content'); ?>
<?= $title; ?>
<?= $this->endsection(); ?>

<?= $this->section('content'); ?>
<section class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Setting Web</h5>
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
            <form action="<?= base_url('admin/setting/update/1') ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Title</label>
                            <input type="text" name="title" class="form-control" value="<?= $setting->title ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">About</label>
                            <input type="text" name="about" class="form-control" value="<?= $setting->about ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <div class="w-50 ">
                                <img src="<?= base_url('assets/upload/' . $setting->favicon) ?>" class="img-fluid" alt="Responsive Image">
                            </div> -->
                            <div class="form-group">
                                <label for="name">Favicon</label>
                                <input type="file" name="favicon" class="form-control " value="<?= $setting->favicon ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- <div class="w-50">
                                <img src="<?= base_url('assets/upload/' . $setting->logo) ?>" style="width :50px;" class="img-fluid" alt="Responsive Image">
                            </div> -->
                            <div class="form-group">
                                <label for="name">Logo</label>
                                <input type="file" name="logo" class="form-control " value="<?= $setting->logo ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Gallery</h5>
            </div>
            <?php if (session()->getFlashdata('error-gallery')) : ?>
                <div class="alert alert-danger alert-dismiss fade show" role="alert">
                    <?= session()->getFlashdata('error-gallery') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success-gallery')) : ?>
                <div class="alert alert-success alert-dismiss fade show" role="alert">
                    <?= session()->getFlashdata('success-gallery') ?>
                </div>
            <?php endif; ?>
            <div class="card-body">
                <form action="<?= base_url('admin/setting/upload') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="gallery">Gallery</label>
                        <input type="file" name="file_upload[]" multiple class="form-control filepond">
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
                <br>
                <div class="row gallery">
                    <?php foreach ($galleries as $gallery) : ?>
                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#galleryModal-<?= $gallery['id_gallery'] ?>" id="gallery">
                                <img class="w-100" src="<?= base_url('assets/upload/' . $gallery['title']) ?>" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" />
                            </a>
                            <div class="modal fade" tabindex="-1" id="galleryModal-<?= $gallery['id_gallery'] ?>" role="dialog" aria-labelledby="galleryModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Our Gallery</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100 img-fluid" id="gambar" src="<?= base_url('assets/upload/' . $gallery['title']) ?>" />
                                            </div>
                                        </div>
                                        <form action="<?= base_url('admin/setting/delete-gallery/' . $gallery['id_gallery']) ?>" method="get">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endsection(); ?>
<?= $this->section('modal'); ?>

<?= $this->endsection(); ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/assets/extensions/filepond/filepond.js"></script>
<script src="<?= base_url() ?>/assets/extensions/toastify-js/src/toastify.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/filepond.js"></script>
<script>
    $(".alert-dismiss").fadeTo(2000, 500).slideUp(500, function() {
        $(".alert-dismiss").slideUp(500);
    });
    // $('#gallery').on('click', function() {
    //     let action = $(this).data('action')
    //     let modal = $('#galleryModal');
    //     let data = $(this).data('gambar');
    //     console.log(data);

    //     modal.find('#gambar').attr('src', data)
    // });
</script>
<?= $this->endsection() ?>