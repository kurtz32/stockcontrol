<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <?php if(session()->get('name') == 'Ruel Erida') : ?>
                        <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('departments') ?>">Departments</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-title px-4 pt-4">
                        <h4>List of Equipments in <?= $title ?></h4>
                    </div>
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
                                        <?php if (session()->get('username') == 'ruel') : ?>
                                            <th>Unit Cost</th>
                                            <th>Amount</th>
                                            <th>P.R. No.</th>
                                            <th>I.A.R No.</th>
                                        <?php endif; ?>
                                        <th>Transfered Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $item['property_no'] ?></td>
                                            <td><?= $item['unitName'] ?></td>
                                            <td><?= $item['description'] ?></td>
                                            <td><?= $item['issueQty'] ?></td>
                                            <?php if (session()->get('username') == 'ruel') : ?>
                                                <td><?= number_format($item['unit_cost'], 2) ?></td>
                                                <td><?= number_format($item['quantity'] * $item['unit_cost'], 2) ?></td>
                                                <td><?= $item['pr_no'] ?></td>
                                                <td><?= $item['iar_no'] ?></td>
                                            <?php endif; ?>
                                            <td><?= date('d-M-y', strtotime($item['date'])) ?></td>
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
                                        <?php if (session()->get('username') == 'ruel') : ?>
                                            <th>Unit Cost</th>
                                            <th>Amount</th>
                                            <th>P.R. No.</th>
                                            <th>I.A.R No.</th>
                                        <?php endif; ?>
                                        <th>Transfered Date</th>
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