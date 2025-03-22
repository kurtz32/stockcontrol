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
            <a href="<?= base_url('add-request') ?>" class="btn btn-primary">Add Request</a>
        </div> -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable-desc table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Requested At</th>
                                        <th>Stock No.</th>
                                        <th>Unit</th>
                                        <th>Supply Name</th>
                                        <th>Quantity</th>
                                        <th>Requested By</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($requestSupplies as $request) : ?>
                                        <tr <?= $request['status'] != 'pending' ? $request['status'] == 'done' ? 'class="bg-success"' : 'class="bg-danger"' : '' ?>>
                                            <td><?= date('Y-m-d h:i A', strtotime($request['created_at'])) ?></td>
                                            <td><?= $request['stock_no'] ?></td>
                                            <td><?= $request['unitName'] ?></td>
                                            <td><?= $request['name'] ?></td>
                                            <td><?= $request['request_qty'] ?></td>
                                            <td><?= $request['employeeName'] ?></td>
                                            <td><?= $request['status'] ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('requested-item/' . $request['type'] . '/' . str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypter->encrypt($request['id'])))) ?>">View</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php foreach ($requestEquipments as $request) : ?>
                                        <tr <?= $request['status'] != 'pending' ? $request['status'] == 'done' ? 'class="bg-success"' : 'class="bg-danger"' : '' ?>>
                                            <td><?= date('Y-m-d h:i A', strtotime($request['created_at'])) ?></td>
                                            <td><?= $request['property_no'] ?></td>
                                            <td><?= $request['unitName'] ?></td>
                                            <td><?= $request['name'] ?></td>
                                            <td><?= $request['request_qty'] ?></td>
                                            <td><?= $request['employeeName'] ?></td>
                                            <td><?= $request['status'] ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('requested-item/' . $request['type'] . '/' . str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypter->encrypt($request['id'])))) ?>">View</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Requested At</th>
                                        <th>Stock No.</th>
                                        <th>Unit</th>
                                        <th>Supply Name</th>
                                        <th>Quantity</th>
                                        <th>Requested By</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>