<script>
    $(document).ready(function() {

        jQuery.validator.addMethod("exactlength", function(value, element, param) {
            return this.optional(element) || value.length == param;
        }, jQuery.format("Please enter exactly 6 characters."));

        $('#form1').validate({
            rules: {
                r0imei: {
                    required: true,
                    digits: true,
                    minlength: 14,
                    maxlength: 15
                },
                r0tlf: {
                    required: true,
                    digits: true,
                    minlength: 11,

                },
                r0clave: {
                    required: true,
                    digits: true,
                    exactlength: 6
                },
                clave2: {
                    required: true,
                    equalTo: "#r0clave"
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
                url: "<?= Front::myUrl('admin/gsmkey'); ?>",
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

    <header><h3 class="tabs_involved">Crear GSM-KEY</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('admin/gsmkey') ?>">Regresar</a></li>
        </ul>
    </header>

    <form name="form1" id="form1">
        <div class="module_content">

            <fieldset>
                <label for="r0modelo">Modelo:</label>
                <input id="r0modelo" name="r0modelo" value="<?=$datos->getField("modelo") ?>">
            </fieldset>


            <fieldset>
                <label for="r0imei">Imei:</label>
                <input id="r0imei" name="r0imei" value="<?=$datos->getField("imei") ?>">
            </fieldset>

            <fieldset>
                <label for="r0tlf">Telefono:</label>
                <input id="r0tlf" name="r0tlf" value="<?=$datos->getField("tlf") ?>">
            </fieldset>


            <fieldset>
                <label for="r0capacidad">Capacidad:</label>
                <?= $capacidad ?>
            </fieldset>

            <fieldset>
                <label for="r0clave">Clave:</label>
                <input id="r0clave" name="r0clave" value="<?=$datos->getField("clave") ?>">
            </fieldset>

            <fieldset>
                <label for="clave2">Repetir clave:</label>
                <input id="clave2" name="clave2" value="<?=$datos->getField("clave") ?>">
                <input id="id" name="id" type="hidden" value="<?= $datos->getField("id") ?>">
                <input id="operacion" name="operacion" type="hidden" value="edit">
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