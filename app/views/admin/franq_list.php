<article class="module width_3_quarter">
    <header><h3 class="tabs_involved">Lista de franquicias</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('admin/franquicia_new') ?>">Crear Nueva</a></li>
        </ul>
    </header>

    <?php if ($lista->getNumRows() > 0) { ?>
        <div class="tab_container">
            <div id="tab1" class="tab_content">
            <?php $fecha = new Calendar("d/m/Y") ?>
                <table class="tablesorter" cellspacing="0"> 
                    <thead> 
                        <tr> 
                            <th>Nombre</th>                     
                            <th>esponsable</th> 
                            <th>Fecha</th> 
                            <th>&nbsp;</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php while ($row = $lista->getRowFields()) { ?>
                            <tr> 
                                <td><?php echo $row->nombre ?></td> 
                                <td><?php echo $row->responsable ?></td> 
                                <td><?php echo $fecha->datetime($row->fecha) ?></td> 
                                <td><input type="image" src="<?= Front::myUrl('images/template/icn_edit.png') ?>" title="Editar" onclick="location.replace('<?= Front::myUrl("admin/franquicia_edit/$row->id") ?>')">
<!--                                    <input type="image" src="<?= Front::myUrl('images/template/icn_trash.png') ?>" title="Borrar">-->
                                </td> 
                            </tr> 
                        <?php } ?>
                    </tbody> 
                </table>


            </div><!-- end of #tab1 -->




        </div><!-- end of .tab_container -->


    <?php } ?>
</article>