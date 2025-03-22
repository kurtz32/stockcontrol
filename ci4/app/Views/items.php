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

        <div class="mb-4">
            <a href="<?= base_url('add-item/' . $type) ?>" class="btn btn-primary">Add <?= ucfirst($type) ?></a>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th><?= $title == 'Supplies' ? 'Stock No.' : 'Property No.' ?></th>
                                        <th>Unit</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Unit Cost</th>
                                        <th>Amount</th>
                                        <th>P.R. No.</th>
                                        <th>I.A.R No.</th>
                                        <th>Acquisitions Date</th>
                                        <th>Requested By</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $type == 'equipments' ? $item['property_no'] : $item['stock_no'] ?></td>
                                            <td><?= $item['unit'] ?></td>
                                            <td><?= $item['description'] ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td>₱<?= number_format($item['unit_cost'], 2) ?></td>
                                            <td>₱<?= number_format($item['quantity'] * $item['unit_cost'], 2) ?></td>
                                            <td><?= $item['pr_no'] ?></td>
                                            <td><?= $item['iar_no'] ?></td>
                                            <td><?= date('d-M-y', strtotime($item['accuisition_date'])) ?></td>
                                            <td><?= $item['employeeName'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                <div class="dropdown-menu">
                                                    <?php if ($title == 'Equipments') : ?>
                                                        <a class="dropdown-item" href="<?= base_url('property-card/' . str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypter->encrypt($item['id'])))) ?>">Property Card</a>
                                                    <?php endif; ?>
                                                    <a class="dropdown-item" href="<?= base_url('edit-item/' . $type . '/' . str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypter->encrypt($item['id'])))) ?>">Edit</a>
                                                    <form action="<?= base_url('data/delete-item') ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                        <input type="hidden" name="id" value="<?= str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypter->encrypt($item['id']))) ?>">
                                                        <input type="hidden" name="type" value="<?= $type ?>">
                                                        <button class="dropdown-item">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <th>Name</th>
                                        <th><?= $title == 'Supplies' ? 'Stock No.' : 'Property No.' ?></th>
                                        <th>Unit</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Unit Cost</th>
                                        <th>Amount</th>
                                        <th>P.R. No.</th>
                                        <th>I.A.R No.</th>
                                        <th>Acquisitions Date</th>
                                        <th>Requested By</th>
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