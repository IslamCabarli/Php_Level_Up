<h1>Task Page</h1>

<?php

foreach ($tasks as $t) {
    echo "<li>" . $t['title']  . " ==>" .  $t['description'] . "</li>";
}