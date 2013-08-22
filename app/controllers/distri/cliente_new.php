<?php

function _cliente_new() {

    Security::hasPermissionTo("admin,distri");

    ////traer combo de franquicias
    $db = new ObjectDB();
    ////combo de operadora
    $db->setTable("tbl_franquicia");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", false, Security::getFranquiciaID());

    $db = new ObjectDB();
    ////combo de pais
    $db->setTable("tbl_pais");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $pais = Form::dbComboBox("r0pais", $db, "nombre", "nombre");

    $db = new ObjectDB();
    ////combo de estados
    $db->setTable("tbl_estado");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $estado = Form::dbComboBox("r0estado", $db, "nombre", "nombre");

     $visualiza = (Security::getFranquiciaID()=="") ? 'inherit' : 'none';

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Nuevo Cliente';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/client_new.php', array("pais" => $pais, "estado" => $estado, "franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}