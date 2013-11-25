<?php

function _porton_addgsmkey($id = false) {

    Security::hasPermissionTo("admin,distri");

    $db2 = new ObjectDB();

    $db2->setTable("tbl_porton");
    $db2->getTableFields("*", "id = ".$id);
   echo $edificio = $db2->getField("edificio_id");
    $franquicia = $db2->getField("franquicia_id");
    $porton = $db2->getField("ubicacion_ref");
    
       //////////////
    ////validando que muestre el modulo cuando existan registros
    if (Security::getFranquiciaID() != $franquicia && Security::getFranquiciaID() != '')
        Front::redirect("distri/porton");

    $db2->setSql(FactoryDao::getGsmKeybyEdif($edificio));
    $db2->executeQuery();
    $db2->close();

 
    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Agregar gsm-key a Porton';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/porton_addgsmkey.php', array("datos" => $db2, "referencia" => $porton,"ide" => $id));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}
