<?php

function _selectCliente() {

    Security::hasPermissionTo("admin,distri");
    
    $franquicia = Form::getVar("id");

    $db = new ObjectDB();

    $db->setTable("tbl_cliente");
    $db->getTableAllRecords("id,nombre", "franquicia_id = $franquicia", "nombre");
    $cliente = Form::dbComboBoxAjax($db, "nombre", "id","seleccionar");

    print $cliente;
}