<!doctype html>
<html lang="es">

    <head>
        <?php include_meta(); ?>
        <style type="text/css">
            @import "<?= Front::myUrl('css/layout.css') ?>";
        </style>
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php include_javascripts(); ?>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $(".tablesorter").tablesorter();
                
            }
            );
            $(document).ready(function() {

                //When page loads...
                $(".tab_content").hide(); //Hide all content
                $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                $(".tab_content:first").show(); //Show first tab content

                //On Click Event
                $("ul.tabs li").click(function() {

                    $("ul.tabs li").removeClass("active"); //Remove any "active" class
                    $(this).addClass("active"); //Add "active" class to selected tab
                    $(".tab_content").hide(); //Hide all tab content

                    var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                    $(activeTab).fadeIn(); //Fade in the active ID content
                    return false;
                });

            });
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

            <h1 class="site_title"><img style="margin-top:10px;" src="<?= Front::myUrl('images/logoadmin.gif') ?>" width="169" height="63"></h1>
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
                 <li class="icn_profile"><a href="#">Datos</a></li>
                <li class="icn_edit_article"><a href="#">Edit Articles</a></li>
                <li class="icn_categories"><a href="#">Categories</a></li>
                <li class="icn_tags"><a href="#">Tags</a></li>
            </ul>

            <?php if (Security::isProfileName("admin")) { ?>
                <h3>Administración</h3>
                <ul class="toggle">
                   
                    <li class="icn_view_users"><a href="#">Distribuidores</a></li>
                    <li class="icn_settings"><a href="#">Opciones</a></li>
                    <li class="icn_categories"><a href="#">Comandos SMS</a></li>
                    <li class="icn_security"><a href="#">Seguridad</a></li>
                    <li class="icn_jump_back"><a href="<?= Front::myUrl('main/logout') ?>">Salir</a></li>
                </ul>
            <?php } ?>


            <footer>
                <hr />
                <p><strong>Copyright &copy; 2013 MiPorton.net</strong></p>
            </footer>
        </aside><!-- end of sidebar -->

        <section id="main" class="column"><!-- end of stats article --><!-- end of content manager article --><!-- end of messages article -->

            <?php echo (isset($body) && is_array($body)) ? implode("\n", $body) : '' ?>

            <p>&nbsp;</p>

        </section>


    </body>

</html>
