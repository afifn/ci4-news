<?= $this->extend('layout/app'); ?>

<?= $this->section('title'); ?>
Contact Us
<?= $this->endsection(); ?>
<?= $this->section('content'); ?>
<div class="container">
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success alert-dismissible alert-dismiss fade show" role="dialog">
                <p>Ini Alert</p>
            </div>
            <form action="<?= base_url('contact-add') ?>" method="post">
                <div class="form-group mb-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="message">Message</label>
                    <textarea type="text" id="editor" rows="10" name="message" class="form-control ck-editor__editable_inline"></textarea>
                </div>
                <div class="justify-content-end">
                    <button class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/ckeditor.js"></script>
<script>
    $(".alert-dismiss").fadeTo(2000, 500).slideUp(500, function() {
        $(".alert-dismiss").slideUp(500);
    });
</script>
<?= $this->endsection(); ?>