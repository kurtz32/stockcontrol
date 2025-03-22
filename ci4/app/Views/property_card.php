<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('items/equipments') ?>">Equipments</a></li>
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
            <a href="<?= base_url('add-property-card-entry/' . $id) ?>" class="btn btn-primary">Add Entry</a>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <td colspan="6"><b>Property, Plant and Equipment:</b> <?= $item['name'] ?></td>
                                        <td colspan="2" rowspan="2"><b>Property Number:</b> <?= $item['property_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><b>Description:</b> <?= $item['description'] ?></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2"><b>Date</b></td>
                                        <td rowspan="2"><b>Reference/ <?= $item['unit_cost'] > 50000 ? 'PAR No.' : 'ICS No.' ?></b></td>
                                        <td><b>Receipt</b></td>
                                        <td colspan="2"><b>Issue/Transfer/Disposal</b></td>
                                        <td><b>Balance</b></td>
                                        <td rowspan="2"><b>Amount</b></td>
                                        <td rowspan="2"><b>Remarks</b></td>
                                    </tr>
                                    <tr>
                                        <td>Qty.</td>
                                        <td>Qty.</td>
                                        <td>Office/ Officer</td>
                                        <td>Qty.</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tracker as $track) : ?>
                                        <tr>
                                            <td><?= $track['date'] ?></td>
                                            <td><?= $track['referenceNo'] ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= $track['issueQty'] ?></td>
                                            <td><?= $track['departmentName'] . ' - ' . $track['employeeName'] ?><?= $track['thru'] ? ' thru ' . $track['thru'] : '' ?></td>
                                            <td><?= $track['balanceQty'] ?></td>
                                            <td>₱<?= number_format($item['unit_cost'], 2) ?></td>
                                            <td><?= $track['remarks'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfooter></tfooter>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>