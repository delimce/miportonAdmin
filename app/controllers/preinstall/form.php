<?php

function _form() {

    $db = new ObjectDB();
    ////combo de operadora
    $db->setTable("tbl_operadora_tlf");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $operadora = Form::dbComboBox("r0operador", $db, "nombre", "nombre","Seleccione");

    $db = new ObjectDB();
    ////combo de clientes
    $db->setTable("tbl_establecimiento");
    $db->getTableAllRecords("tipo", false, "tipo");
    $est = Form::dbComboBox("r0establecimiento", $db, "tipo", "tipo","Seleccione");


    $db = new ObjectDB();
    ////combo de pais
    $db->setTable("tbl_pais");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $pais = Form::dbComboBox("r0pais", $db, "nombre", "nombre");

    $db = new ObjectDB();
    ////combo de estados
    $db->setTable("tbl_estado");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $estado = Form::dbComboBox("r0estado", $db, "nombre", "nombre","Seleccione");


    $data['siteTitle'] = 'Registrar nueva Instalación';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'preinstall/index.php', array("operadora" => $operadora, "est" => $est, "pais" => $pais, "estado" => $estado));
    View::do_dump(LAYOUT_PATH . 'layoutPreinstall.php', $data);
}