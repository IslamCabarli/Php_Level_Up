<?php
    $id = $task['id'];
?>

<form method="POST" action="/PHP_Review/Public/tasks/update/<?php echo $id; ?>">

    <input
            type="text"
            name="title"
            value="<?php echo htmlspecialchars($task['title']); ?>"
    />

    <input
            type="text"
            name="description"
            value="<?php echo htmlspecialchars($task['description']); ?>"
    />

    <input type="submit" value="Update" />

</form>
