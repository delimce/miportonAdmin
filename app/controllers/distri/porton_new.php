<?php

function _porton_new() {

    Security::hasPermissionTo("admin,distri");

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
        $cliente = Form::dbComboBox("r0cliente_id", $db, "nombre", "id", 'Seleccionar');
    }

    $visualiza = (Security::getFranquiciaID() == "") ? 'inherit' : 'none';

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Nuevo Porton';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/porton_new.php', array("cliente" => $cliente, "franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}