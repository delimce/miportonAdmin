<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                gsmkey: {
                    required: true
                }
            },
            errorElement: "div"
        });

        /**
         * *********************************
         */


        $("#submit").click(function() {

            //validando
            if (!$("#form1").valid())
                return false;

            if (!$('#gsmkey').length) { ///validando que exista
                return false;
            }

            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('distri/porton'); ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);
                    $("#mensaje").html(data);
                }
            });

            return false;
        });

    });
</script>


<article class="module width_full">

    <header><h3 class="tabs_involved">Crear Porton</h3>
        <ul class="tabs">
            <li><a href="javascript:history.back();">Regresar</a></li>
        </ul>
    </header>


    <form name="form1" id="form1">
        <div class="module_content">


            <fieldset>
                <label>Asignar GSM-KEY AL PORTON <?= !empty($referencia) ? '(' . $referencia . ')' : ''; ?></label>
            </fieldset>

            <?php if ($datos->getNumRows() > 0) { ?>
                <fieldset>

                    <div style="text-align: center; font-weight: bold; margin-bottom: 12px;">
                        <div style=" width: 4%; float: left; display: block; ">&nbsp;</div>&nbsp; 
                        <div style="float: left; width: 20%; display: block; ">Modelo</div>&nbsp;  
                        <div style=" float: left; width: 20%; display: block;">Imei</div>&nbsp; 
                        <div style="width: 20%; display: block; float: left">Telefono</div> &nbsp; 
                        <div style="width: 20%; display: block; float: left">Capacidad</div> 

                    </div>

                    <?php while ($row = $datos->getRowFields()) { ?>

                        <div style="text-align: center; margin-bottom: 12px;">
                            <div style=" width: 4%; float: left; display: block; "><input type="radio" name="gsmkey" id="gsmkey" value="<?= $row->id ?>" /></div>&nbsp; 
                            <div style="float: left; width: 20%; display: block; "><?= empty($row->modelo) ? "-" : $row->modelo ?></div>&nbsp;  
                            <div style=" float: left; width: 20%; display: block;"><?= $row->imei ?></div>&nbsp; 
                            <div style="width: 20%; display: block; float: left"><?= $row->tlf ?></div> &nbsp; 
                            <div style="width: 20%; display: block; float: left"><?= $row->capacidad ?></div> 

                        </div>

                    <?php } ?>
                </fieldset>
                <?php
            } else {
                print "No existen dispositivos GSM-KEY disponibles, comuniquese con el proveedor del sistema";
            }
            ?>
            <input id="id" name="id" type="hidden" value="<?= $ide ?>">
            <input id="operacion" name="operacion" type="hidden" value="asig">
            <div id="mensaje">&nbsp;</div>

            <br>

        </div>
        <footer>
            <div class="submit_link">
                <input id="submit" type="submit" value="Guardar" class="alt_btn">
            </div>
        </footer>

    </form>    
</article>