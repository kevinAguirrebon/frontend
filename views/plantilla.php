<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Expires" content="0"> 
    <meta http-equiv="Last-Modified" content="0">     
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">     
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo COMPANY ?></title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <?php require_once './views/modulos/estilos-view.php'; ?>
</head>
<div class="loader"></div>

<?php


            $peticionAJAX = false;
            require_once './controllers/vistasControlador.php';
            $vt = new vistasControlador();
            $vistasR = $vt->obtener_vistas_controlador();
            if ($vistasR == 'login' || $vistasR == '404' || $vistasR == 'forgotPassword'){
                if ($vistasR == 'login'){
                    $vistasR = './views/contenidos/home-view.php';
                    require_once $vistasR;
                }else if($vistasR == '404'){
                    $vistasR = './views/contenidos/404-view.php';
                    require_once $vistasR;
                }else if($vistasR == 'forgotPassword'){
                    $vistasR = './views/contenidos/forgotPassword-view.php';
                    require_once $vistasR;
                }
            }else{
?>
    <body class="hold-transition sidebar-mini layout-fixed text-sm layout-navbar-fixed">
            <div class="wrapper">
                <?php require_once './views/modulos/navBar-view.php'; ?>

                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <?php require_once './views/modulos/sideBar-view.php'; ?> 
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper pt-3 px-2">
                <!-- Main content -->
                    <?php
                        //require_once './controladores/loginControlador.php';
                        //$login = new loginControlador();
                        require_once $vistasR;
                    ?>
                <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->
                <!-- Main Footer -->
                <?php //require_once './views/modulos/footer-view.php'; ?>
            </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php require_once './views/modulos/scripts-view.php'; ?>
    </body>
<?php
        }

?>
</html>
