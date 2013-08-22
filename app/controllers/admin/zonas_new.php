<?php

function _zonas_new() {

    Security::hasPermissionTo("admin");


    $db = new ObjectDB();
    ////combo de operadora
    $db->setTable("tbl_operadora_tlf");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $operadora = Form::dbComboBox("r0operadora_id", $db, "nombre", "id");

    $db = new ObjectDB();
    ////combo de pais
    $db->setTable("tbl_pais");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $pais = Form::dbComboBox("r0pais_id", $db, "nombre", "id");

    $db = new ObjectDB();
    ////combo de estados
    $db->setTable("tbl_estado");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $estado = Form::dbComboBox("r0estado_id", $db, "nombre", "id");



    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Zonas';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/zonas_new.php', array("pais" => $pais, "estado" => $estado, "operadora" => $operadora));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}