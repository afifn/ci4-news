<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?>
Contact
<?= $this->endsection(); ?>
<?= $this->section('title-content'); ?>
Contact
<?= $this->endsection(); ?>

<?= $this->section('content'); ?>
<section class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <h5 class="card-title">Data Message</h5>
                    <?php if (session()->getFlashdata('message')) : ?>
                        <div class="alert alert-success alert-dismiss fade show" role="alert">
                            <?= session()->getFlashdata('message') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Message</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($contacts as $c) :
                                    $no++;
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $c['name'] ?></td>
                                        <td class="text-truncated-inline-block text-truncate" style="max-width:160px;"><?= $c['message'] ?></td>
                                        <td class="text-end">
                                            <a href="mailto:<?= $c['email'] ?>" class="btn btn-success btn-icon"><i class="bi bi-envelope"></i> </a>
                                            <a href="javascript:void(0)" class="btn btn-primary btn-icon viewMessage" data-id="<?= $c['id_contact'] ?>"><i class="bi bi-eye"></i> </a>
                                            <a href="<?= base_url('admin/contact/delete/' . $c['id_contact']) ?>" class="btn btn-danger btn-icon delete"><i class="bi bi-trash"></i> </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endsection(); ?>

<?= $this->section('modal'); ?>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal</h5>

                <button class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
            </div>
            <div class="modal-body">
                <table id="tableContact">
                    <!-- <tr>
                        <th>Name</th>
                        <td class="px-2"> : </td>
                        <td id="name">A</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td class="px-2"> : </td>
                        <td id="email"></td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td class="px-2"> : </td>
                        <td id="message"></td>
                    </tr> -->
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>
<?= $this->section('js'); ?>
<script>
    $('.viewMessage').on('click', function() {
        let modal = $('#myModal');
        let contact = $(this).data('contact');
        let id = $(this).data('id');

        $.ajax({
            url: "<?= site_url('admin/contact/get/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data.name);
                $('#tableContact').append("<tr> <th>Name</th> <td class=" + "px-2" + ">:</td> <td>" + data.name + "</td> </tr> <tr> <th>Email</th> <td class=" + "px-2" + ">:</td> <td>" + data.email + "</td> </tr> <tr> <th>Message</th> <td class=" + "px-2" + ">:</td> <td>" + data.message + "</td> </tr>")
            }
        })
        modal.modal('show');
    });
    $('#myModal').on('hidden.bs.modal', function() {
        $('#myModal').find('#tableContact').html("")
    })
    $('.alert-dismiss').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-dismiss').slideUp(500);
    });
</script>
<?= $this->endsection(); ?>