<?php

function _vars_new() {

    Security::hasPermissionTo("admin");


    $data['siteTitle'] = Security::getSessionVar("TITTLE") . 'Admin Variables SMS';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'admin/vars_new.php');
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}