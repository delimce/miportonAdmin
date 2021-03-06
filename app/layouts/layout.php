<!doctype html>
<html lang="es">
    <head>
        <?php include_meta(); ?>
        <style type="text/css">
            @import "<?= Front::myUrl('css/ie.css') ?>";
            @import "<?= Front::myUrl('css/layout.css') ?>";
        </style>
        <?php include_javascripts(); ?>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $(".tablesorter").tablesorter();

            }
            );

        </script>
        <script type="text/javascript">
            $(function() {
                $('.column').equalHeight();
            });
        </script>
        <?php echo (isset($head) && is_array($head)) ? implode("\n", $head) : '' ?>
        <title><?php echo $siteTitle ?></title>
    </head>

    <body>
        <header id="header">

            <h1 class="site_title"><img style="margin-top:10px;" onclick="location.replace('<?= Front::myUrl("main/index") ?>')" src="<?= Front::myUrl('images/logoadmin.gif') ?>" width="169" height="63"></h1>
            <div class="opcion_user">
                <p class="user_name"><?= Security::getUserName() ?></p>
                <p class="logout_user"><a href="<?= Front::myUrl('main/logout') ?>">Cerrar Sesión</a></p>
            </div>

        </header> <!-- end of header bar -->

        <section id="secondary_bar">


        </section><!-- end of secondary bar -->

        <aside id="sidebar" class="column">
            <h3>Mi Cuenta</h3>
            <ul class="toggle">
                <li class="icn_profile"><a href="<?= Front::myUrl('cuenta/datos'); ?>">Datos</a></li>
                <li class="icn_jump_back"><a href="<?= Front::myUrl('main/logout') ?>">Salir</a></li>
            </ul>


            <?php if (Security::isProfileName("admin") or Security::isProfileName("distri") or Security::isProfileName("edificio")  ) { ?>
                <h3>Admin. edificios</h3>
                <ul class="toggle">
                    <li class="icn_cell"><a href="<?= Front::myUrl('edificio/usuarios'); ?>">Usuarios</a></li>

                </ul>

            <?php } ?>  



            <?php if (Security::isProfileName("admin") or Security::isProfileName("distri")) { ?>
                <h3>Distribución</h3>
                <ul class="toggle">
                    <li class="icn_view_users"><a href="<?= Front::myUrl('distri/cliente'); ?>">Clientes</a></li>
                    <li class="icn_edif"><a href="<?= Front::myUrl('distri/edificio'); ?>">Edificios</a></li>
                    <li class="icn_new_article"><a href="<?= Front::myUrl('distri/porton'); ?>">Portones</a></li>
                    <li class="icn_secure"><a href="<?= Front::myUrl('distri/admin'); ?>">Admin edific.</a></li>
                </ul>

            <?php } ?>

            <?php if (Security::isProfileName("admin")) { ?>
                <h3>Administración</h3>
                <ul class="toggle">
                    <li class="icn_franquicia"><a href="<?= Front::myUrl('admin/franquicia'); ?>">Franquicias</a></li>
                    <li class="icn_view_users"><a href="<?= Front::myUrl('admin/distribuidor'); ?>">Distribuidores</a></li>
                    <li class="icn_categories"><a href="<?= Front::myUrl('admin/sms'); ?>">Comandos SMS</a></li>
                    <li class="icn_tags"><a href="<?= Front::myUrl('admin/vars'); ?>">Variables SMS</a></li>
                    <li class="icn_gsmkey"><a href="<?= Front::myUrl('admin/gsmkey'); ?>">GSM-Key</a></li>
                    <li class="icn_zona"><a href="<?= Front::myUrl('admin/zonas'); ?>">Zonas</a></li>

                </ul>
            <?php } ?>

                             
                <footer>
                <hr />
                <p><strong>Copyright &copy; <?= date("Y") ?> MiPorton.net</strong></p>
            </footer>
        </aside><!-- end of sidebar -->

        <section id="main" class="column">

            <?php echo (isset($body) && is_array($body)) ? implode("\n", $body) : '' ?>

            
            <p style="float: left; position: relative; width: 90%; height: 15px; ">
                &nbsp;
              </p>
            
            
        </section>
       

    </body>
    

    
    

</html>
