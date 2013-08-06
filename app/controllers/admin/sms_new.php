<?php

function _sms_new($id = false) {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();
    
    $db->setTable("tbl_comandos_sms_vars");
    $db->setFields("variable,descripcion",false,"variable");
    $variables= $db->getMatrixDb();

    $db->close();

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin sms';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/sms_new.php', array("vars"=>$variables));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}