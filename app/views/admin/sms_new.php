<script>
    $(document).ready(function() {

        $.validator.addMethod("not_blank_between", function() {

            var n = $('#r0funcion').val().split(" ");
            if (n.length > 1)
                return false;
            else
                return true;

        }, "La función no puede tener espacios en blanco");



        $('#form1').validate({
            rules: {
                r0funcion: {
                    required: true,
                    minlength: 5,
                    not_blank_between: true
                },
                r0comando: {
                    required: true,
                    minlength: 5
                },
                r0respok: {
                    required: true,
                    minlength: 4
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
                url: "<?= Front::myUrl('admin/sms'); ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);

                    $(location).attr('href', '<?= Front::myUrl('admin/sms'); ?>');

                }
            });

            return false;
        });

    });
</script>

<article class="module width_full">
    <header><h3 class="tabs_involved">Crear Comando SMS</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('admin/sms') ?>">Regresar</a></li>
        </ul>
    </header>


    <form name="form1" id="form1">
        <div class="module_content">

            <fieldset>
                <div><label>Variables:</label></div>
                <br>
                 <h4 class="alert_warning">Recuerde usar sólo las variables de la lista a continuación: </h4>
                 <br>
                <div>
                    <?php
                    foreach ($vars as $i => $value) {
                        ?>
                        <span style="cursor: pointer; color:blue" title="<?= $vars[$i]['descripcion'] ?>">[&nbsp;<?= $vars[$i]['variable'] ?>&nbsp;]</span>
                        <?php
                    }
                    ?>
                </div>
                
                 
            </fieldset>



            <fieldset>
                <label for="r0nombre">Funcion:</label>
                <input id="r0funcion" name="r0funcion">
            </fieldset>

            <fieldset>
                <label for="r0comando">Comando completo:</label>
                <input id="r0comando" name="r0comando">
            </fieldset>

            <fieldset>
                <label for="r0respok">Resp. OK:</label>
                <input id="r0respok" name="r0respok">
            </fieldset>

            <fieldset>
                <label for="r0resperror">Resp. ERROR:</label>
                <input id="r0resperror" name="r0resperror">
                <input id="operacion" name="operacion" type="hidden" value="new">
            </fieldset>


            <fieldset>
                <label for="r0explicacion">Explicación:</label>
                <textarea id="r0explicacion" name="r0explicacion"></textarea>
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