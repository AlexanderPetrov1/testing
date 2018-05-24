<?php

/*
 * опишите что этот запрос делает, и можно ли его улучшить
 * заметьте - это Postgresql - предположительно не знакомая вам база данных и вам нужно почитать документацию прежде чем ответить
 */

    $sql = "UPDATE reviews AS r SET (status, chtime)=(1, NOW())

        WHERE (SELECT sub.match

        FROM (SELECT (reviews.*)=(r.*) AS match

        FROM items AS i

        LEFT JOIN reviews ON reviews.id_item = i.id 

        WHERE item.id=222) AS sub)";

/*
 * Обновляет строки в таблице reviews и устанавливает status 1 и chtime - текущее время для тех строк,
 * которые имеют id_item = 222
 *
 * Упростить можно следующим образом:
 * $sql = "UPDATE reviews AS r SET (status, chtime)=(1, NOW()) where id_item = 222
 *
 */


print_r($sql . '<br /><br />');

print_r("Обновляет строки в таблице reviews и устанавливает status 1 и chtime - текущее время для тех строк, которые имеют id_item = 222<br /><br />");

print_r("Упростить можно следующим образом:<br />");
print_r('$sql = "UPDATE reviews AS r SET (status, chtime)=(1, NOW()) where id_item = 222"');
