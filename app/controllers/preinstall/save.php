<?php

function _save() {

    ////para el cambio de clave
    $db = new ObjectDB();
    ////seleccionar la tabla

    $db->setTable("tbl_preinstalacion");

    $_POST["r0fecha"] = Calendar::getDatabaseDateTime();
    /////////////
    $db->dataInsert("r", "0", false, $_POST);

    $db->close();
}

?>
