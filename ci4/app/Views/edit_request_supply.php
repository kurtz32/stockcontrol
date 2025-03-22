<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <!-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('request-supplies') ?>">Request Lists</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ul> -->
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
                                        <h4 class="card-title">Edit Request Supply Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $input = session()->getFlashdata('input');
                                        $errors = session()->getFlashdata('errors');
                                        ?>
                                        <form action="<?= base_url('data/edit-request-supply') ?>" method="post" autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Office</label> <b class="text-danger">*</b>
                                                        <select name="office" class="form-control<?= (isset($errors['office']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <?php foreach ($departments as $department) : ?>
                                                                <option value="<?= $department['id'] ?>" <?= isset($input['office']) || $request['office'] == $department['id'] ? $department['id'] ? 'selected' : '' : '' ?>><?= $department['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['office']) ? $errors['office'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Item Name</label> <b class="text-danger">*</b>
                                                        <select name="item" class="form-control<?= (isset($errors['item']) ? ' is-invalid' : '') ?>">
                                                            <option hidden></option>
                                                            <?php foreach ($items as $item) : ?>
                                                                <option value="<?= $type . '-' . $item['id'] ?>" <?= $request['item_id'] == $item['id'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <small class="text-danger"><?= isset($errors['item']) ? $errors['item'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Quantity</label> <b class="text-danger">*</b>
                                                        <input type="text" name="requestQty" value="<?= isset($input['requestQty']) ? $input['requestQty'] : $request['request_qty'] ?>" class="form-control<?= (isset($errors['requestQty']) ? ' is-invalid' : '') ?>">
                                                        <small class="text-danger"><?= isset($errors['requestQty']) ? $errors['requestQty'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Purpose</label> <b class="text-danger">*</b>
                                                        <textarea type="text" name="purpose" class="form-control<?= (isset($errors['purpose']) ? ' is-invalid' : '') ?>"><?= isset($input['purpose']) ? $input['purpose'] : $request['purpose'] ?></textarea>
                                                        <small class="text-danger"><?= isset($errors['purpose']) ? $errors['purpose'] : '' ?></small>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?= $request['id'] ?>">
                                                <div class="text-end">
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