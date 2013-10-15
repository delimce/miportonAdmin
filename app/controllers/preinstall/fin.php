<?php

function _fin() {

    $data['siteTitle'] = 'Fin del registro';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'preinstall/fin.php');
    View::do_dump(LAYOUT_PATH . 'layoutPreinstall.php', $data);
}

?>
