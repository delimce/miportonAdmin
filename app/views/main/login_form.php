<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                user: {
                    required: true
                },
                clave: {
                    required: true
                }

            },
            errorElement: "div"
        });


        $("#user").click(function() {

            $("#mensaje").html('&nbsp;');
        });

        $("#clave").click(function() {

            $("#mensaje").html('&nbsp;');
        });


        $("#submit").click(function() {

            //validando
            if (!$("#form1").valid())
                return false;

            var formData = $("#form1").serialize();

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('main/login'); ?>",
                cache: false,
                data: formData,
                success: function(data) {
                    data = $.trim(data);
                    if (data > 0) {
                        $(location).attr('href', '<?= Front::myUrl('main/index'); ?>');
                    } else {
                        $("#mensaje").html('<div class="warning">Error de usuario ó contraseña</div>');

                    }
                }
            });

            return false;
        });
    });
</script>


<section style="max-width: 450px;">

    <!-- end of stats article --><!-- end of content manager article --><!-- end of messages article -->

    <article class="module width_full">

        <form name="form1" id="form1">
            <h1><img src="<?= Front::myUrl('images/minilogo.gif') ?>"></h1>
            <div class="module_content">
                <fieldset>
                    <label for="user">Usuario:</label>
                    <input id="user" name="user">
                </fieldset>
                <fieldset>
                    <label for="clave">Clave:</label>
                    <input id="clave" name="clave" type="password">
                </fieldset>

                <div id="mensaje">&nbsp;</div>

                <br>
                <input id="submit" type="submit" value="Entrar" style="width:100px;" class="alt_btn">

            </div>
            <footer>
                <div style="margin-top:8px;" align="center">
                    ©&nbsp;<?= date("Y") . " todos los derechos reservados" ?> 
                </div>
            </footer>

        </form>
    </article>




</section>