<?php

function _login() {

    $user = Form::getVar("user", $_POST);
    ////logueandose
    if (!empty($user)) {

        $db = new ObjectDB();

        $pass = Form::getVar("clave", $_POST);

        $db->setSql(FactoryDao::getLoginData($user, $pass));
        $db->getResultFields();

        if ($db->getNumRows() > 0) {

            ////guardando variables de sesion 
            Security::setUserID($db->getField("id"));
            Security::setUserName($db->getField("nombre"));
            Security::setUserProfileName($db->getField("profile"));
            $id = $db->getField("id");

            $db->begin_transacction();

            /////en caso de que no sea admin
            if ($db->getField("profile") == "distri") { ////obteniendo el id de franquicia
                $db->setTable("tbl_distribuidor");
                $db->setFields("franquicia_id", "id = $id ");
                $db->getResultFields();
                Security::setFranquiciaID($db->getField("franquicia_id"));
            } else if ($db->getField("profile") == "edificio") { ///obteniendo el id del edificio
                $db->setTable("tbl_edificio_admin");
                $db->setFields("franquicia_id", "id = $id ");
                $db->getResultFields();
                Security::setFranquiciaID($db->getField("franquicia_id"));
            }

            /////////////
            ////registro de acceso
            $db->setTable("tbl_accesos_log");
            $db->setField("user", Security::getUserID());
            $db->setField("perfil", Security::getUserProfileName());
            $fecha = Calendar::getDatabaseDateTime();
            $db->setField("fecha", $fecha);
            $cliente = $_SERVER['HTTP_USER_AGENT'];
            $db->setField("cliente_info", $cliente);
            $db->insertInTo();

            $db->commit_transacction();

            echo $id;

            //////
        } else {
            echo 0;
        }


        $db->close(); //cerrando conexion
    } else { ///no se ha logueado
        $form = new Form();

        $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Login';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'main/login_form.php');
        View::do_dump(LAYOUT_PATH . 'loginLayout.php', $data);
    }
}