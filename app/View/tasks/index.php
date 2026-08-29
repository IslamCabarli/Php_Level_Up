<h1>Task Page</h1>

<?php

foreach ($tasks as $t) {
    $id = $t['id'];
    echo "<li>" . $t['title'] . " ==>" . $t['description'] . "  ";


?>

    <form method="POST" action="/PHP_Review/Public/tasks/delete/<?=$id; ?>"
            style="display: inline;"
    >
        <input
                type="hidden"
                name="csrf_token"
                value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>"
        >
        <button type="submit">DELETE</button>

    </form>

    <?php
    echo "</li>";

    echo      "<a href='/PHP_Review/Public/tasks/edit/$id'>" . "UPDATE" . "</a>" . "</li>";

    echo "<br>";
    echo "<br>";
}
?>

    <a href='/PHP_Review/Public/tasks/create'>NEW TASK</a>