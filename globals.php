<?php

try {
    $dbCo = new PDO( 'mysql:host=localhost;dbname=list_task;charset=utf8', 'xloadx', 'r86bs9kp' );
    $dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::FETCH_ASSOC);
}
catch (Exception $e) {
    die("Unable to connect to the database.".$e->getMessage());
}

$footer = '
    <footer class="footer">&copy; 2022 - Yann / Wildo</footer>
    <script src="js/script.js"></script>
</body>
</html>';

$color = [ "f7d9d9", "dad9f7", "e0f7d9", "f7f7d9", "f7e9d9", "eed9f7", "f7d9f6", "d9f7f7" ];

?>