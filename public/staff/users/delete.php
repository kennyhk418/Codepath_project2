<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])){
    redirect_to('index.php');
}
$id = raw_u($_GET['id']);
$users_result = find_user_by_id($id);
$user = db_fetch_assoc($users_result);
?>

<?php
if(is_post_request()){
    if(isset($_POST['delete'])){
        delete_user($user);
        redirect_to("index.php");
    }
    elseif(isset($_POST['cancel'])){
        redirect_to("show.php?id=". $user['id']);
    }
}
?>

<?php $page_title = 'Staff: Edit User ' . $user['first_name'] . " " . $user['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Users List</a><br />

  <h1>Delete User: <?php echo $user['first_name'] . " " . $user['last_name']; ?></h1>

  <form action="delete.php?id=<?php echo u($user['id']); ?>" method="post">
    Are you sure you want to permanently delete the user:<br>
    <input type="submit" name="delete" value="Delete"  />
    <input type="submit" name="cancel" value="Cancel"/><br>
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
