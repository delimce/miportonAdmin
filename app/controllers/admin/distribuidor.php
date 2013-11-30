<?php

function _distribuidor() {

    Security::hasPermissionTo("admin");

    $db = new ObjectDB();
    $db->setTable("tbl_distribuidor");

    $operacion = Form::getVar("operacion"); ////para la desicion
    $ide = Form::getVar("id", $_POST);
    ///para el crud
    if ($operacion == "del") { ///caso de borrar registros
        $db->deleteWhere("id = $ide");
    } else if ($operacion == "new") { /// en caso de insert  
        $_POST["r0fecha_creado"] = Calendar::getDatabaseDateTime();
        $_POST["r0creado_por"] = Security::getCreador();
        $clave1 = Form::getVar("clave", $_POST);
        $_POST["r0clave"] = md5($clave1); ////cifrando clave
        $db->dataInsert("r", "0", false, $_POST);
    } else if ($operacion == "edit") { /// en caso de edit    
        $db->getTableFields("clave", "id = $ide"); ///cifrar clave
        $clave2 = Form::getvar("clave", $_POST);
        if ($db->getField("clave") != $clave2)
            $_POST['r0clave'] = md5($clave2);
        $activo = Form::getvar("r0activo", $_POST);
        $_POST['r0activo'] = (empty($activo)) ? 0 : 1;
        /////////////

        $db->dataUpdate("r", "0", false, $_POST, "id = $ide");

        echo '<h4 class="alert_success">Edición efectuada con éxito</h4>';
    } else { //mostrar lista
        $db->setSql(FactoryDao::distribuidorList());
        $db->executeQuery();


        $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Distribuidores';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/distri_list.php', array("lista" => $db));
        View::do_dump(LAYOUT_PATH . 'layout.php', $data);
    }

    $db->close(); //cierra la base de datos
}
