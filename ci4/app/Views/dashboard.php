<div class="page-wrapper">

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome <?= session()->get('name') ?>!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
                <a href="/employees">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-primary border-primary">
                                    <i class="fe fe-users"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 style="color: #000;"><?= count($employees) ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Employees</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <a href="/requests">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-success">
                                    <i class="fe fe-file"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 style="color: #000;"><?= count($requests) ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Requests</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <a href="/departments">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-danger border-danger">
                                    <i class="fe fe-building"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 style="color: #000;"><?= count($departments) ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Departments</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <a href="/items/equipments">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-warning border-warning">
                                    <i class="fe fe-desktop"></i>
                                </span>
                                <div class="dash-count">
                                    <h3 style="color: #000;"><?= $items['quantity'] ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Equipments</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="card card-table flex-fill" style="max-height: 500px; overflow-y: scroll;">
                    <div class="card-header">
                        <h4 class="card-title">Equipments Acquired By Year
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Acquisition Year</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Property No.</th>
                                        <th>P.R. No.</th>
                                        <th>I.A.R. No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($equipments as $equipment) : ?>
                                        <tr>
                                            <td><?= date('Y', strtotime($equipment['accuisition_date'])) ?></td>
                                            <td><?= $equipment['name'] ?></td>
                                            <td><?= $equipment['quantity'] ?></td>
                                            <td><?= $equipment['property_no'] ?></td>
                                            <td><?= $equipment['pr_no'] ?></td>
                                            <td><?= $equipment['iar_no'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12">

            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="card-title">Requests Frequency</h4>
                </div>
                <div class="card-body">
                    <div id="morrisArea"></div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill" style="max-height: 500px; overflow-y: scroll;">
                    <div class="card-header">
                        <h4 class="card-title">Employees</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Designation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employees as $employee) : ?>
                                        <tr>
                                            <td><?= $employee['name'] ?></td>
                                            <td><?= $employee['designation'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill" style="max-height: 500px; overflow-y: scroll;">
                    <div class="card-header">
                        <h4 class="card-title">Departments</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($departments as $department) : ?>
                                        <tr>
                                            <td><?= $department['name'] ?></td>
                                            <td><?= $department['description'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>