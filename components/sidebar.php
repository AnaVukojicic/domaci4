<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./index.php" class="brand-link">
      <span class="brand-text font-weight-light mx-3">Car rental agency</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?=$appURL?>index.php" class="nav-link <?= $currentPage=="reservations" ? "active" : ""?>">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Reservations
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=$appURL?>clients.php" class="nav-link <?= $currentPage=="clients" ? "active" : ""?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Clients
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=$appURL?>vehicles.php" class="nav-link <?= $currentPage=="vehicles" ? "active" : ""?>">
              <i class="nav-icon fas fa-car-side"></i>
              <p>
                Vehicles
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=$appURL?>manufacturers_models.php" class="nav-link <?= $currentPage=="manufacturers_models" ? "active" : ""?>">
              <i class="nav-icon fas fa-car"></i>
              <p>
                Manufacturers and models
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=$appURL?>vehicle_classes.php" class="nav-link <?= $currentPage=="classes" ? "active" : ""?>">
              <i class="nav-icon fas fa-car"></i>
              <p>
                Vehicle classes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=$appURL?>countries.php" class="nav-link <?= $currentPage=="countries" ? "active" : ""?>">
              <i class="nav-icon fas fa-flag"></i>
              <p>
                Countries
              </p>
            </a>
          </li>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>