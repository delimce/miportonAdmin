<?php

function _franquicia_edit($id = false) {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();
    $db->setTable("tbl_franquicia");
    $db->getTableFields("id,nombre,responsable", "id = $id");

    $db->close();

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Franquicias';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/franq_edit.php', array("datos" => $db));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}