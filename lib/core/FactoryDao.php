<?php

/**
 * Created by IntelliJ IDEA.
 * User: delimce
 * Date: 7/18/12
 * Time: 9:52 PM
 * To change this template use File | Settings | File Templates.
 */
class FactoryDao {


/**
 * para hacer login de usuario al iniciar programa
 * @param type $user
 * @param type $pass
 * @return type
 */
    static public function getLoginData($user, $pass) {

        return "call sp_login('$user', '$pass')";
    }

    static public function getModuleAccess($modulo, $usuario, $cuenta) {

        return "call sp_verificar_permiso($modulo,$usuario,$cuenta)";
    }

    static public function getUsersList($myId = false) {

        $query = "SELECT
                u.id,
                u.nombre,
                u.email,
                u.telefono1,
                u.user,
                u.password,
                u.perfil_id,
                p.nombre AS perfil,
                u.activo
                FROM
                tbl_usuario AS u
                INNER JOIN tbl_perfil AS p ON u.perfil_id = p.id
                where u.borrado=0";

        if ($myId)
            $query.= " and u.id = $myId";
        else
            $query.= " and u.id != " . Security::getUserID();

        $query.=" order by u.nombre";

        return $query;
    }

    static public function getProfiles() {

        return "select id,nombre from tbl_perfil order by nombre desc";
    }

    static public function getModuleIds($perfilId) {

        return "SELECT
                    m.id
                    FROM
                    tbl_perfil AS p
                    INNER JOIN tbl_perfil_modulo AS pm ON pm.perfil_id = p.id
                    INNER JOIN tbl_modulo AS m ON m.id = pm.modulo_id
                    WHERE
                    p.id = $perfilId ";
    }

    static public function getModuleList($userId = false, $cuentaId = false) {

        if ($userId) {

            $query = "SELECT
                        m.nombre,
                        m.id,
                        ifnull((select 1 from tbl_permiso where modulo_id = m.id and cuenta_id = $cuentaId and usuario_id = $userId),0) as per
                        FROM
                        tbl_modulo m";
        } else {

            $query = "SELECT m.id,m.nombre,m.descripcion FROM tbl_modulo m order by orden";
        }

        return $query;
    }

    static public function getModuleListLobi() {

        $userid = Security::getUserID();
        $cuentaid = Security::getCuentaID();

        return "call sp_usuario_modulos($userid,$cuentaid)";
    }

  

    /*
     * funciones para fechas consulta y grabacion 
     */

    public static function getCurrentdate() {

        $idcuenta = Security::getCuentaID();
        return "fc_fecha_actual($idcuenta) ";
    }

}
