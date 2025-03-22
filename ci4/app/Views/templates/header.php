<?php
$uri = service('uri');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title><?= $title ?> - NORSU Mabinay Campus Supply and Equipment Inventory System</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/feathericon.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
</head>

<body>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left">
                <a href="<?= base_url('dashboard') ?>" class="logo">
                    <img src="<?= base_url() ?>assets/img/logo.png" alt="Logo">
                </a>
                <a href="<?= base_url('dashboard') ?>" class="logo logo-small">
                    <img src="<?= base_url() ?>assets/img/logo.png" alt="Logo" width="30" height="30">
                </a>
            </div>

            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fe fe-text-align-left"></i>
            </a>

            <a class="mobile_btn" id="mobile_btn">
                <i class="fa fa-bars"></i>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="<?= base_url() ?>assets/img/favicon.png" width="31" alt="<?= session()->get('name') ?>"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="<?= base_url() ?>assets/img/favicon.png" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6><?= session()->get('name') ?></h6>
                                <p class="text-muted mb-0"><?= session()->get('username') == 'ruel' ? 'Administrator' : 'Staff' ?></p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="<?= base_url() ?>auth/logout">Logout</a>
                    </div>
                </li>

            </ul>

        </div>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <?php if (session()->get('username') == 'ruel') : ?>
                            <li class="menu-title">
                                <span><i class="fe fe-home"></i> Main</span>
                            </li>
                            <li <?= $uri->getSegment(1) == 'dashboard' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('dashboard') ?>"><span>Dashboard</span></a>
                            </li>
                            <li <?= $uri->getSegment(2) == 'equipments' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('items/equipments') ?>"><span>Equipments</span></a>
                            </li>
                            <li <?= $uri->getSegment(2) == 'supplies' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('items/supplies') ?>"><span>Supplies</span></a>
                            </li>
                            <!-- <li class="submenu">
                                <a href="#"><span> Tracker</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="invoices.html">Equipment</a></li>
                                    <li><a href="invoice-grid.html">Semi-expendable</a></li>
                                </ul>
                            </li> -->
                            <li <?= $uri->getSegment(1) == 'departments' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('departments') ?>"><span>Departments</span></a>
                            </li>
                            <li <?= $uri->getSegment(1) == 'employees' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('employees') ?>"><span>Employees</span></a>
                            </li>
                            <li <?= $uri->getSegment(1) == 'locations' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('locations') ?>"><span>Room/ Locations</span></a>
                            </li>
                            <li <?= $uri->getSegment(1) == 'units' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('units') ?>"><span>Units</span></a>
                            </li>
                            <li <?= $uri->getSegment(1) == 'requests' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('requests') ?>"><span>Requests</span></a>
                            </li>
                        <?php else : ?>
                            <li class="menu-title">
                                <span><i class="fe fe-home"></i> Main</span>
                            </li>
                            <li <?= $uri->getSegment(1) == 'department' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('department/' . str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypter->encrypt(session()->get('department_id'))))) ?>"><span>Department</span></a>
                            </li>
                            <li class="submenu">
                                <a href="#"><span> Requests</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="<?= base_url('request-supplies/equipments') ?>">Equipments</a></li>
                                    <li><a href="<?= base_url('request-supplies/supplies') ?>">Supplies</a></li>
                                </ul>
                            </li>
                            <li <?= $uri->getSegment(1) == 'profile' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('profile') ?>"><span>Profile</span></a>
                            </li>
                            <li <?= $uri->getSegment(1) == 'auth/logout' ? 'class="active"' : '' ?>>
                                <a href="<?= base_url('auth/logout') ?>"><span>Logout</span></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>