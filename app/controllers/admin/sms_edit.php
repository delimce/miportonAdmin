<?php

function _sms_edit($id = false) {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();
    
    $db->setTable("tbl_comandos_sms_vars");
    $db->setFields("variable,descripcion",false,"variable");
    $variables= $db->getMatrixDb();
        
    $db->setTable("tbl_comandos_sms");
    $db->getTableFields("*", "id = $id");

    $db->close();

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin sms';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/sms_edit.php', array("datos" => $db,"vars"=>$variables));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}