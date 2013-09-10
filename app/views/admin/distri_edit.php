<script>
    $(document).ready(function() {


        $.validator.addMethod("not_blank_between", function() {

            var n = $('#r0usuario').val().split(" ");
            if (n.length > 1)
                return false;
            else
                return true;

        }, "El usuario no puede tener espacios en blanco");


        $('#form1').validate({
            rules: {
                r0franquicia_id: {
                    required: true
                },
                r0usuario: {
                    required: true,
                    not_blank_between: true
                },
                r0nombre: {
                    required: true
                },
                r0ci: {
                    required: true,
                    digits: true
                },
                r0email: {
                    required: true,
                    email: true
                },
                r0tlf: {
                    digits: true
                },
                clave: {
                    required: true,
                    minlength: 4
                },
                clave2: {
                    required: true,
                    minlength: 4,
                    equalTo: "#clave"
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
                url: "<?= Front::myUrl('admin/distribuidor'); ?>",
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
    <header><h3 class="tabs_involved">Editar Distribuidor</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('admin/distribuidor') ?>">Regresar</a></li>
        </ul>
    </header>


    <form name="form1" id="form1">
        <div class="module_content">

            <fieldset>
                <label for="r0franquicia_id">Franquicia:</label>
                <?= $franquicia ?>
            </fieldset> 

            <fieldset>
                <label for="r0nombre">Nombre del distribuidor:</label>
                <input id="r0nombre" name="r0nombre" value="<?= $datos->getField("nombre") ?>">
            </fieldset>

            <fieldset>
                <label for="r0ci">Cedula:</label>
                <input id="r0ci" name="r0ci" value="<?= $datos->getField("ci") ?>">
            </fieldset>

            <fieldset>
                <label for="r0usuario">Usuario:</label>
                <input id="r0usuario" name="r0usuario" value="<?= $datos->getField("usuario") ?>">
                <input id="operacion" name="operacion" type="hidden" value="edit">
                <input id="id" name="id" type="hidden" value="<?= $datos->getField("id") ?>">
            </fieldset>

            <fieldset>
                <label for="r0tlf">Telefono:</label>
                <input id="r0tlf" name="r0tlf" value="<?= $datos->getField("tlf") ?>">
            </fieldset>

            <fieldset>
                <label for="r0email">Email:</label>
                <input id="r0email" name="r0email"  type="email" value="<?= $datos->getField("email") ?>">
            </fieldset>

            <fieldset>
                <label for="clave">Contraseña:</label>
                <input id="clave" name="clave" type="password" value="<?= $datos->getField("clave") ?>">
            </fieldset>

            <fieldset>
                <label for="clave2">Repita contraseña:</label>
                <input id="clave2" name="clave2" type="password" value="<?= $datos->getField("clave") ?>">
            </fieldset>

            <fieldset>
                <label for="r0activo">Activo:</label>
                <input id="r0activo" name="r0activo" value="1" type="checkbox" <?php if ($datos->getField("activo")) echo 'checked' ?>>

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