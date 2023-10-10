<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Kedai Afan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=user()->username?></a>
        </div>
      </div>        

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- guest -->
                <?php if (in_groups(['guest']) ) : ?>
          <li class="nav-item">
            <a href="welcome" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Welcome
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                logout
                
              </p>
            </a>
          </li>
          <?php endif ?>
          <!-- end guest -->

          <!-- manager -->
                <?php if (in_groups(['manager']) ) : ?>
                  <li class="nav-item">
                    <a href="welcome" class="nav-link">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Welcome
                        
                      </p>
                    </a>
                  </li>
          <li class="nav-item">
            <a href="menu" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Menu
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="kasir" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Kasir
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="laporan" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Laporan
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                logout
                
              </p>
            </a>
          </li>
          <?php endif ?>
          <!-- end manager -->

          <!-- kasir -->

          <?php if (in_groups(['kasir']) ) : ?>
                  <li class="nav-item">
                    <a href="welcome" class="nav-link">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Welcome
                        
                      </p>
                    </a>
                  </li>
          <li class="nav-item">
            <a href="kasir" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Kasir
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                logout
                
              </p>
            </a>
          </li>
          <?php endif ?>
            <!-- end kasir -->
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>