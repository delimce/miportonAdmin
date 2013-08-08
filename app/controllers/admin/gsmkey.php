<?php

function _gsmkey() {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();
    $db->setTable("tbl_gsmkey");

    $operacion = Form::getVar("operacion"); ////para la desicion
    $ide = Form::getVar("id",$_POST);
    ///para el crud
    if ($operacion == "del") { ///caso de borrar registros
        $db->deleteWhere("id = $ide");
    } else if ($operacion == "new") { /// en caso de insert
        $_POST["r0admin_id"] = Security::getUserID();
        $clave = Form::getVar("r0clave",$_POST);
        $_POST["r0clave"] = convert_uuencode($clave); ///cifrando clave gsmkey
        $db->dataInsert("r", "0", false, $_POST);
    } else if ($operacion == "edit") { /// en caso de edit  
        
         $clave = Form::getVar("r0clave",$_POST);
        $_POST["r0clave"] = convert_uuencode($clave); ///cifrando clave gsmkey
        $db->dataUpdate("r", "0", false, $_POST, "id = $ide");
          echo '<h4 class="alert_success">Edición efectuada con éxito</h4>';
          
    } else { //mostrar lista
        $db->setSql(FactoryDao::gsmKeyList());
        $db->executeQuery();

        $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin GSM-KEY';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/gsmkey_list.php', array("lista" => $db));
        View::do_dump(LAYOUT_PATH . 'layout.php', $data);
    }

    $db->close(); //cierra la base de datos
}