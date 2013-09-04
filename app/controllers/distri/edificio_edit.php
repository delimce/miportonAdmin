<?php

function _edificio_edit($id = false) {

    Security::hasPermissionTo("admin,distri");

    $db2 = new ObjectDB();
    $db2->setTable("tbl_edificio");
    $franquicia = Security::getFranquiciaID(); ///para validar por franquicia
    if ($franquicia != "")
        $where = "and franquicia_id = $franquicia";
    $visualiza = ($franquicia == "") ? 'inherit' : 'none';
    $db2->getTableFields("*", "id = $id $where");
    $db2->close();

    //////////////
    ////validando que muestre el modulo cuando existan registros
    if ($db2->getNumRows() == 0)
        Front::redirect("distri/cliente");


    $db = new ObjectDB();
    ////combo de franquicia
    $db->setTable("tbl_franquicia");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", false, $db2->getField("franquicia_id"));


    $db = new ObjectDB();
    ////combo de zonas
    $db->setTable("tbl_zona");
    $db->getTableAllRecords("id,zona", false, "zona");
    $zona = Form::dbComboBox("r0zona_id", $db, "zona", "id", false, $db2->getField("zona_id"));

    ///todo: si quiere incluir filtro por franquicia

    $where = 'franquicia_id = ' . $db2->getField("franquicia_id");

    $db = new ObjectDB();
    ////combo de clientes
    $db->setTable("tbl_cliente");
    $db->getTableAllRecords("id,nombre", $where, "nombre");
    $cliente = Form::dbComboBox("r0cliente_id", $db, "nombre", "id", false, $db2->getField("cliente_id"));


    $db = new ObjectDB();
    ////combo de clientes
    $db->setTable("tbl_establecimiento");
    $db->getTableAllRecords("tipo", false, "tipo");
    $est = Form::dbComboBox("r0establecimiento", $db, "tipo", "tipo", false, $db2->getField("establecimiento"));


    $visualiza = (Security::getFranquiciaID() == "") ? 'inherit' : 'none';

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Editar Edificio';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/edif_edit.php', array("datos" => $db2, "zona" => $zona, "cliente" => $cliente, "est" => $est, "franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}