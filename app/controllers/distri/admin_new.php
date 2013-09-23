<?php

function _admin_new() {

    Security::hasPermissionTo("admin,distri");


    $nombre = Form::getVar("r0nombre", $_POST); ///envio del usuario

    if (empty($nombre)) {

        $db = new ObjectDB();
        ////traer combo de franquicias
        $db->setTable("tbl_franquicia");
        $db->getTableAllRecords("id,nombre", false, "nombre");
        $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", false, Security::getFranquiciaID());
        $visualiza = (Security::getFranquiciaID() == "") ? 'inherit' : 'none';
    } else { ////segundo paso de la insercion
        $franquicia = Form::getVar("r0franquicia_id", $_POST);
        $email = Form::getVar("r0email", $_POST);
        $tlf = Form::getVar("r0tlf", $_POST);
        $usuario = Form::getVar("r0usuario", $_POST);
        $clave = Form::getVar("clave", $_POST);
        $activo = Form::getVar("r0activo", $_POST);


        ///datos temporales
        $adminTemp = array(
            "franquicia" => $franquicia,
            "nombre" => $nombre,
            "email" => $email,
            "tlf" => $tlf,
            "usuario" => $usuario,
            "clave" => $clave,
            "activo" => $activo,
        );

        Security::setSessionVar("DATADMIN", $adminTemp); ///datos del administrador
        
         die(); ///terminando

    }


    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Nuevo Admin edificio';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/admin_new.php', array("franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}