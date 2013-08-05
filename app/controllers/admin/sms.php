<?php

function _sms() {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();
    $db->setTable("tbl_comandos_sms");

    $operacion = Form::getVar("operacion"); ////para la desicion
    $ide = Form::getVar("id",$_POST);
    ///para el crud
    if ($operacion == "del") { ///caso de borrar registros
        $db->deleteWhere("id = $ide");
    } else if ($operacion == "new") { /// en caso de insert
       
        $db->dataInsert("r", "0", false, $_POST);
    } else if ($operacion == "edit") { /// en caso de edit      
        $db->dataUpdate("r", "0", false, $_POST, "id = $ide");
          echo '<h4 class="alert_success">Edición efectuada con éxito</h4>';
    } else { //mostrar lista
        $db->getTableAllRecords("id,funcion,explicacion");
        $db->freeResult();

        $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin SMS';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/sms_list.php', array("lista" => $db));
        View::do_dump(LAYOUT_PATH . 'layout.php', $data);
    }

    $db->close(); //cierra la base de datos
}