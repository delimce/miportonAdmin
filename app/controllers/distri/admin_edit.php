<?php

function _admin_edit($id = false) {

    Security::hasPermissionTo("admin,distri");

    $nombre = Form::getVar("r0nombre", $_POST); ///envio del usuario

    if (empty($nombre)) {


        $db2 = new ObjectDB();
        $db2->setTable("tbl_edificio_admin");
        $franquicia = Security::getFranquiciaID(); ///para validar por franquicia
        if ($franquicia != "")
            $where = "and franquicia_id = $franquicia";
        $db2->getTableFields("*", "id = $id $where");
        $db2->close();

        ////validando que muestre el modulo cuando existan registros
        if ($db2->getNumRows() == 0)
            Front::redirect("distri/admin");


        $db = new ObjectDB();
        ////traer combo de franquicias
        $db->setTable("tbl_franquicia");
        $db->getTableAllRecords("id,nombre", false, "nombre");
        $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", false, $db2->getField("franquicia_id"));
        $visualiza = (Security::getFranquiciaID() == "") ? 'inherit' : 'none';
        
        
    } else { ////segundo paso de la insercion
        $franquicia = Form::getVar("r0franquicia_id", $_POST);
        $email = Form::getVar("r0email", $_POST);
        $tlf = Form::getVar("r0tlf", $_POST);
        $usuario = Form::getVar("r0usuario", $_POST);
        $clave = Form::getVar("clave", $_POST);
        $activo = Form::getVar("r0activo", $_POST);
        $id = Form::getVar("id", $_POST);


        ///datos temporales
        $adminTemp = array(
            "franquicia" => $franquicia,
            "nombre" => $nombre,
            "email" => $email,
            "tlf" => $tlf,
            "usuario" => $usuario,
            "clave" => $clave,
            "activo" => $activo,
            "admin" => $id
        );

        Security::setSessionVar("DATADMIN", $adminTemp); ///datos del administrador

        die(); ///terminando
    }


    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Nuevo Admin edificio';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/admin_edit.php', array("datos" => $db2, "franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}