<?php

function _selectEdificio() {

    Security::hasPermissionTo("admin,distri");

    $cliente = Form::getVar("id");

    $db = new ObjectDB();

    $db->setTable("tbl_edificio");
    $db->getTableAllRecords("id,nombre", "cliente_id = $cliente", "nombre");
    $edif = Form::dbComboBoxAjax($db, "nombre", "id", "Seleccionar");

    print $edif;
}