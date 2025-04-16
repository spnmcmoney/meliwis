<?php
    require_once('../config/helper.php');

    if($_SESSION['role'] !== 'admin') {
        header("location: " . BASE_URL . 'dashboard.php?page=user');
        exit();
    }
?>

        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false">

              <li class="nav-item menu-open">
                <a href="<?= BASE_URL . 'pages/dashboard.php?page=admin'?>" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="<?= BASE_URL . 'pages/hotel.php?page=admin'?>" class="nav-link active">
                  <i class="nav-icon bi bi-house"></i>
                  <p>Hotel Manajemen</p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="<?= BASE_URL . 'pages/kasir.php?page=admin'?>" class="nav-link active">
                  <i class="nav-icon bi bi-cart3"></i>
                  <p>Kasir</p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="<?= BASE_URL . 'pages/gudang.php?page=admin'?>" class="nav-link active">
                  <i class="nav-icon bi bi-box"></i>
                  <p>Gudang</p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="<?= BASE_URL . 'pages/ladies.php?page=admin'?>" class="nav-link active">
                  <i class="nav-icon bi bi-person-standing-dress"></i>
                  <p>LC Ladies</p>
                </a>
              </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>


<!-- END CONTENT -->