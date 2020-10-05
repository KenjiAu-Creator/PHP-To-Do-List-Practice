<?php
session_start();                  // Start the session.
include './includes/Filter.php';

if (!empty($_POST["new-to-do"]))  // Make sure that the request is not empty.
{
  if (!$_SESSION["to-do-list"])   // If the to-do-list doesn't initialize.
  {
    $toDoList = [];
  } else {
    $toDoList = $_SESSION["to-do-list"];      // If the to-do-list exists, access it.
  }
  if ( Filter($_POST["new-to-do"]))
  {
    array_push($toDoList, $_POST["new-to-do"]); // Add to the to-do-list.
    $_SESSION["to-do-list"] = $toDoList;        // Update the session variable.
  }
  else
  {
    echo '<script>alert("Special characters are not allowed in tasks!")</script>';
  }
};
/*=================================*/
/*      Active To Do's List        */
/*=================================*/
if (
  !empty($_POST["new-complete"])        // Make sure that the button request is not empty.
  || $_POST["new-complete"] === "0"     // the empy function considers "0" / 0 as empty.
) {
  if (!$_SESSION["completed-to-dos"])   // If the to-do-list isn't initialized.
  {
    $completeToDo = [];
  } else                                // If the completed list exists access it.
  {
    $completeToDo = $_SESSION["completed-to-dos"];
  }

  $completedItem = $_SESSION["to-do-list"][$_POST["new-complete"]]; // Grab the completed item.
  // Thank you to Lindsey Graham for showing the unset command.
  unset($_SESSION["to-do-list"][$_POST["new-complete"]]);           // Remove the action from the actives list.
  array_push($completeToDo, $completedItem);                        // Add to the completed list.
  $_SESSION["completed-to-dos"] = $completeToDo;                    // Update the completed list.
}
/*=================================*/
/*         Remove Button           */
/*=================================*/
if (isset($_POST["remove-item"]))                         // If the key for an item to be removed is sent.
{
  unset($_SESSION["to-do-list"][$_POST["remove-item"]]);  // Remove that index from the To-Do List.
}
/*=================================*/
/*         Reset Button            */
/*=================================*/
if (isset($_POST["reset"]))         // If a reset input is sent.
{
  // $_SESSION["to-do-list"] = [];  // Hard code for resetting session data.
  // $_SESSION["completed-to-dos"] = [];

  // session_destroy();             // Session destroy will destory the data but keep the existing sesssion.
  session_unset();                  // Session unset will unset the current session and destroy the data.
}
?>

<?php include './templates/header.php'; ?>

<body>
  <div id="notepad">
    <h1>What do you want to accomplish?</h1>
    <h2>Add a Task</h1>
      <form method="POST" action="index.php">
        <label for="new-to-do-item">
          <input type="text" id="new-to-do-item" name="new-to-do" required=true;>
        </label>
        <input type="submit" value="Add Item" />
      </form>

      <section id="active-to-do">
        <h2>Active Tasks</h2>
        <?php if (isset($_SESSION['to-do-list'])) : ?>
          <?php foreach ($_SESSION['to-do-list'] as $key => $toDoItem) :
            // Thank you to Lindsey Graham for giving advice to use buttons instead of checkbox input
          ?>
            <form class="active-form" method="POST" action="index.php">
              <button class="active-button" name="new-complete" value=<?php echo $key ?>><i class="far fa-check-square"></i></button>
              <button class="active-button" name="remove-item" value=<?php echo $key ?>><i class="far fa-trash-alt"></i></button>
              <span class="active-label"><?php echo $toDoItem ?></span>
            </form>
          <?php endforeach ?>
        <?php endif ?>
      </section>

      <h2>Completed Tasks</h2>
      <?php if (isset($_SESSION['completed-to-dos'])) : ?>
        <?php foreach ($_SESSION['completed-to-dos'] as $toDoItem) : ?>
          <p class="complete"><?php echo $toDoItem ?></p>
        <?php endforeach ?>
      <?php endif ?>

      <form method="POST" action="index.php">
        <button id="reset-button" name="reset" value="reset">Reset List</button>
      </form>

      <?php
      //  Debugging variables. Delete when finished or comment out.
      ?>
      <!-- <h2>Debugging</h2>
      <?php var_dump($_SESSION); ?>
      <?php var_dump($_POST); ?>
      <?php var_dump($test); ?> -->
  </div>
</body>

</html>