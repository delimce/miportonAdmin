<?php

function _zonas_edit() {

    Security::hasPermissionTo("admin");

    $db2 = new ObjectDB();
    $db2->setTable("tbl_zonas");
    $db2->getTableFields("*", "id = $id");
    
    $db2->close();
    
    
    $db = new ObjectDB();
    ////combo de operadora
    $db->setTable("tbl_operadora_tlf");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $operadora = Form::dbComboBox("r0operadora_id", $db, "nombre", "id",false,$db2->getField("operadora_id"));

    $db = new ObjectDB();
    ////combo de pais
    $db->setTable("tbl_pais");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $pais = Form::dbComboBox("r0pais_id", $db, "nombre", "id",false,$db2->getField("pais_id"));

    $db = new ObjectDB();
    ////combo de estados
    $db->setTable("tbl_estado");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $estado = Form::dbComboBox("r0estado_id", $db, "nombre", "id",false,$db2->getField("estado_id"));


    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Zonas';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/zonas_edit.php', array("datos" => $db2,"pais" => $pais, "estado" => $estado, "operadora" => $operadora));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}