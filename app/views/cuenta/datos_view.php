<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                 r0nombre:{
                    required:true
                },
                r0email:{
                    email:true
                },
                r0tlf:{
                    digits:true
                },
                clave:{
                    required:true,
                    minlength: 4
                },
                clave2:{
                    required:true,
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
                url: "<?= Front::myUrl('cuenta/save'); ?>",
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
    <header><h3>Datos de mi cuenta</h3></header>


    <form name="form1" id="form1">
        <div class="module_content">
           
            <fieldset>
                <label for="r0nombre">Nombre completo:</label>
                <input id="r0nombre" name="r0nombre" value="<?= $datos->getField("nombre") ?>">
            </fieldset>
            <fieldset>
                <label for="r0usuario">Usuario:</label>
                <input id="r0usuario" name="r0usuario" readonly="yes" value="<?= $datos->getField("usuario") ?>">
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
                        
            <div id="mensaje">&nbsp;</div>

            <br>

        </div>
        <footer>
            <div class="submit_link">
                <input id="submit" type="submit" value="Guardar" class="alt_btn">
                <input type="reset" value="Deshacer">
            </div>
        </footer>

    </form>    
</article>

