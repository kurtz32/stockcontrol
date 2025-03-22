<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
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

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Edit Prifle Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $input = session()->getFlashdata('input');
                                        $errors = session()->getFlashdata('errors');
                                        ?>
                                        <form action="<?= base_url('data/edit-profile') ?>" method="post" autocomplete="off">
                                            <div class="form-group">
                                                <label>Employee Name</label> <b class="text-danger">*</b>
                                                <input type="text" name="name" value="<?= isset($input['name']) ? $input['name'] : session()->get('name') ?>" class="form-control<?= (isset($errors['name']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['name']) ? $errors['name'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Department</label> <b class="text-danger">*</b>
                                                <select name="department" class="form-control<?= (isset($errors['department']) ? ' is-invalid' : '') ?>">
                                                    <option hidden></option>
                                                    <?php foreach ($departments as $department) : ?>
                                                        <option value="<?= $department['id'] ?>" <?= $department['id'] == session()->get('department_id') ? 'selected' : '' ?>><?= $department['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="text-danger"><?= isset($errors['department']) ? $errors['department'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label> <b class="text-danger">*</b>
                                                <input type="text" name="username" value="<?= isset($input['username']) ? $input['username'] : session()->get('username') ?>" class="form-control<?= (isset($errors['username']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['username']) ? $errors['username'] : '' ?></small>
                                            </div>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Change Password</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url('data/change-password') ?>" method="post" autocomplete="off">
                                            <div class="form-group">
                                                <label>Current Password</label> <b class="text-danger">*</b>
                                                <input type="password" name="current_password" class="form-control<?= (isset($errors['current_password']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['current_password']) ? $errors['current_password'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label> <b class="text-danger">*</b>
                                                <input type="password" name="new_password" class="form-control<?= (isset($errors['new_password']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['new_password']) ? $errors['new_password'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label> <b class="text-danger">*</b>
                                                <input type="password" name="confirm_password" class="form-control<?= (isset($errors['confirm_password']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?></small>
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