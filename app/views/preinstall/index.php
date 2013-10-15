<script>
    $(document).ready(function() {

        $('#form1').validate({
            rules: {
                r0pais: {
                    required: true
                },
                r0estado: {
                    required: true
                },
                r0ciudad: {
                    required: true
                },
                r0establecimiento: {
                    required: true
                },
                r0operador: {
                    required: true
                },
                r0avenida: {
                    required: true
                },
                r0urb: {
                    required: true
                },
                r0edificio: {
                    required: true
                },
                r0responsable: {
                    required: true
                },
                r0email: {
                    email: true,
                    required: true
                },
                r0tlf: {
                    digits: true,
                    required: true
                },
                r0cant_puestos: {
                    digits: true,
                    min: 1,
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
                url: "<?= Front::myUrl('preinstall/save'); ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);

                    $(location).attr('href', '<?= Front::myUrl('preinstall/fin'); ?>');

                }
            });

            return false;
        });

    });
</script>

<article class="module width_half">
    <header><h3>Formulario de Preinstalación </h3></header>

    <form name="form1" id="form1">
        <div class="module_content">

            <fieldset>
                <label for="r0pais">Pais:</label>
                <?= $pais ?>
            </fieldset>

            <fieldset>
                <label for="r0estado">Estado:</label>
                <?= $estado ?>
            </fieldset>

            <fieldset>
                <label for="r0urb">Ciudad:</label>
                <input id="r0ciudad" name="r0ciudad">
            </fieldset>

            <fieldset>
                <label for="r0urb">Avenida:</label>
                <input id="r0avenida" name="r0avenida">
            </fieldset>

            <fieldset>
                <label for="r0urb">Urbanización:</label>
                <input id="r0urb" name="r0urb">
            </fieldset>

            <fieldset>
                <label for="r0urb">Establecimiento:</label>
                <?= $est ?>
            </fieldset>

            <fieldset>
                <label for="r0tlf">Edificio:</label>
                <input id="r0edificio" name="r0edificio">
            </fieldset>

            <fieldset>
                <label for="r0cant_puestos">Cantidad aprox. de puestos:</label>
                <input id="r0cant_puestos" name="r0cant_puestos">
            </fieldset>

            <fieldset>
                <label for="r0responsable">Nombre del contacto:</label>
                <input id="r0responsable" name="r0responsable">
            </fieldset>

            <fieldset>
                <label for="r0operador">Operadora:</label>
                <?= $operadora ?>
            </fieldset>


            <fieldset>
                <label for="r0tlf">Telefono:</label>
                <input id="r0tlf" name="r0tlf">
            </fieldset>

            <fieldset>
                <label for="r0email">Email:</label>
                <input id="r0email" name="r0email"  type="email">       
            </fieldset>

            <fieldset>
                <label for="r0tlf">Observaciones:</label>
                <textarea id="r0observaciones" name="r0observaciones"></textarea>
            </fieldset>

            <br>

        </div>
        <footer>
            <div class="submit_link">
                <input id="submit" type="submit" value="Guardar" class="alt_btn">
                <input type="submit" value="Reset">
            </div>
        </footer>

    </form>    
</article>