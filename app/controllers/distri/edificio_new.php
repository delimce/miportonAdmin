<?php

function _edificio_new() {

    Security::hasPermissionTo("admin,distri");

    $db = new ObjectDB();
    ////combo de zonas
    $db->setTable("tbl_zona");
    $db->getTableAllRecords("id,zona", false, "zona");
    $zona = Form::dbComboBox("r0zona_id", $db, "zona", "id");

    ///todo: si quiere incluir filtro por franquicia
    ////traer combo de franquicias
    $db = new ObjectDB();
    ////combo de franquicia
    $db->setTable("tbl_franquicia");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", 'Seleccionar', Security::getFranquiciaID());

    $where = (Security::getFranquiciaID() == "") ? false : 'franquicia_id = ' . Security::getFranquiciaID();


    ////para presentar el combo de clientes

    if (!$where) {

        $cliente = "seleccione la franquicia";
    } else {
        $db = new ObjectDB();
        ////combo de clientes
        $db->setTable("tbl_cliente");
        $db->getTableAllRecords("id,nombre", $where, "nombre");
        $cliente = Form::dbComboBox("r0cliente_id", $db, "nombre", "id");
    }


    $db = new ObjectDB();
    ////combo de clientes
    $db->setTable("tbl_establecimiento");
    $db->getTableAllRecords("tipo", false, "tipo");
    $est = Form::dbComboBox("r0establecimiento", $db, "tipo", "tipo");


    $visualiza = (Security::getFranquiciaID() == "") ? 'inherit' : 'none';

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Nuevo Edificio';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/edif_new.php', array("zona" => $zona, "cliente" => $cliente, "est" => $est, "franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}