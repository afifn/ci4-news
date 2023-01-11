<?= $this->extend('layout/app'); ?>

<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endsection(); ?>

<?= $this->section('content'); ?>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <?php foreach ($newss as $news) : ?>
                <div class="post-preview">
                    <a href="<?= base_url('view/' . $news->slug) ?>">
                        <h2 class="post-title"><?= $news->title ?></h2>
                        <!-- <h3 class="post-subtitle"><?= $news->content ?></h3> -->
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#!"><?= $news->author ?></a>
                        on <?= $news->created_at ?>
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />
            <?php endforeach; ?>
            <!-- Pager-->
            <?php $pager = \Config\Services::pager(); ?>
            <?php if ($pager) : ?>
                <?= $pager->links() ?>
            <?php endif; ?>
            <!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div> -->
        </div>
    </div>
</div>
<?= $this->endsection() ?>