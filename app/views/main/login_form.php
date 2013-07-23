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
                        alert('clave ó usuario incorrectos');

                    }
                }
            });

            return false;
        });
    });
</script>


<section style="width:400px; text-align:center">

    <!-- end of stats article --><!-- end of content manager article --><!-- end of messages article -->

    <article class="module width_full">

        <form name="form1" id="form1">
            <h1><img src="<?= Front::myUrl('images/minilogo.png') ?>" width="201" height="72"></h1>
            <div class="module_content">
                <fieldset>
                    <label>Usuario:</label>
                    <input id="user" name="user" type="text">
                </fieldset>
                <fieldset>
                    <label>Clave:</label>
                    <input id="clave" name="clave" type="password">
                </fieldset>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
            <footer>
                <div class="submit_link">
                    <input id="submit" type="submit" value="Entrar" class="alt_btn">
                    <input name="Reset" type="reset" value="Reset">
                </div>
            </footer>

        </form>
    </article>

</section>