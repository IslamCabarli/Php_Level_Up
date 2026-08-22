
<form method="Post" action="/PHP_Review/Public/tasks">
    <input type="text" name="title" value="<?php echo $_POST['title'] ?? '' ?>" />
    <input  type="text"  name="description" value="<?php echo $_POST['description'] ?? '' ?>" />
    <input type="submit" />
</form>
<?php
    if(isset($error)){
        echo $error;
    }
?>


