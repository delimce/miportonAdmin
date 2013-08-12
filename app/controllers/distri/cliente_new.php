<?php

function _cliente_new() {

    Security::hasPermissionTo("admin,distri");

    ////traer combo de franquicias
    $db = new ObjectDB();
    
    
    

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Nuevo Cliente';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/client_new.php');
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}