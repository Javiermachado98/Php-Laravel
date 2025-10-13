<?php
// parte 6. cookie y color oscuro
setcookie('preferencia_tema', 'oscuro',time() + (86400 * 30),"/");
echo "Hola color";

$tema = $_COOKIE['preferencia_tema'] ?? 'claro';
?>