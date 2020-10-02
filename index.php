<?php
  // Start the session.
  session_start();

  if (!empty($_POST))
  { // Make sure that the request is not empty.
    if (!$_SESSION["to-do-list"])
    { // If the to-do-list doesn't initialize.
      $toDoList = [];
    }
    else
    { // If the to-do-list exists, access it.
      $toDoList = $_SESSION["to-do-list"];
    }
    // Add to the to-do-list.
    array_push($toDoList, $_POST["new-to-do"] );
    
    // Update the session variable.
    $_SESSION["to-do-list"] = $toDoList;
  };
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP To Do List</title>
</head>
<body>
  <h1>PHP To Do List</h1>
  <h2>Add a To-Do</h1>
  <form method="POST" action="index.php">
    <label for="new-to-do-item">
      <input type="text" id="new-to-do-item" name="new-to-do" required=true;>
    </label>
    <input type="submit" value="Add Item" />
  </form>

  <h2>Active To-Dos</h2>
  <?php if (isset($_SESSION['to-do-list'])) : ?>
    <?php foreach( $_SESSION['to-do-list'] as $toDoItem) : ?>
      <input type="checkbox" />
      <label><?php echo $toDoItem; ?></label>
    <?php endforeach ?>
  <?php endif ?>
  
  <h2>Completed To-Dos</h2>
  <h2>Debugging</h2>
  <?php var_dump($_SESSION); ?>
</body>
</html>