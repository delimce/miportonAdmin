<?php

function _gsmkey_edit($id = false) {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();

    $db->setTable("tbl_gsmkey");
    $db->getTableFields("*", "id = $id");

    //////descifrando clave del gsmkey
    $clavedes = $db->getField("clave");
    $db->setField("clave", convert_uudecode($clavedes));

    $db->close();

    ////combo de zonas
    $db2 = new ObjectDB();
    $db2->setTable("tbl_zona");
    $db2->getTableAllRecords("id,zona", false, "zona");
    $zonas = Form::dbComboBox("r0zona_id", $db2, "zona", "id", false, $db->getField("zona_id"));


    $capacidades = array(200, 2000);

    $cap = Form::arrayCombo("r0capacidad", $capacidades, $capacidades, false, $db->getField("capacidad"));

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin GSM-KEY';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/gsmkey_edit.php', array("datos" => $db, "zonas" => $zonas, "capacidad" => $cap));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}