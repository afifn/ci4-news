<?= $this->extend('layout/app'); ?>

<?php
echo $this->section('title');
echo $title;
echo $this->endsection();
?>

<?= $this->section('content'); ?>
<div class="container px-4 px-lg-5">
    <div class="row">
        <div class="col-lg-12">
            <p class="text-center">
                <?= $setting[0]['about'] ?>
            </p>
        </div>
    </div>
    <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
        <?php foreach ($galleries as $gallery) : ?>
            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-5">
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#galleryModal-<?= $gallery['id_gallery'] ?>">
                    <img class="w-100 active" src="<?= base_url('assets/upload/' . $gallery['title']) ?>" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" />
                </a>
                <div class="modal fade" tabindex="-1" id="galleryModal-<?= $gallery['id_gallery'] ?>" role="dialog" aria-labelledby="galleryModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Our Gallery</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-close bg-light"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 img-fluid" id="gambar" src="<?= base_url('assets/upload/' . $gallery['title']) ?>" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endsection(); ?>