<form method="POST" action="/PHP_Review/Public/tasks">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Csrf::generateToken()); ?>" />

    <input
            type="text"
            name="title"
            value="<?php echo htmlspecialchars($_POST['title'] ?? '') ?>"
    />

    <input
            type="text"
            name="description"
            value="<?php echo htmlspecialchars($_POST['description'] ?? '') ?>"
    />

    <input type="submit" value="Create" />
</form>

<?php
    if (isset($errors)){
        foreach ($errors as $error){
            echo $error;
            echo "<br />";
        }
    }
?>