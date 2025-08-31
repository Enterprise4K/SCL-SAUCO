<div class="leftside-menu">

    <!-- LOGO -->
    <a href="<?php echo SERVERURL; ?>home/" class="logo text-center logo-light">
        <span class="logo-lg">
            <!-- cambiar logo por el del sistema original -->
            <h3>SCL - SAUCO</h3>
            <!-- <img src="<?php echo SERVERURL; ?>views/assets/images/logo.png" alt="" height="16"> -->
        </span>
        <span class="logo-sm">
            <!-- cambiar logo por el del sistema original -->
            <h3>SCL - SAUCO</h3>
            <!-- <img src="<?php echo SERVERURL; ?>views/assets/images/logo_sm.png" alt="" height="16"> -->
        </span>
    </a>

    <!-- LOGO -->
    <a href="<?php echo SERVERURL; ?>home/" class="logo text-center logo-dark">
        <span class="logo-lg">
            <!-- cambiar logo por el del sistema original -->
            <h3>SCL - SAUCO</h3>
            <!-- <img src="<?php echo SERVERURL; ?>views/assets/images/logo-dark.png" alt="" height="16"> -->
        </span>
        <span class="logo-sm">
            <!-- cambiar logo por el del sistema original -->
            <!-- <img src="<?php echo SERVERURL; ?>views/assets/images/logo_sm_dark.png" alt="" height="16"> -->
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Principal</li>

            <li class="side-nav-item">
                <a href="<?php echo SERVERURL; ?>home/" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span>Inicio</span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Gestión</li>
            <!-- Ordenes de compra - modulo -->
            <li class="side-nav-item">
                <a href="<?php echo SERVERURL; ?>oc-year/" class="side-nav-link">
                    <i class="uil-file-contract-dollar"></i>
                    <span> Ordenes de Compra </span>
                </a>
            </li>
            <!-- Ordenes de Servicio - Modulo -->
            <li class="side-nav-item">
                <a href="<?php echo SERVERURL; ?>os-year/" class="side-nav-link">
                    <i class="uil-briefcase-alt"></i>
                    <span> Ordenes de Servicio </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="<?php echo SERVERURL; ?>proveedor/" class="side-nav-link">
                    <i class="uil-constructor"></i>
                    <span> Proveedores</span>
                </a>
            </li>
            <?php
            // Verificar si el usuario tiene permisos para ver el modulo de Proveedores
            if ($_SESSION['privilegio_scl'] == 1) {
            ?>
                <li class="side-nav-title side-nav-item">sistema</li>
                <li class="side-nav-item">
                    <a href="<?php echo SERVERURL; ?>usuarios/" class="side-nav-link">
                        <i class="uil-users-alt"></i>
                        <span> Usuarios </span>
                    </a>
                </li>
            <?php }; ?>
        </ul>
        <!-- End Sidebar -->

    </div>
    <!-- Sidebar -left -->

</div>