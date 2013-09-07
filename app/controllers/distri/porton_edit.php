<?php

function _porton_edit($id = false) {

    Security::hasPermissionTo("admin,distri");

    $db2 = new ObjectDB();
    $db2->setTable("tbl_porton");
    $franquicia = Security::getFranquiciaID(); ///para validar por franquicia
    if ($franquicia != "")
        $where = "and franquicia_id = $franquicia";
    $db2->getTableFields("*", "id = $id $where");
    $db2->close();

    //////////////
    ////validando que muestre el modulo cuando existan registros
    if ($db2->getNumRows() == 0)
        Front::redirect("distri/porton");

    ////traer combo de franquicias
    $db = new ObjectDB();
    ////combo de franquicia
    $db->setTable("tbl_franquicia");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", false, $db2->getField("franquicia_id"));

    ////para presentar el combo de clientes y edificio
    $where = 'franquicia_id = ' . $db2->getField("franquicia_id");

    $db = new ObjectDB();
    ////combo de clientes
    $db->setTable("tbl_cliente");
    $db->getTableAllRecords("id,nombre", $where, "nombre");
    $cliente = Form::dbComboBox("cliente", $db, "nombre", "id", "seleccionar", $db2->getField("cliente_id"));


    $db = new ObjectDB();
    ////combo de clientes
    $db->setTable("tbl_edificio");
    $db->getTableAllRecords("id,nombre", $where, "nombre");
    $edificio = Form::dbComboBox("r0edificio_id", $db, "nombre", "id", "seleccionar", $db2->getField("edificio_id"));


    $visualiza = (Security::getFranquiciaID() == "") ? 'inherit' : 'none';

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'editar Porton';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/porton_edit.php', array("edificio" => $edificio, "cliente" => $cliente, "franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}