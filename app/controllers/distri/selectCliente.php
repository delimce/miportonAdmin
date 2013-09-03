<?php

function _selectCliente() {

    Security::hasPermissionTo("admin,distri");
    
    $franquicia = Form::getVar("id");

    $db = new ObjectDB();

    $db->setTable("tbl_cliente");
    $db->getTableAllRecords("id,nombre", "franquicia_id = $franquicia", "nombre");
    $cliente = Form::dbComboBox("r0cliente_id", $db, "nombre", "id");

    print $cliente;
}