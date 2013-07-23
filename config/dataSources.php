<?php
/**
 * Created by IntelliJ IDEA.
 * User: delimce
 * Date: 7/24/12
 * Time: 10:31 AM
 * To change this template use File | Settings | File Templates.
 */

$dataSources = array();


////estructura de conexion 1
/*
 * deben crearse tantas estructuras como datasource se requieran manejar
 */
$dt1 = array("dbms" => "Mysql",
    "host" => "70.87.90.34",
    //  "port" => "3306",
    //  "schema" => "prueba",
    "database" => "curs0net_ucdb",
    "user" => "curs0net_delimce",
    "pwd" => "copetona1384",
);

////otro dataSource

$dt2 = array("dbms" => "Mysql",
    "host" => "50.56.209.170",
    //  "port" => "3306",
    //  "schema" => "prueba",
    "database" => "jmacta",
    "user" => "jmatca",
    "pwd" => "Hfpyopwebvs",
);


////asignacion
$dataSources["uc"] = $dt1;
$dataSources["lamerienda"] = $dt2;


