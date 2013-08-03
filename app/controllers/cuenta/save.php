<?php

function _save() {

    Security::sessionActive();

    ////para el cambio de clave
    $db = new ObjectDB();
    ////seleccionar la tabla
    switch (Security::getUserProfileName()) {

        case "admin":
            $tabla = 'tbl_admin';
            break;
        case "edificio":
            $tabla = 'tbl_edificio_admin';
            break;
        default :
            $tabla = 'tbl_distribuidor';
            break;
    }

    $db->setTable($tabla);

    $db->getTableFields("clave", "id = " . Security::getUserID());
    $clave2 = Form::getvar("clave", $_POST);
    if ($db->getField("clave") != $clave2)
        $_POST['r0clave'] = md5($clave2);
    /////////////

    $db->dataUpdate("r", "0", $tabla, $_POST, "id = " . Security::getUserID());

    $db->close();

    ////cambiar variable de sesion
    Security::setUserName(Form::getVar("r0nombre"));

    echo '<h4 class="alert_success">Edición efectuada con éxito</h4>';
}

?>
