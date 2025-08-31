<?php
$serverurl = SERVERURL . "views/assets/images/bg-pattern-light.svg";
?>
<style>
    .authentication-bg {
        background-image: url(<?php echo $serverurl; ?>);
        background-size: cover;
        background-position: center
    }

    .authentication-bg .account-pages {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        min-height: 100vh
    }
</style>

<div class="authentication-bg">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="index.html">
                                <span><img src=" <?php echo SERVERURL; ?>views/assets/images/logo.png" alt="" height="18"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Inicio de Session</h4>
                                <p class="text-muted mb-4">Introduzca su dirección de correo electrónico y contraseña para acceder al panel de administración.</p>
                            </div>

                            <form action="" method="POST" autocomplete="off">

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Usuario</label>
                                    <input class="form-control" type="text" id="emailaddress" placeholder="Ingresa tu usuario" name="usuario_log" pattern="[a-zA-Z0-9]{1,35}" maxlength="35" required="">
                                </div>

                                <div class="mb-3">
                                    <!-- <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your password?</small></a> -->
                                    <label for="password" class="form-label">contraseña</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" placeholder="Ingresa tu contraseña" name="clave_log" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="mb-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div> -->

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"> Iniciar</button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <!-- <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </div> 
                    </div> -->
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
</div>
<?php
if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
    require_once "./controller/loginControlador.php";
    $insLogin = new loginControlador();
    $insLogin->iniciar_sesion_controlador();
}
?>