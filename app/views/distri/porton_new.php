<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                r0franquicia_id: {
                    required: true
                },
                r0cliente_id: {
                    required: true
                },
                r0edificio_id: {
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
                $("#cliente").html("seleccione la franquicia");
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
        $("#r0cliente_id").change(function()
        {
            var id = $(this).val();
            var dataString = 'id=' + id;
            if (id == "") {
                $("#edificio").html("seleccione el cliente");
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
                            $("#edificio").html(html);
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
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('distri/porton'); ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);

                    $(location).attr('href', '<?= Front::myUrl('distri/porton'); ?>');

                }
            });

            return false;
        });

    });
</script>


<article class="module width_3_quarter">

    <header><h3 class="tabs_involved">Crear Porton</h3>
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
                <label for="r0cliente_id">Pertenece al Cliente:</label><br>
                <span id="cliente"><?= $cliente ?></span>
            </fieldset>

            <fieldset>
                <label for="r0edificio_id">Edificio:</label>
                <span id="edificio">Seleccione un cliente</span>
            </fieldset>
            
             <fieldset>
                <label for="r0ubicacion_ref">Referencia:</label>
                <input id="r0ubicacion_ref" name="r0ubicacion_ref">
                <input id="operacion" name="operacion" type="hidden" value="new">
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