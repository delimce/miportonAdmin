<?php

function _admin_new2() {

    Security::hasPermissionTo("admin,distri");


    $db = new ObjectDB();
    
    ////estructura de edificios
    $db->setSql(FactoryDao::getEdifByFranquicia($franquicia)); 
    $edificios = $db->getMatrixDb(); ///lista de edificios
            
    $db->close();
  

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Nuevo Admin edificio';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/admin_new.php', array("edificios" => $edificios));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}