<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('departments') ?>">Departments</a></li>
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
                                        <h4 class="card-title">Add New Department Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $input = session()->getFlashdata('input');
                                        $errors = session()->getFlashdata('errors');
                                        ?>
                                        <form action="<?= base_url('data/add-department') ?>" method="post" autocomplete="off">
                                            <div class="form-group">
                                                <label>Department Name</label> <b class="text-danger">*</b>
                                                <input type="text" name="name" value="<?= isset($input['name']) ? $input['name'] : '' ?>" class="form-control<?= (isset($errors['name']) ? ' is-invalid' : '') ?>">
                                                <small class="text-danger"><?= isset($errors['name']) ? $errors['name'] : '' ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label> <b class="text-danger">*</b>
                                                <textarea name="description" class="form-control<?= (isset($errors['description']) ? ' is-invalid' : '') ?>"><?= isset($input['description']) ? $input['description'] : '' ?></textarea>
                                                <small class="text-danger"><?= isset($errors['description']) ? $errors['description'] : '' ?></small>
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