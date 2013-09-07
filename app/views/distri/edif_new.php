<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                r0nombre: {
                    required: true
                },
                r0franquicia_id: {
                    required: true
                },
                r0cliente_id: {
                    required: true
                },
                r0direccion: {
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
                $("#r0cliente_id").html('');
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
                            $("#r0cliente_id").html(html);
                        }
                    });

        });




        $("#submit").click(function() {

            //validando
            if (!$("#form1").valid())
                return false;

            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('distri/edificio'); ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);

                    $(location).attr('href', '<?= Front::myUrl('distri/edificio'); ?>');

                }
            });

            return false;
        });

    });
</script>


<article class="module width_3_quarter">

    <header><h3 class="tabs_involved">Crear Edificio</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('distri/edificio') ?>">Regresar</a></li>
        </ul>
    </header>


    <form name="form1" id="form1">
        <div class="module_content">


            <fieldset style="display: <?= $visual ?>">
                <label for="r0franquicia_id">Franquicia:</label>
                <?= $franquicia ?>
                <input id="operacion" name="operacion" type="hidden" value="new">
            </fieldset>


            <fieldset>
                <label for="r0cliente_id">Pertenece al Cliente:</label><br>
                 <select name="r0cliente_id" id="r0cliente_id"></select>
            </fieldset>

            <fieldset>
                <label for="r0nombre">Nombre:</label>
                <input id="r0nombre" name="r0nombre">
            </fieldset>


            <fieldset>
                <label for="r0zona_id">Zona:</label>
                <?= $zona ?>
            </fieldset>

            <fieldset>
                <label for="r0direccion">Dirección:</label>
                <input id="r0direccion" name="r0direccion">
                <input id="operacion" name="operacion" type="hidden" value="new">
            </fieldset>

            <fieldset>
                <label for="r0establecimiento">Establecimiento:</label>
                <?= $est ?>
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