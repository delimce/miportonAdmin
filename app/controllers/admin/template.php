<?php

function _franquicia() {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();
    $db->setTable("tbl_franquicia");


    $operacion = Form::getVar("operacion"); ////para la desicion
    $ide = Form::getVar("id",$_POST);
    ///para el crud
    if ($operacion == "del") { ///caso de borrar registros
        $db->deleteWhere("id = $ide");
    } else if ($operacion == "new") { /// en caso de insert  
        $db->dataInsert("r", "0", false, $_POST);
    } else if ($operacion == "edit") { /// en caso de edit      
        $db->dataUpdate("r", "0", false, $_POST, "id = $ide");
    } else { //mostrar lista
        $db->getTableAllRecords("*");
        $db->freeResult();

        $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Franquicias';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/franq_list.php', array("lista" => $db));
        View::do_dump(LAYOUT_PATH . 'layout.php', $data);
    }

    $db->close(); //cierra la base de datos
}