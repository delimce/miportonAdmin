<script>
    $(document).ready(function() {

        $.validator.addMethod("not_blank_between", function() {

            var n = $('#r0user').val().split(" ");
            if (n.length > 1)
                return false;
            else
                return true;

        }, "El usuario no puede tener espacios en blanco");


        $('#form1').validate({
            rules: {
                r0nombre: {
                    required: true
                },
                r0email: {
                    email: true
                },
                r0tlf: {
                    digits: true
                },
                r0user: {
                    required: true,
                    not_blank_between: true
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
                url: "<?= Front::myUrl('micuenta/save'); ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);

                    $("#notification").text(data);
                    $("#notification").css({color: "blue", fontWeight: "bold"});


                }
            });

            return false;
        });

    });
</script>


<form name="form1" id="form1">

    <article class="module width_full">
        <header><h3>Datos de mi cuenta</h3></header>
        <div class="module_content">
            <fieldset>
                <label for="r0nombre">Nombre completo</label>
                <input id="r0nombre" mame="r0nombre" type="text"  value="<?= '' ?>">
            </fieldset>

            <fieldset>
                <label for="r0usuario">Usuario</label>
                <input id="r0usuario" mame="r0usuario" type="text"  value="<?= '' ?>">
            </fieldset>

            <fieldset>
                <label for="r0tlf">Telefono</label>
                <input id="r0tlf" mame="r0tlf" type="text"  value="<?= '' ?>">
            </fieldset>

            <fieldset>
                <label for="r0email">email</label>
                <input id="r0email" mame="r0email" type="email"  value="<?= '' ?>">
            </fieldset>

            <fieldset>
                <label for="clave">Contraseña</label>
                <input id="clave" mame="clave" type="password"  value="<?= '' ?>">
            </fieldset>

            <fieldset>
                <label for="clave2">Repita Contraseña</label>
                <input id="clave2" mame="clave2" type="password"  value="<?= '' ?>">
            </fieldset>

        </div>
        <footer>
            <div class="submit_link">
                <input id="submit" type="submit" value="Guardar" class="alt_btn">
                <input type="submit" value="Reset">
            </div>
        </footer>
    </article>

</form>    