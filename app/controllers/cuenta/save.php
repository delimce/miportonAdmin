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
        case "ditribuidor":
            $tabla = 'tbl_distribuidor';
            break;
        default :
            $tabla = 'tbl_edificio_admin';
            break;
    }

    $db->setTable($tabla);

    $db->getTableFields("password", "id = " . Security::getUserID());
    $clave2 = Form::getvar("clave", $_POST);
    if ($db->getField("password") != $clave2)
        $_POST['r0password'] = md5($clave2);
    /////////////

    $db->dataUpdate("r", "0", $tabla, $_POST, "id = " . Security::getUserID());

    $db->close();

    ////cambiar variable de sesion
    Security::setUserName(Form::getVar("r0nombre"));

    echo 'datos actualizados con exito';
}

?>
