<article class="module width_full">
    <header><h3 class="tabs_involved">Lista de Portones</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('distri/porton_new') ?>">Crear Nuevo</a></li>
        </ul>
    </header>

    <?php if ($lista->getNumRows() > 0) { ?>
        <div class="tab_container">
            <div id="tab1" class="tab_content">

                <table class="tablesorter" cellspacing="0"> 
                    <thead> 
                        <tr> 
                            <th>Franquicia</th>  
                            <th>Cliente</th> 
                            <th>Edificio</th>
                            <th>GSM&nbsp;Key</th> 
                            <th>Referencia</th>                            
                            <th>&nbsp;</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php while ($row = $lista->getRowFields()) { ?>
                            <tr> 
                                <td><?php echo $row->franq ?></td> 
                                <td><?php echo $row->cliente ?></td> 
                                <td><?php echo $row->edificio ?></td> 
                                <td><?php echo $row->gsmkey ?></td> 
                                <td><?php echo $row->ubicacion_ref ?></td>    
                                <td><input type="image" src="<?= Front::myUrl('images/template/icn_edit.png') ?>" title="Editar" onclick="location.replace('<?= Front::myUrl("distri/porton_edit/$row->id") ?>')">
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