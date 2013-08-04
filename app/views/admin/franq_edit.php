<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                r0nombre: {
                    required: true
                },
                r0responsable: {
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
                url: "<?= Front::myUrl('admin/franquicia'); ?>",
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


<article class="module width_half">
    <header><h3 class="tabs_involved">Editar Franquicia</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('admin/franquicia') ?>">Regresar</a></li>
        </ul>
    </header>


    <form name="form1" id="form1">
        <div class="module_content">

            <fieldset>
                <label for="r0nombre">Nombre de la franquicia:</label>
                <input id="r0nombre" name="r0nombre" value="<?= $datos->getField("nombre") ?>">
            </fieldset>
            <fieldset>
                <label for="r0responsable">Nombre del responsable:</label>
                <input id="r0responsable" name="r0responsable" value="<?= $datos->getField("responsable") ?>">
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