<article class="module width_full">
    <header><h3 class="tabs_involved">Lista de GSM-KEY</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('admin/gsmkey_new') ?>">Crear Nuevo</a></li>
        </ul>
    </header>

    <?php if ($lista->getNumRows() > 0) { ?>
        <div class="tab_container">
            <div id="tab1" class="tab_content">
                <table class="tablesorter" cellspacing="0"> 
                    <thead> 
                        <tr> 
                            <th>Imei</th>                     
                            <th>Tlf</th> 
                            <th>Capacidad</th> 
                            <th>Creado por</th>
                            <th>Usado?</th>
                            <th>Defecto?</th>
                            <th>&nbsp;</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php while ($row = $lista->getRowFields()) { ?>
                            <tr> 
                                <td><?php echo $row->imei ?></td> 
                                <td><?php echo $row->tlf ?></td> 
                                <td><?php echo $row->capacidad ?></td> 
                                <td><?php echo $row->nombre ?></td> 
                                <td><?php echo $row->usado ?></td> 
                                <td><?php echo $row->defecto ?></td> 
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