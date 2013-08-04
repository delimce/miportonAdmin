<?php

function _franquicia_new() {

    Security::hasPermissionTo("admin");


    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Franquicias';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/franq_new.php');
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}