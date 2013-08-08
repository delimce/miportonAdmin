<?php

function _gsmkey_new() {

    Security::hasPermissionTo("admin");

    $capacidades = array(200,2000);

    $cap = Form::arrayCombo("r0capacidad", $capacidades, $capacidades);

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin GSM-KEY';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/gsmkey_new.php', array("capacidad" => $cap));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}