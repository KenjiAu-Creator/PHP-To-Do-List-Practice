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
/*=================================*/
/*      Active To Do's List        */
/*=================================*/
if (!empty($_POST["new-complete"])        // Make sure that the button request is not empty.
    || $_POST["new-complete"] === "0")    // the empy function considers "0" / 0 as empty.
{                                             
  if (!$_SESSION["completed-to-dos"]) {   // If the to-do-list isn't initialized.
    $completeToDo = [];
  }
  else {
    $completeToDo = $_SESSION["completed-to-dos"];  // If the completed list exists access it.
  }

  $completedItem = $_SESSION["to-do-list"][$_POST["new-complete"]]; // Grab the completed item.
  // Thank you to Lindsey Graham for showing the unset command.
  unset($_SESSION["to-do-list"][$_POST["new-complete"]]);           // Remove the action from the actives list.
  array_push($completeToDo, $completedItem);                        // Add to the completed list.
  $_SESSION["completed-to-dos"] = $completeToDo;                    // Update the completed list.
}

if (isset($_POST["reset"])) {
  // $_SESSION["to-do-list"] = [];  // Hard code for resetting session data.
  // $_SESSION["completed-to-dos"] = [];

  // session_destroy();             // Session destroy will destory the data but keep the existing sesssion.
  session_unset();                  // Session unset will unset the current session and destroy the data.
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
        <form class="active-form" method="POST" action="index.php">
          <button class="active-button" name="new-complete" value=<?php echo $key ?>>Task Complete</button><span class="active-label"><?php echo $toDoItem ?></span>
        </form>
        <?php endforeach ?>
      <?php endif ?>
    </section>

    <h2>Completed To-Dos</h2>
    <?php if (isset($_SESSION['completed-to-dos'])) : ?>
      <?php foreach ($_SESSION['completed-to-dos'] as $toDoItem) : ?>
        <p class="complete"><?php echo $toDoItem ?></p>
      <?php endforeach ?>
    <?php endif ?>

    <form method="POST" action="index.php">
      <button id="reset-button" name="reset" value="reset">Reset List</button>
    </form>

    <h2>Debugging</h2>
    <?php var_dump($_SESSION); ?>
    <?php var_dump($_POST); ?>
    <?php var_dump($test); ?>
</body>

</html>