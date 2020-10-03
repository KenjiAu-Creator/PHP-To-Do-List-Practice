<?php
session_start();                              // Start the session.

if (!empty($_POST["new-to-do"])) {            // Make sure that the request is not empty.
  if (!$_SESSION["to-do-list"]) {             // If the to-do-list doesn't initialize.
    $toDoList = [];
  } else {
    $toDoList = $_SESSION["to-do-list"];      // If the to-do-list exists, access it.
  }
  array_push($toDoList, $_POST["new-to-do"]); // Add to the to-do-list.
  $_SESSION["to-do-list"] = $toDoList;        // Update the session variable.
};

// The active To Do's list 
if (!empty($_POST["new-complete"]) || $_POST["new-complete"] === "0") {  // Make sure that the button request is not empty.
  if (!$_SESSION["completed-to-dos"]) {       // If the to-do-list isn't initialized
    $completeToDo = [];
  }
  else {
    $completeToDo = $_SESSION["completed-to-dos"];  // If the completed list exists access it.
  }

  $completedItem = $_SESSION["to-do-list"][$_POST["new-complete"]];  // Add to the completed list.
  array_push($completeToDo, $completedItem);
  
  $_SESSION["completed-to-dos"] = $completeToDo;  // Update the completed to-dos list.
}
?>

<?php include './templates/header.php'; ?>
<body>
  <h1>PHP To Do List</h1>
  <h2>Add a To-Do</h1>
    <form method="POST" action="index.php">
      <label for="new-to-do-item">
        <input type="text" id="new-to-do-item" name="new-to-do" required=true;>
      </label>
      <input type="submit" value="Add Item" />
    </form>

    <section id="active-to-do">
      <h2>Active To-Dos</h2>
      <?php if (isset($_SESSION['to-do-list'])) : ?>
        <?php foreach ($_SESSION['to-do-list'] as $key=>$toDoItem) : 
          // Thank you to Lindsey Graham for giving advice to use buttons instead of checkbox input
        ?>
        <form method="POST" action="index.php">
          <button name="new-complete" value=<?php echo $key ?>><?php echo $toDoItem ?></button>
        </form>
        <?php endforeach ?>
      <?php endif ?>
    </section>

    <h2>Completed To-Dos</h2>
    <?php if (isset($_SESSION['completed-to-dos'])) : ?>
        <?php foreach ($_SESSION['completed-to-dos'] as $toDoItem) : ?>
          <p><?php echo $toDoItem ?></p>
        <?php endforeach ?>
      <?php endif ?>

    <h2>Debugging</h2>
    <?php var_dump($_SESSION); ?>
    <?php var_dump($_POST); ?>
    <?php var_dump($completedItem); ?>
</body>

</html>