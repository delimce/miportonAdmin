<!doctype html>
<html lang="es">
    <head>
        <?php include_meta(); ?>
        <style type="text/css">
            @import "<?= Front::myUrl('css/ie.css') ?>";
            @import "<?= Front::myUrl('css/layout.css') ?>";
        </style>
        <?php include_javascripts(); ?>
        <title><?php echo $siteTitle ?></title>
    </head>
<center>
    <body>
        <!-- end of header bar --><!-- end of secondary bar --><!-- end of sidebar -->
        <?php echo (isset($body) && is_array($body)) ? implode("\n", $body) : '' ?>
        <p>&nbsp;</p>
        
    </body>

</center>
</html>