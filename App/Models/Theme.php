<?php

namespace App\Models;

class Theme extends Model{
    public string $sql = "";

    public function getThemes():array {
        /*** REQUEST THEMES ***/
        $sqlReq = "SELECT * FROM theme";

        self::setSql($sqlReq);

        $query  = self::$connection->query(self::getSql());
        return $query->fetchAll();
    }

    public function getListThemes():array {
        $sqlReq = "SELECT c.id_task, c.id_theme, th.theme_name
        FROM task t
            JOIN contain c USING (id_task)
            JOIN theme th USING (id_theme)
        WHERE t.id_task = c.id_task AND c.id_theme = th.id_theme
        ORDER BY t.id_task";

        self::setSql($sqlReq);

        $query  = self::$connection->query(self::getSql());
        return $query->fetchAll();
    }
}

?>