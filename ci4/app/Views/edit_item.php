<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Edit <?= $title ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('items/' . strtolower($title)) ?>"><?= $title ?></a></li>
                        <li class="breadcrumb-item active">Edit <?= $title ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Edit <?= $title ?> Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $input = session()->getFlashdata('input');
                                        $errors = session()->getFlashdata('errors');
                                        ?>
                                        <form action="<?= base_url('data/edit-item') ?>" method="post" autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Item Name</label> <b class="text-danger">*</b>
                                                        <input type="text" name="name" value="<?= isset($input['name']) ? $input['name'] : $item['name'] ?>" class="form-control<?= (isset($errors['name']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['name']) ? $errors['name'] : '' ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Unit</label> <b class="text-danger">*</b>
                                                        <select name="unit" class="form-control<?= (isset($errors['unit']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <?php foreach ($units as $unit) : ?>
                                                                <option value="<?= $unit['id'] ?>" <?= isset($input['unit']) && $input['unit'] == $unit['id'] || $item['unit'] == $unit['id'] ? 'selected' : '' ?>><?= $unit['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['unit']) ? $errors['unit'] : '' ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Quantity</label> <b class="text-danger">*</b>
                                                        <input type="text" name="quantity" value="<?= isset($input['quantity']) && !isset($errors['quantity']) ? $input['quantity'] : $item['quantity'] ?>" class="form-control<?= (isset($errors['quantity']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['quantity']) ? $errors['quantity'] : '' ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Unit Cost</label> <b class="text-danger">*</b>
                                                        <input type="text" name="unit_cost" value="<?= isset($input['unit_cost']) && !isset($errors['unit_cost']) ? $input['unit_cost'] : $item['unit_cost'] ?>" class="form-control<?= (isset($errors['unit_cost']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['unit_cost']) ? $errors['unit_cost'] : '' ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Accuisition Date</label> <b class="text-danger">*</b>
                                                        <input type="text" name="accuisition_date" value="<?= isset($input['accuisition_date']) ? $input['accuisition_date'] : $item['accuisition_date'] ?>" class="form-control datetimepicker<?= (isset($errors['accuisition_date']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['accuisition_date']) ? $errors['accuisition_date'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php if ($type == 'equipments') : ?>
                                                        <div class="form-group">
                                                            <label>Property No.</label> <b class="text-danger">*</b>
                                                            <input type="text" name="item_no" value="<?= isset($input['item_no']) ? $input['item_no'] : $item['property_no'] ?>" class="form-control<?= (isset($errors['item_no']) ? ' is-invalid' : '') ?>">
                                                            <small class="text-danger"><?= isset($errors['item_no']) ? $errors['item_no'] : '' ?></small>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="form-group">
                                                            <label>Stock No.</label> <b class="text-danger">*</b>
                                                            <input type="text" name="item_no" value="<?= isset($input['item_no']) ? $input['item_no'] : $item['stock_no'] ?>" class="form-control<?= (isset($errors['item_no']) ? ' is-invalid' : '') ?>">
                                                            <small class="text-danger"><?= isset($errors['item_no']) ? $errors['item_no'] : '' ?></small>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="form-group">
                                                        <label>P.R. No.</label> <b class="text-danger">*</b>
                                                        <input type="text" name="pr_no" value="<?= isset($input['pr_no']) ? $input['pr_no'] : $item['pr_no'] ?>" class="form-control<?= (isset($errors['pr_no']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['pr_no']) ? $errors['pr_no'] : '' ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>I.A.R. No.</label> <b class="text-danger">*</b>
                                                        <input type="text" name="iar_no" value="<?= isset($input['iar_no']) ? $input['iar_no'] : $item['iar_no'] ?>" class="form-control<?= (isset($errors['iar_no']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['iar_no']) ? $errors['iar_no'] : '' ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Requested By</label> <b class="text-danger">*</b>
                                                        <select name="employee" class="form-control<?= (isset($errors['employee']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <?php foreach ($employees as $employee) : ?>
                                                                <option value="<?= $employee['id'] ?>" <?= isset($input['employee']) && $input['employee'] == $employee['id'] || $item['employee_id'] == $employee['id'] ? 'selected' : '' ?>><?= $employee['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['employee']) ? $errors['employee'] : '' ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label> <b class="text-danger">*</b>
                                                    <textarea name="description" class="form-control<?= (isset($errors['description']) ? ' is-invalid' : '') ?>"><?= isset($input['description']) ? $input['description'] : $item['description'] ?></textarea>
                                                    <small class="text-danger"><?= isset($errors['description']) ? $errors['description'] : '' ?></small>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <input type="hidden" name="type" value="<?= $type ?>">
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