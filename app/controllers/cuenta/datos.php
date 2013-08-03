<?php

function _datos() {

    Security::sessionActive();

    $db = new ObjectDB();

    switch (Security::getUserProfileName()) {
        case 'admin':
            $tabla = "tbl_admin";

            break;

        case 'edificio':
            $tabla = "tbl_edificio_admin";

            break;

        default:
            $tabla = "tbl_distribuidor";
            break;
    }

    $db->setTable($tabla);
    $db->getTableFields("id,nombre,email,usuario,clave,tlf", "id = " + Security::getUserID());
    
    $db->close();

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Editar datos';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'cuenta/datos_view.php', array("datos" => $db));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}