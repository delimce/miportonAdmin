<?php

function _vars_edit($id = false) {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();
    $db->setTable("tbl_comandos_sms_vars");
    $db->getTableFields("*", "id = $id");

    $db->close();

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Variables SMS';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/vars_edit.php', array("datos" => $db));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}