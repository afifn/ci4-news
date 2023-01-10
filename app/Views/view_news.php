<?= $this->extend('layout/app'); ?>

<?php
echo $this->section('title');
echo $news[0]['title'];
echo $this->endsection();
?>
<?php
echo $this->section('author');
echo $news[0]['author'];
echo $this->endsection();
?>
<?php
echo $this->section('date_post');
echo $news[0]['created_at'];
echo $this->endsection();
?>

<?= $this->section('content'); ?>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <img src="<?= base_url('assets/upload/' . $news[0]['poster']) ?>" class="w-100" alt="" srcset="">
                <p><?= $news[0]['content'] ?></p>
            </div>
        </div>
    </div>
</article>
<?= $this->endsection(); ?>