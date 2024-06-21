<?php
// require('../config/session.php');
?>
<!DOCTYPE html>
<html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template-free">

<head>
    <?php include('includes/head.php'); ?>
    <link rel="stylesheet" href="assets/vendor/css/rtl/core-dark.css">
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                <div class="app-brand">
                    <a href="../../pages/profile.php" class="py-2">
                        <span class="logo logo-shadow">Harmonix</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item">
                        <a href="studioSeparate.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Separate Vocals</div>
                        </a>
                    </li>
                    <!-- Studio -->
                    <li class="menu-item active">
                        <a href="studioMain.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Studio</div>
                        </a>
                    </li>
                    <!-- Library -->
                    <li class="menu-item">
                        <a href="studioLibrary.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Library</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- Menu End -->

            <!-- Layout page Start -->

            <div class="layout-page" style="height: 150vh">
                <!-- nav bar start -->
                <?php include('includes/navbar.php') ?>
                <!-- nav bar end -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div>
                            Studio
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</body>
<?php include('includes/script.php') ?>

</html>