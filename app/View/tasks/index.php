<h1>Task Page</h1>

<?php

foreach ($tasks as $t) {
    $id = $t['id'];
    echo "<li>" . $t['title']  . " ==>" .  $t['description']  . "  " .
            "<a href='/PHP_Review/Public/tasks/delete?id=$id'>" ."DELETE" . "</a>" . "</li>" .
            "<a href='/PHP_Review/Public/tasks/edit?id=$id'>" . "UPDATE" . "</a>" . "</li>";

}