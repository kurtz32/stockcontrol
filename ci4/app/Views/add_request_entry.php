<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('requests') ?>">Request Lists</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('requested-item/' . $type . '/' . $id) ?>">Request Form</a></li>
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
                                        <h4 class="card-title">Add New Room/ Location Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $input = session()->getFlashdata('input');
                                        $errors = session()->getFlashdata('errors');
                                        ?>
                                        <form action="<?= base_url('data/add-request-entry') ?>" method="post" autocomplete="off">
                                            <div class="form-group">
                                                <label>Division</label>
                                                <input type="text" name="division" value="<?= isset($input['division']) ? $input['division'] : $request['division'] ?>" class="form-control<?= (isset($errors['division']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['division']) ? $errors['division'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Responsibility Center Code</label>
                                                <input type="text" name="code" value="<?= isset($input['code']) ? $input['code'] : $request['code'] ?>" class="form-control<?= (isset($errors['code']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['code']) ? $errors['code'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>RIS No.</label>
                                                <input type="text" name="risNo" value="<?= isset($input['risNo']) ? $input['risNo'] : $request['risNo'] ?>" class="form-control<?= (isset($errors['risNo']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['risNo']) ? $errors['risNo'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Is The Item Available?</label><br />
                                                <select type="text" name="available" class="form-control<?= (isset($errors['available']) ? ' is-invalid' : '') ?>">
                                                    <option hidden></option>
                                                    <option <?= $request['available'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                                                    <option <?= $request['available'] == 'No' ? 'selected' : '' ?>>No</option>
                                                </select>
                                                <small class="text-danger"><?= isset($errors['available']) ? $errors['available'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Issue Quantity</label>
                                                <input type="text" name="issue_qty" value="<?= isset($input['issue_qty']) ? $input['issue_qty'] : $request['issue_qty'] ?>" class="form-control<?= (isset($errors['issue_qty']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['issue_qty']) ? $errors['issue_qty'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea name="remarks" class="form-control<?= (isset($errors['remarks']) ? ' is-invalid' : '') ?>"><?= isset($input['remarks']) ? $input['remarks'] : $request['remarks'] ?></textarea>
                                                <small class="text-danger"><?= isset($errors['remarks']) ? $errors['remarks'] : '' ?></small>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Approved By</label><br />
                                                        <select type="text" name="approved_by" class="form-control<?= (isset($errors['approved_by']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <option <?= $request['approved_by'] == session()->get('name') ? 'selected' : '' ?>><?= session()->get('name') ?></option>
                                                            <?php foreach ($employees as $employee) : ?>
                                                                <option <?= $request['approved_by'] == $employee['name'] ? 'selected' : '' ?>><?= $employee['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['approved_by']) ? $errors['approved_by'] : '' ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Approved Date</label>
                                                        <input type="text" name="approved_date" value="<?= $request['approved_date'] ?>" class="form-control datetimepicker">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Issued By</label><br />
                                                        <select type="text" name="issued_by" class="form-control<?= (isset($errors['issued_by']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <option <?= $request['issued_by'] == session()->get('name') ? 'selected' : '' ?>><?= session()->get('name') ?></option>
                                                            <?php foreach ($employees as $employee) : ?>
                                                                <option <?= $request['issued_by'] == $employee['name'] ? 'selected' : '' ?>><?= $employee['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['issued_by']) ? $errors['issued_by'] : '' ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Issued Date</label>
                                                        <input type="text" name="issued_date" value="<?= $request['issued_date'] ?>" class="form-control datetimepicker">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Received By</label><br />
                                                        <select type="text" name="received_by" class="form-control<?= (isset($errors['received_by']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <option <?= $request['received_by'] == session()->get('name') ? 'selected' : '' ?>><?= session()->get('name') ?></option>
                                                            <?php foreach ($employees as $employee) : ?>
                                                                <option <?= $request['received_by'] == $employee['name'] ? 'selected' : '' ?>><?= $employee['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['received_by']) ? $errors['received_by'] : '' ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Received Date</label>
                                                        <input type="text" name="received_date" value="<?= $request['received_date'] ?>" class="form-control datetimepicker">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <input type="hidden" name="item_id" value="<?= $request['item_id'] ?>">
                                                <input type="hidden" name="type" value="<?= $type ?>">
                                            </div>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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