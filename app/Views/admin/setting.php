<?= $this->extend('admin/layout/base'); ?>

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
                        <div class="form-group col-md-6">
                            <label for="name">Favicon</label>
                            <input type="file" name="favicon" class="form-control" value="<?= $setting->favicon ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Logo</label>
                            <input type="file" name="logo" class="form-control" value="<?= $setting->logo ?>">
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
</section>
<?= $this->endsection(); ?>

<?= $this->section('js') ?>
<script>
    $(".alert-dismiss").fadeTo(2000, 500).slideUp(500, function() {
        $(".alert-dismiss").slideUp(500);
    });
</script>
<?= $this->endsection() ?>