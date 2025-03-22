<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('employees') ?>">Employees</a></li>
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
                                        <h4 class="card-title">Edit Employee Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $input = session()->getFlashdata('input');
                                        $errors = session()->getFlashdata('errors');
                                        ?>
                                        <form action="<?= base_url('data/edit-employee') ?>" method="post" autocomplete="off">
                                            <div class="form-group">
                                                <label>Employee Name</label> <b class="text-danger">*</b>
                                                <input type="text" name="name" value="<?= isset($input['name']) ? $input['name'] : $employee['name'] ?>" class="form-control<?= (isset($errors['name']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['name']) ? $errors['name'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Designation</label> <b class="text-danger">*</b>
                                                <input type="text" name="designation" value="<?= isset($input['designation']) ? $input['designation'] : $employee['designation'] ?>" class="form-control<?= (isset($errors['designation']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['designation']) ? $errors['designation'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Department</label> <b class="text-danger">*</b>
                                                <select name="department" class="form-control<?= (isset($errors['department']) ? ' is-invalid' : '') ?>">
                                                    <option hidden></option>
                                                    <?php foreach ($departments as $department) : ?>
                                                        <option value="<?= $department['id'] ?>" <?= $employee['department_id'] == $department['id'] ? 'selected' : '' ?>><?= $department['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="text-danger"><?= isset($errors['department']) ? $errors['department'] : '' ?></small>
                                            </div>
                                            <div class="text-end">
                                                <input type="hidden" name="id" value="<?= $id ?>">
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
                                        <?php
                                        $input = session()->getFlashdata('input');
                                        $errors = session()->getFlashdata('errors');
                                        ?>
                                        <form action="<?= base_url('data/edit-employee-password') ?>" method="post" autocomplete="off">
                                            <div class="form-group">
                                                <label>New Password</label> <b class="text-danger">*</b>
                                                <input type="password" name="password" class="form-control<?= (isset($errors['password']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['password']) ? $errors['password'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label> <b class="text-danger">*</b>
                                                <input type="password" name="confirm_password" class="form-control<?= (isset($errors['confirm_password']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?></small>
                                            </div>
                                            <div class="text-end">
                                                <input type="hidden" name="id" value="<?= $id ?>">
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