<?php

function _gsmkey_edit() {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();

    $db->setTable("tbl_gsmkey");
    $db->getTableFields("*", "id = $id");

    //////descifrando clave del gsmkey
    $clavedes = $db->getField("clave");
    $db->setField("clave", convert_uudecode($clavedes));

    $db->close();

    $capacidades = array(200, 2000, false, $db->getField("capacidad"));

    $cap = Form::arrayCombo("r0capacidad", $capacidades, $capacidades);

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin GSM-KEY';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/gsmkey_edit.php', array("datos" => $db, "capacidad" => $cap));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}