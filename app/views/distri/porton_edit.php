<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                r0franquicia_id: {
                    required: true
                },
                cliente: {
                    required: true
                },
                r0edificio_id: {
                    required: true
                },
                r0ubicacion_ref: {
                    required: true
                }
            },
            errorElement: "div"
        });


        ///creando el select dinamicamente
        $("#r0franquicia_id").change(function()
        {
            var id = $(this).val();
            var dataString = 'id=' + id;
            if (id == "") {
                $("#cliente").html('');
                return false;
            }

            $.ajax
                    ({
                        type: "POST",
                        url: "<?= Front::myUrl('distri/selectCliente'); ?>",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $("#cliente").html(html);
                        }
                    });

        });



        ///creando el select dinamicamente
        $("#cliente").change(function()
        {
            var id = $(this).val();
            var dataString = 'id=' + id;
            if (id == "") {
                $("#r0edificio_id").html('');
                return false;
            }

            $.ajax
                    ({
                        type: "POST",
                        url: "<?= Front::myUrl('distri/selectEdificio'); ?>",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $("#r0edificio_id").html(html);
                        }
                    });

        });



        /**
         * *********************************
         */


        $("#submit").click(function() {

            //validando
            if (!$("#form1").valid())
                return false;

            var formData = $("#form1").serialize();

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


<article class="module width_3_quarter">

    <header><h3 class="tabs_involved">Editar Porton</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('distri/porton') ?>">Regresar</a></li>
        </ul>
    </header>


    <form name="form1" id="form1">
        <div class="module_content">


            <fieldset style="display: <?= $visual ?>">
                <label for="r0franquicia_id">Franquicia:</label>
                <?= $franquicia ?>
            </fieldset>

            <fieldset>
                <label for="cliente">Pertenece al Cliente:</label><br>
                <?= $cliente ?>
            </fieldset>

            <fieldset>
                <label for="r0edificio_id">Edificio:</label>
                <?= $edificio ?>
            </fieldset>
            
              <fieldset>
                <label for="r0ubicacion_ref">Referencia:</label>
                <input id="r0ubicacion_ref" name="r0ubicacion_ref" value="<?=$datos->getField("ubicacion_ref") ?>">
               <input id="operacion" name="operacion" type="hidden" value="edit">
                <input id="id" name="id" type="hidden" value="<?= $datos->getField("id") ?>">
            </fieldset>



           
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