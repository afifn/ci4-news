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
            <h5>Empty</h5>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>