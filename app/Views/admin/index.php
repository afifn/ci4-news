<?= $this->extend('admin/layout/base') ?>
<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endsection() ?>
<?= $this->section('title-content') ?>
<?= $title ?>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Title Card
                </h5>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</section>
<?= $this->endsection() ?>