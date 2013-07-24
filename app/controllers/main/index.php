<?php

function _index() {

    Security::sessionActive();

    
     if(!Security::isSessionActive())
         Front::redirect ("main/login");


    $data['siteTitle'] = 'Mi Porton [Administración]';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'main/index_view.php');
    View::do_dump(LAYOUT_PATH . 'layout1.php', $data);
}