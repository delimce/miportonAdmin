<?php

function _datos() {

    Security::sessionActive();

    $data['siteTitle'] = 'Editar datos';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'cuenta/datos_view.php');
    View::do_dump(LAYOUT_PATH . 'layout.php', $data);
}