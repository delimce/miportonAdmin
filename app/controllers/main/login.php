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

                echo $db->getField("id");

                //////
            } else {
                echo 0;
            }
       

        $db->close(); //cerrando conexion
    } else { ///no se ha logueado
        $form = new Form();

        $data['siteTitle'] = 'MiPorton.net   ';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'main/login_form.php');
        View::do_dump(LAYOUT_PATH . 'loginLayout.php', $data);
    }
}