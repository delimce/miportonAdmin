<script>
    $(document).ready(function() {


        $.validator.addMethod("not_blank_between", function() {

            var n = $('#r0variable').val().split(" ");
            if (n.length > 1)
                return false;
            else
                return true;

        }, "La variable no puede tener espacios en blanco");
        
         $.validator.addMethod("start_with_dollar", function() {

            var str = $('#r0variable').val();
            if (str.substring(0,1) !== '$')
                return false;
            else
                return true;

        }, "La variable debe comenzar con el caracter '$' ");


        $('#form1').validate({
            rules: {
                r0variable: {
                    required: true,
                    minlength: 5,
                    not_blank_between: true,
                    start_with_dollar: true
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
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('admin/vars'); ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);

                    $(location).attr('href', '<?= Front::myUrl('admin/vars'); ?>');

                }
            });

            return false;
        });

    });
</script>


<article class="module width_half">
    <header><h3 class="tabs_involved">Editar Variable</h3>
        <ul class="tabs">
            <li><a href="<?= Front::myUrl('admin/vars') ?>">Regresar</a></li>
        </ul>
    </header>

    <form name="form1" id="form1">
        <div class="module_content">

            <fieldset>
                <label for="r0variable">Nombre de la Variable:</label>
                <input id="r0variable" name="r0variable">
            </fieldset>
            <fieldset>
                <label for="r0descripcion">Descripción:</label>
                <textarea id="r0descripcion" name="r0descripcion"></textarea>
                <input id="operacion" name="operacion" type="hidden" value="new">
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