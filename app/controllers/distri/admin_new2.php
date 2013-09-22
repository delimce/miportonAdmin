<?php

function _admin_new2() {

    Security::hasPermissionTo("admin,distri");

    $db = new ObjectDB();

    $datos = Security::getSessionVar("DATADMIN"); ///datos del admin

    ////estructura de edificios
    $db->setSql(FactoryDao::getEdifByFranquicia($datos['franquicia'], 0));
    $edificios = $db->getMatrixDb(); ///lista de edificios
    $db->close();

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Nuevo Admin edificio';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/admin_new2.php', array("edificios" => $edificios));
    $data['head'][] = '<script type="text/javascript" src="' . Front::myUrl('jscripts/jquery.fastLiveFilter.js') . '"></script>';;
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}