<?= $this->extend('layout/app'); ?>

<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endsection(); ?>

<?= $this->section('content'); ?>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-8 col-lg-12 col-xl-7">
            <!-- Post preview-->
            <?php foreach ($newss as $news) : ?>
                <div class="row">
                    <div class="post-preview col-8">
                        <a href="<?= base_url('view/' . $news->slug) ?>">
                            <h4><?= $news->title ?></h4>
                            <!-- <h3 class="post-subtitle"><?= $news->content ?></h3> -->
                        </a>
                        <p class="post-meta">
                            <a href="#!"><?= $news->author ?></a>
                            <?= date('d M Y', strtotime($news->created_at)) ?>
                        </p>
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded thumbnail-padding" src="<?= base_url('assets/upload/' . $news->poster) ?>" alt="Responsive image">
                    </div>
                </div>
                <!-- Divider-->
                <hr class="my-4" />
            <?php endforeach; ?>
            <!-- Pager-->
            <?php $pager = \Config\Services::pager(); ?>
            <div style="float: right;">
                <?php if ($pager) : ?>
                    <?= $pager->simpleLinks() ?>
                <?php endif; ?>
            </div>
            <!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div> -->
        </div>
    </div>
</div>
<?= $this->endsection() ?>