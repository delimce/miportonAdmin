<?php

function _cliente_edit($id = false) {

    Security::hasPermissionTo("admin,distri");

    $db2 = new ObjectDB();
    $db2->setTable("tbl_cliente");
    $franquicia = Security::getFranquiciaID(); ///para validar por franquicia
    if($franquicia != "") $where = "and franquicia_id = $franquicia";
    $visualiza = ($franquicia == "") ? 'inherit' : 'none';
    $db2->getTableFields("*", "id = $id $where");
    $db2->close();



    ////traer combo de franquicias
    $db = new ObjectDB();
    ////combo de operadora
    $db->setTable("tbl_franquicia");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", false, $db2->getField("franquicia_id"));

    $db = new ObjectDB();
    ////combo de pais
    $db->setTable("tbl_pais");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $pais = Form::dbComboBox("r0pais", $db, "nombre", "nombre",false,$db2->getField("pais"));

    $db = new ObjectDB();
    ////combo de estados
    $db->setTable("tbl_estado");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $estado = Form::dbComboBox("r0estado", $db, "nombre", "nombre",false,$db2->getField("estado"));

    
    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Editar Cliente';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/client_edit.php', array("datos" => $db2,"pais" => $pais, "estado" => $estado, "franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}