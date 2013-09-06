<?php

function _selectCliente() {

    Security::hasPermissionTo("admin,distri");
    
    $cliente = Form::getVar("id");

    $db = new ObjectDB();

    $db->setTable("tbl_edificio");
    $db->getTableAllRecords("id,nombre", "cliente_id = $cliente", "nombre");
    $edif = Form::dbComboBox("r0cliente_id", $db, "nombre", "id");

    print $edif;
}