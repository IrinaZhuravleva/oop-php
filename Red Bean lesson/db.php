<?php


require 'libs/rb-mysql.php';
R::setup('mysql:host=localhost;dbname=school', 'root', 'root');

// Функция, запрещающая обновление данных в БД - нужна при работе сайта на продакшене, чтобы она не изменялась автоматически/динамически
// R::freeze( TRUE );

?>