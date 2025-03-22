<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('items/equipments') ?>">Equipments</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('property-card/' . $id) ?>">Property Card</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Add Property Card Entry Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $input = session()->getFlashdata('input');
                                        $errors = session()->getFlashdata('errors');
                                        ?>
                                        <form action="<?= base_url('data/add-property-card-entry') ?>" method="post" autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date</label> <b class="text-danger">*</b>
                                                        <input type="text" name="date" value="<?= isset($input['date']) ? $input['date'] : '' ?>" class="form-control datetimepicker<?= (isset($errors['date']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['date']) ? $errors['date'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Reference/ PAR No.</label> <b class="text-danger">*</b>
                                                        <input type="text" name="referenceNo" value="<?= isset($input['referenceNo']) ? $input['referenceNo'] : '' ?>" class="form-control<?= (isset($errors['referenceNo']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['referenceNo']) ? $errors['referenceNo'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Issue Qty.</label> <b class="text-danger">*</b>
                                                        <input type="text" name="issueQty" value="<?= isset($input['issueQty']) ? $input['issueQty'] : '' ?>" class="form-control<?= (isset($errors['issueQty']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['issueQty']) ? $errors['issueQty'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Department</label> <b class="text-danger">*</b>
                                                        <select name="department" class="form-control<?= (isset($errors['department']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <?php foreach ($departments as $department) : ?>
                                                                <option value="<?= $department['id'] ?>" <?= isset($input['department']) ? $input['department'] == $department['id'] ? 'selected' : '' : '' ?>><?= $department['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['department']) ? $errors['department'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Officer</label> <b class="text-danger">*</b>
                                                        <select name="employee" class="form-control<?= (isset($errors['employee']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <?php foreach ($employees as $employee) : ?>
                                                                <option value="<?= $employee['id'] ?>" <?= isset($input['employee']) && $input['employee'] == $employee['id'] ? 'selected' : '' ?>><?= $employee['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['employee']) ? $errors['employee'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Location</label> <b class="text-danger">*</b>
                                                        <select name="location" class="form-control<?= (isset($errors['location']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <?php foreach ($locations as $location) : ?>
                                                                <option value="<?= $location['id'] ?>" <?= isset($input['location']) && $input['location'] == $location['id'] ? 'selected' : '' ?>><?= $location['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['location']) ? $errors['location'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Thru</label>
                                                        <input type="text" name="thru" value="<?= isset($input['thru']) ? $input['thru'] : '' ?>" class="form-control<?= (isset($errors['thru']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['thru']) ? $errors['thru'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Remarks</label> <b class="text-danger">*</b>
                                                        <input type="text" name="remarks" value="<?= isset($input['remarks']) ? $input['remarks'] : '' ?>" class="form-control<?= (isset($errors['remarks']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['remarks']) ? $errors['remarks'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <input type="hidden" name="id" value="<?= $id ?>">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>