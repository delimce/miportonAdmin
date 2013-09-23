<?php

function _admin() {

    Security::hasPermissionTo("admin,distri");

    $db = new ObjectDB();
    $db->setTable("tbl_edificio_admin");

    $operacion = Form::getVar("operacion"); ////para la desicion
    $ide = Form::getVar("id", $_POST);
    ///para el crud
    if ($operacion == "del") { ///caso de borrar registros
        $db->deleteWhere("id = $ide");
    } else if ($operacion == "new") { /// en caso de insert
        ////insertando datos del administrador
        $datos = Security::getSessionVar("DATADMIN"); ///datos del admin
        $db->setField("franquicia_id", $datos['franquicia']);
        $db->setField("nombre", $datos['nombre']);
        $db->setField("email", $datos['email']);
        $db->setField("tlf", $datos['tlf']);
        $db->setField("usuario", $datos['usuario']);
        $db->setField("clave", md5($datos['clave']));
        $db->setField("activo", $datos['activo']);

        $edificios = $_POST['select']; ////en este caso porque viene un array de javascript

        $db->begin_transacction();
        $db->insertInTo();

        $adminId = $db->getLastId();

        /////por toda la lista de edificios seleccionada

        if (count($edificios) > 0) {

            $db->setTable("tbl_edif_adm");
            $db->setField("admin_id", $adminId);

            foreach ($edificios as $value) {

                echo $value;
                $db->setField("edif_id", $value);
                $db->insertInTo(false);
            }
        }

        $db->commit_transacction();

        $db->close();

        Security::unsetSessionVar("DATADMIN");

        die();
    } else if ($operacion == "edit") { /// en caso de edit    
        $datos = Security::getSessionVar("DATADMIN"); ///datos del admin
        $db->setField("franquicia_id", $datos['franquicia']);
        $db->setField("nombre", $datos['nombre']);
        $db->setField("email", $datos['email']);
        $db->setField("tlf", $datos['tlf']);
        $db->setField("usuario", $datos['usuario']);

        //////viendo si hay que reemplazarla clave
        $db->getTableFields("clave", "id = {$datos['admin']} "); ///cifrar clave
        $clave2 = $db->getField("clave");
        if ($clave2 != $datos['clave'])
            $db->setField("clave", md5($datos['clave']));
        /////////////////////////////

        $db->setField("activo", $datos['activo']);

        $edificios = $_POST['select']; ////en este caso porque viene un array de javascript


        $db->begin_transacction();
        $db->updateWhere("id = {$datos['admin']} ");

        ////borrando la lista de edificios
        $db->setTable("tbl_edif_adm");
        $db->deleteWhere("admin_id = {$datos['admin']}");

        if (count($edificios) > 0) {

            $db->setField("admin_id", $datos['admin']);
            foreach ($edificios as $value) {

                echo $value;
                $db->setField("edif_id", $value);
                $db->insertInTo(false);
            }
        }

        $db->commit_transacction();


        $db->close();

        Security::unsetSessionVar("DATADMIN");
        echo '<h4 class="alert_success">Edición efectuada con éxito</h4>';

        die();
    } else { //mostrar lista con el id de la franquicia
        $db->setSql(FactoryDao::adminEdifList((Security::getFranquiciaID() > 0 ? Security::getFranquiciaID() : 0)));
        $db->executeQuery();

        $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin edificio';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/admin_list.php', array("lista" => $db));
        View::do_dump(LAYOUT_PATH . 'layout.php', $data);
    }

    $db->close(); //cierra la base de datos
}