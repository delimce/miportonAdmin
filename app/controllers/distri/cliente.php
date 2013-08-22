<?php

function _cliente() {

    Security::hasPermissionTo("admin,distri");

    $db = new ObjectDB();
    $db->setTable("tbl_cliente");

    $operacion = Form::getVar("operacion"); ////para la desicion
    $ide = Form::getVar("id",$_POST);
    ///para el crud
    if ($operacion == "del") { ///caso de borrar registros
        $db->deleteWhere("id = $ide");
    } else if ($operacion == "new") { /// en caso de insert
        $_POST["r0fecha"] = Calendar::getDatabaseDateTime();
        $db->dataInsert("r", "0", false, $_POST);
    } else if ($operacion == "edit") { /// en caso de edit      
        $db->dataUpdate("r", "0", false, $_POST, "id = $ide");
          echo '<h4 class="alert_success">Edición efectuada con éxito</h4>';
    } else { //mostrar lista con el id de la franquicia
        $db->setSql(FactoryDao::clienteList((Security::getFranquiciaID()>0?Security::getFranquiciaID():0)));
        $db->executeQuery();

        $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Clientes';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/client_list.php', array("lista" => $db));
        View::do_dump(LAYOUT_PATH . 'layout.php', $data);
    }

    $db->close(); //cierra la base de datos
}