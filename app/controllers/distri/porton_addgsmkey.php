<?php

function _porton_addgsmkey($id = false) {

    Security::hasPermissionTo("admin,distri");

    $db2 = new ObjectDB();
    $db2->setSql(FactoryDao::portonGetById($id, (Security::getFranquiciaID() > 0 ? Security::getFranquiciaID() : 0)));
    $db2->getResultFields();
    $db2->close();

    //////////////
    ////validando que muestre el modulo cuando existan registros
    if ($db2->getNumRows() == 0)
        Front::redirect("distri/porton");

    ////traer combo de franquicias
    $db = new ObjectDB();
    ////combo de franquicia
    $db->setTable("tbl_franquicia");
    $db->getTableAllRecords("id,nombre", false, "nombre");
    $franquicia = Form::dbComboBox("r0franquicia_id", $db, "nombre", "id", false, $db2->getField("franquicia_id"));

    ////para presentar el combo de clientes y edificio
    $where = 'franquicia_id = ' . $db2->getField("franquicia_id");


    $visualiza = (Security::getFranquiciaID() == "") ? 'inherit' : 'none';

    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Agregar gsm-key a Porton';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'distri/porton_addgsmkey.php', array("datos" => $db2, "franquicia" => $franquicia, "visual" => $visualiza));
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}