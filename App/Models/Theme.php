<?php

namespace App\Models;

class Theme extends Model{

    public function getThemes():array {
        /*** REQUEST THEMES ***/
        $sqlReq = "SELECT * FROM theme";

        $query  = self::$connection->query($sqlReq);
        return $query->fetchAll();
    }

    public function getListThemes():array {
        $sqlReq = "SELECT c.id_task, c.id_theme, th.theme_name
        FROM task t
            JOIN contain c USING (id_task)
            JOIN theme th USING (id_theme)
        WHERE t.id_task = c.id_task AND c.id_theme = th.id_theme
        ORDER BY t.id_task";

        $query  = self::$connection->query($sqlReq);
        return $query->fetchAll();
    }
}

?>