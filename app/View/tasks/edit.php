

<?php
        $id = $task['id'];
        ?>
        <form method="Post" action="/PHP_Review/Public/tasks/update">
            <input type="hidden" name="id" value="<?php echo $id;?>" />
            <input type="text" name="title" value="<?php echo $task['title'] ?>" />
            <input  type="text"  name="description" value="<?php echo $task['description'] ?>"  />
            <input type="submit" />
        </form>

