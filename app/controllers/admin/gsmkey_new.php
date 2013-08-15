<?php

function _gsmkey_new() {

    Security::hasPermissionTo("admin");

    ////combo de zonas
    $db = new ObjectDB();
    $db->setTable("tbl_zona");
    $db->getTableAllRecords("id,zona", false, "zona");
    $zonas = Form::dbComboBox("r0zona_id", $db, "zona", "id");

    $capacidades = array(200, 2000);

    $cap = Form::arrayCombo("r0capacidad", $capacidades, $capacidades);

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin GSM-KEY';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/gsmkey_new.php', array("capacidad" => $cap, "zonas" => $zonas));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}