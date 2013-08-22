<article class="module width_full">
    <header><h3 class="tabs_involved">Lista de Edificios</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('distri/edificio_new') ?>">Crear Nuevo</a></li>
        </ul>
    </header>

    <?php if ($lista->getNumRows() > 0) { ?>
        <div class="tab_container">
            <div id="tab1" class="tab_content">
            
                <table class="tablesorter" cellspacing="0"> 
                    <thead> 
                        <tr> 
                            <th>Franquicia</th>                     
                            <th>Edificio</th> 
                            <th>Tipo</th>
                            <th>Zona</th>
                            <th>Cliente</th> 
                            <th>&nbsp;</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php while ($row = $lista->getRowFields()) { ?>
                            <tr> 
                                <td><?php echo $row->franquicia ?></td> 
                                <td><?php echo $row->edif ?></td> 
                                <td><?php echo $row->est ?></td> 
                                <td><?php echo $row->zona ?></td> 
                                <td><?php echo $row->cliente ?></td> 
                                <td><input type="image" src="<?= Front::myUrl('images/template/icn_edit.png') ?>" title="Editar" onclick="location.replace('<?= Front::myUrl("distri/edificio_edit/$row->id") ?>')">
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