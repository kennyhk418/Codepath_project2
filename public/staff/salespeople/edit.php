<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$salespeople_result = find_salesperson_by_id(raw_u($_GET['id']));
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);
?>

<?php
$errors = array();
if(is_post_request()){
    if(isset($_POST['first_name'])){$salesperson['first_name'] = h($_POST['first_name']);}
    if(isset($_POST['last_name'])){$salesperson['last_name'] = h($_POST['last_name']);}
    if(isset($_POST['phone'])){$salesperson['phone'] = h($_POST['phone']);}
    if(isset($_POST['email'])){$salesperson['email'] = h($_POST['email']);}
    $result = update_salesperson($salesperson);
    if($result === true){
        redirect_to('show.php?id='.u($salesperson['id']));
    } else{
        $errors = $result;
    }
}
?>

<?php $page_title = 'Staff: Edit Salesperson ' . $salesperson['first_name'] . " " . $salesperson['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="./index.php">Back to Salespeople List</a><br />

  <h1>Edit Salesperson: <?php echo $salesperson['first_name'] . " " . $salesperson['last_name']; ?></h1>

  <!-- TODO add form -->
<?php echo display_errors($errors);?>
<form action = "edit.php?id=<?php echo u($salesperson['id']); ?>" method="post">
    First name:<br>
    <input type = "text" name = "first_name" value = "<?php echo $salesperson['first_name'];?>"/><br>
    Last name:<br>
    <input type = "text" name = "last_name" value = "<?php echo $salesperson['last_name'];?>"/><br>
    Phone:<br>
    <input type = "text" name = "phone" value = "<?php echo $salesperson['phone']; ?>" /><br>
    Email:<br>
    <input type = "text" name = "email" value = "<?php echo $salesperson['email']; ?>" /><br>
    <input type = "submit" name="submit" value="Update"/>
</form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
