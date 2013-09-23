<script>
    $(document).ready(function() {


        $(function() {
            $('#search_input').fastLiveFilter('#search_list', {
                callback: function(total) {
                    $('#num_results').html(total);
                }
            });
        });




        $("#submit").click(function() {

            if ($("input:checked").length == 0) {
                alert('please checked atleast one');
                return false;
            }

            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('distri/admin'); ?>",
                cache: false,
                data: formData,
                success: function(data, status) {
                    data = $.trim(data);
                    $(location).attr('href', '<?= Front::myUrl('distri/admin'); ?>');
                }
            });
            return false;
        });
        $("#back1").click(function() {

            history.back();
            return false;
        })



    });
</script>

<article class="module width_half">

    <header><h3 class="tabs_involved">Nuevo Admin edificio</h3>

    </header>

    <form name="form1" id="form1">
        <div class="module_content">

            Lista de edificios

            <hr>
            <div>

                <input id="search_input" placeholder="buscar">&nbsp;Total:&nbsp;<span id="num_results"></span>

            </div>

            <ul id="search_list" style="list-style-type: none;">
                <?
                $i = 0;
                while ($i < count($edificios)) {
                    ?>
                    <li>
                        <span width="6%"><input name="select[]" id="select[]" type="checkbox"  value="<?= $edificios[$i]['id'] ?>" <?php if (!empty($edificios[$i]['admin_id'])) echo 'checked="checked"'; ?>></span>
                        <span width="34%" style="text-transform: capitalize; font-weight: bolder"><?= $edificios[$i]['edificio']; ?></span>
                        <span style="font-style: italic" width="17%">(<?= $edificios[$i]['cliente']; ?>)</span> 
                    </li>

                    <?php
                    $i++;
                }
                ?>
            </ul> 

            <input id="operacion" name="operacion" type="hidden" value="edit">
            <input id="id" name="id" type="hidden" value="<?= $datos["admin"] ?>">

            <br>

        </div>
        <footer>
            <div class="submit_link">
                <input id="back1" type="submit" value="Volver" class="alt_btn">
                &nbsp;
                <input id="submit" type="submit" value="Guardar" class="alt_btn">
            </div>
        </footer>

    </form>    
</article>