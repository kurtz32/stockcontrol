<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('requests') ?>">Request Lists</a></li>
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

        <?php if ($request['status'] == 'pending') : ?>
            <div class="mb-4">
                <a href="<?= base_url('add-request-entry/' . $id . '/' . $type) ?>" class="btn btn-primary">Add Entry</a>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-secondary btn-sm mb-3" onclick="window.print()">Print Request Form</button>
                        <div class="table-responsive">
                            <table class="w-100 table-bordered table-hover table-center mb-0" id="printable-table">
                                <thead>
                                    <tr>
                                        <td colspan="5"><b>Division:</b> <?= $request['division'] ?><br /><b>Office:</b> <?= $request['officeName'] ?></td>
                                        <td colspan="3"><b>Responsibility Center code:</b> <?= $request['code'] ?><br /><b>RIS NO.:</b> <?= $request['risNo'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-center"><b><i>Requisition</i></b></td>
                                        <td colspan="2" class="text-center"><b><i>Stock Available?</i></b></td>
                                        <td colspan="2" class="text-center"><b><i>Issue</i></b></td>
                                    </tr>
                                    <tr>
                                        <td>Stock No.</td>
                                        <td>Unit</td>
                                        <td>Description</td>
                                        <td>Quantity</td>
                                        <td>Yes</td>
                                        <td>No</td>
                                        <td>Quantity</td>
                                        <td>Remarks</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $request['type'] == 'equipments' ? $request['property_no'] : $request['stock_no'] ?></td>
                                        <td><?= $request['unitName'] ?></td>
                                        <td><?= $request['description'] ?></td>
                                        <td><?= $request['request_qty'] ?></td>
                                        <td><?= $request['available'] == 'Yes' ? 'Yes' : '' ?></td>
                                        <td><?= $request['available'] == 'No' ? 'No' : '' ?></td>
                                        <td><?= $request['issue_qty'] != 0 ? $request['issue_qty'] : '' ?></td>
                                        <td><?= $request['remarks'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">Purpose: <?= $request['purpose'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><b>Requested by:</b></td>
                                        <td colspan="2"><b>Approved by:</b></td>
                                        <td colspan="2"><b>Issued by:</b></td>
                                        <td><b>Received by:</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Signature:</td>
                                        <td></td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Printed Name:</td>
                                        <td><?= $request['employeeName'] ?></td>
                                        <td colspan="2"><?= $request['approved_by'] ?></td>
                                        <td colspan="2"><?= $request['issued_by'] ?></td>
                                        <td><?= $request['received_by'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Designation:</td>
                                        <td><?= $request['designation'] ?></td>
                                        <td colspan="2"><?= $request['approved_designation'] ?></td>
                                        <td colspan="2"><?= $request['issued_designation'] ?></td>
                                        <td><?= $request['received_designation'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Date:</td>
                                        <td><?= date('M d, Y', strtotime($request['created_at'])) ?></td>
                                        <td colspan="2"><?= $request['approved_date'] != '0000-00-00' ? date('M d, Y', strtotime($request['approved_date'])) : '' ?></td>
                                        <td colspan="2"><?= $request['issued_date'] != '0000-00-00' ? date('M d, Y', strtotime($request['issued_date'])) : '' ?></td>
                                        <td><?= $request['issued_date'] != '0000-00-00' ? date('M d, Y', strtotime($request['issued_date'])) : '' ?></td>
                                    </tr>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>