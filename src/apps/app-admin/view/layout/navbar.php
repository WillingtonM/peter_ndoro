<?php $session_user = get_user_by_id($_SESSION['user_id']) ?>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl navbar-fixed position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky/" navbar-scroll="true" style="z-index: 10;">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>

                <li class="breadcrumb-item text-sm"> &emsp;
                    <a href="./" class="navbar-brand">
                        <!-- <img src="<?= PROJECT_LOGO ?>" width="30" height="30" class="d-inline-block/ align-top" alt=""> -->
                        <span id="trln_text" class="" style="font-size: 1.2rem;"> <?= PROJECT_TITLE ?> <small style="font-size: .5em;"> <i style="color: #cc0055 !important;">Admin</i> </small> </span>
                    </a>
                </li>
                <!-- <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li> -->
            </ol>

        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 float-end" id="navbar/">

            <ul class="navbar-nav justify-content-end float-end">

                <!-- <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0 msg_notif" id="navdrop_notif" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell cursor-pointer"></i>
                    </a>
                </li> -->
                <!-- <li class="nav-item d-flex align-items-center dropdown">
                    <a class="nav-link text-body px-0" href="#" role="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= img_path(ABS_USER_PROFILE, $user_side['user_image'], 1) ?>" class="avatar d-flex" style="width: 25px; height: 25px !important; border-radius: 50%; border: 2px solid #ddd; padding: 0.001em; border-radius: 50%;">
                    </a>
                </li> -->

            </ul>
        </div>
    </div>
</nav>