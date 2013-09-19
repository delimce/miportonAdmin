<?php

function _cliente_new() {

    Security::hasPermissionTo("admin,distri");


    $db = new ObjectDB();
    ////traer combo de franquicias
    $db->setTable("tbl_franquicia");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", false, Security::getFranquiciaID());


    $visualiza = (Security::getFranquiciaID() == "") ? 'inherit' : 'none';

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Nuevo Admin edificio';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/admin_new.php', array("franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}