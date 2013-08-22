<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                r0nombre: {
                    required: true
                },
                r0rif: {
                    required: true
                },
                r0contacto: {
                    required: true
                },
                r0email: {
                    email: true
                },
                r0tlf: {
                    digits: true
                },
                r0direccion: {
                    required: true
                },
                r0ciudad: {
                    required: true
                }
            },
            errorElement: "div"
        });


        $("#submit").click(function() {

            //validando
            if (!$("#form1").valid())
                return false;

            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('distri/cliente'); ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);

                    $(location).attr('href', '<?= Front::myUrl('distri/cliente'); ?>');

                }
            });

            return false;
        });

    });
</script>


<article class="module width_3_quarter">

    <header><h3 class="tabs_involved">Crear Cliente</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('distri/cliente') ?>">Regresar</a></li>
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
                <label for="r0nombre">Nombre:</label>
                <input id="r0nombre" name="r0nombre">
            </fieldset>
            <fieldset>
                <label for="r0rif">CI/RIF:</label>
                <input id="r0rif" name="r0rif">
            </fieldset>

            <fieldset>
                <label for="r0nit">Nit:</label>
                <input id="r0nit" name="r0nit">
            </fieldset>

            <fieldset>
                <label for="r0contacto">Contácto (responsable):</label>
                <input id="r0contacto" name="r0contacto">
            </fieldset>

            <fieldset>
                <label for="r0email">Email:</label>
                <input id="r0email" name="r0email">
            </fieldset>

            <fieldset>
                <label for="r0tlf">Telefono:</label>
                <input id="r0tlf" name="r0tlf">
            </fieldset>

            <fieldset>
                <label for="r0direccion">Dirección fiscal:</label>
                <input id="r0direccion" name="r0direccion">
            </fieldset>

            <fieldset>
                <label for="r0pais">Pais:</label>
                <?= $pais ?>
            </fieldset>

            <fieldset>
                <label for="r0estado">Estado:</label>
                <?= $estado ?>
            </fieldset>

            <fieldset>
                <label for="r0ciudad">Ciudad:</label>
                <input id="r0ciudad" name="r0ciudad">
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