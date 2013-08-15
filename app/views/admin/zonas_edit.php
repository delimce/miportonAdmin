<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                r0zona: {
                    required: true
                },
                r0descripcion: {
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

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('admin/zonas'); ?>",
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

    <header><h3 class="tabs_involved">Editar Zona</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('admin/zonas') ?>">Regresar</a></li>
        </ul>
    </header>


    <form name="form1" id="form1">
        <div class="module_content">

            <fieldset>
                <label for="r0zona">Nombre de la Zona:</label>
                <input id="r0zona" name="r0zona" value="<?= $datos->getField("zona") ?>">
            </fieldset>

            <fieldset>
                <label for="r0pais_id">Pais:</label>
                <?= $pais ?>
            </fieldset>

            <fieldset>
                <label for="r0estado_id">Estado:</label>
                <?= $estado ?>
            </fieldset>

            <fieldset>
                <label for="r0operadora_id">Operadora tlf:</label>
                <?= $operadora ?>
            </fieldset>


            <fieldset>
                <label for="r0descripcion">Descripción de la zona:</label>
                <textarea id="r0descripcion" name="r0descripcion"><?= $datos->getField("descripcion") ?></textarea>
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