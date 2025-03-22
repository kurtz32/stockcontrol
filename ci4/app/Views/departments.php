<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><?= $title ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
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

        <div class="mb-4">
            <a href="<?= base_url('add-department') ?>" class="btn btn-primary">Add Department</a>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($departments as $department) : ?>
                                        <tr>
                                            <td><?= $department['name'] ?></td>
                                            <td><?= $department['description'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('department/' . str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypter->encrypt($department['id'])))) ?>">View</a>
                                                    <a class="dropdown-item" href="<?= base_url('edit-department/' . str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypter->encrypt($department['id'])))) ?>">Edit</a>
                                                    <form action="<?= base_url('data/delete-department') ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this department?');">
                                                        <input type="hidden" name="id" value="<?= str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypter->encrypt($department['id']))) ?>">
                                                        <button class="dropdown-item">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
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