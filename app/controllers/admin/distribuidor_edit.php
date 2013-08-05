<?php

function _distribuidor_edit($id = false) {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();
    $db->setTable("tbl_distribuidor");
    $db->getTableFields("*", "id = $id");

    $db2 = new ObjectDB();
    $db2->setTable("tbl_franquicia");
    $db2->getTableAllRecords("id,nombre", false, "nombre");
    $franquicia = Form::dbComboBox("r0franquicia_id", $db2, "nombre", "id", "seleccione", $db->getField("franquicia_id"));

    $db->close();
    $db2->close();

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Distribuidores';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/distri_edit.php', array("datos" => $db, "franquicia" => $franquicia));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}