<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endsection(); ?>
<?= $this->section('title-content'); ?>
Detail Data
<?= $this->endsection(); ?>

<?= $this->section('content'); ?>
<section class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <?php foreach ($newss as $key => $news) : ?>
                        <h5 class="card-title"><?= $news['title'] ?></h5>
                        <p class="fw-light"><?= $news['category'] ?></p>
                        <img class="rounded w-100 mb-3" src="<?= base_url('assets/upload/' . $news['poster']) ?>" alt="">
                        <br>
                        <p class="card-text mb-2 text-justify">
                            <?= $news['content'] ?>
                        </p>
                        <p class="text-end"><?= $news['author'] ?></p>

                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endsection(); ?>