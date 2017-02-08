<?php
require_once('../../../private/initialize.php');

// Set default values for all variables the page needs.
$errors = array();
$user = array(
  'first_name' => '',
  'last_name' => '',
  'username' => '',
  'email' => ''
);

if(is_post_request()) {

  // Confirm that values are present before accessing them.
  if(isset($_POST['first_name'])) { $user['first_name'] = h($_POST['first_name']); }
  if(isset($_POST['last_name'])) { $user['last_name'] = h($_POST['last_name']); }
  if(isset($_POST['username'])) { $user['username'] = h($_POST['username']); }
  if(isset($_POST['email'])) { $user['email'] = h($_POST['email']); }
  //Check uniqueness of username
  if(!insert_uniqueness($db,$user)){
    $errors[] = "Username has been used.";
  }
  else{
    $result = insert_user($user);
    if($result === true) {
      $new_id = db_insert_id($db);
      redirect_to('show.php?id=' . u($new_id));
    } else {
      $errors = $result;
    }
  }
}
?>
<?php $page_title = 'Staff: New User'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Users List</a><br />

  <h1>New User</h1>

  <?php echo display_errors($errors); ?>

  <form action="new.php" method="post">
    First name:<br />
    <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" /><br />
    Last name:<br />
    <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" /><br />
    Username:<br />
    <input type="text" name="username" value="<?php echo $user['username']; ?>" /><br />
    Email:<br />
    <input type="text" name="email" value="<?php echo $user['email']; ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Create"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
