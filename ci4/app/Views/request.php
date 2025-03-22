<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <?php if (session()->get('success') != '') : ?>
            <div class="alert alert-success align-items-center text-center" role="alert">
                <b class="fa fa-info-circle"></b> <?= session()->get('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->get('success-edit') != '') : ?>
            <div class="alert alert-warning align-items-center text-center" role="alert">
                <b class="fa fa-info-circle"></b> <?= session()->get('success-edit') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->get('success-delete') != '') : ?>
            <div class="alert alert-danger align-items-center text-center" role="alert">
                <b class="fa fa-info-circle"></b> <?= session()->get('success-delete') ?>
            </div>
        <?php endif; ?>

        <!-- <div class="mb-4">
            <a href="<?= base_url('add-item-request') ?>" class="btn btn-primary">Add Request</a>
        </div> -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Stock No.</th>
                                        <th>Unit</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Requested By</th>
                                        <th>Room/Location</th>
                                        <th class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfooter>
                                    <tr>
                                        <th>Stock No.</th>
                                        <th>Unit</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Requested By</th>
                                        <th>Room/Location</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- <script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this item?')) {
            document.getElementById('delete-item').submit();
        }
    }
</script> -->