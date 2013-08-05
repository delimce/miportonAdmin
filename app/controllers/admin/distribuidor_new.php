<?php

function _distribuidor_new() {

    Security::hasPermissionTo("admin");
    
    $db = new ObjectDB();
     ////combo de clientes
    $db->setTable("tbl_franquicia");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", "seleccione");



    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Distribuidores';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/distri_new.php',array("franquicia" => $franquicia));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}