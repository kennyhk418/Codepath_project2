<?php
require_once('../../../private/initialize.php');
?>
<?php $page_title = 'Staff: New Country'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
$errors = array();
$country = array(
    'name' => '',
    'code' => '',
    'country_id' => ''
);

if(is_post_request()){
    if(isset($_POST['name'])){$country['name'] = h($_POST['name']);}
    if(isset($_POST['code'])){$country['code'] = h($_POST['code']);}
    $result = insert_country($country);
    if($result===true){
        $new_id = db_insert_id($db);
        redirect_to('show.php?id='.u($new_id));
    } else{
        $errors = $result;
    }
}

?>

<div id="main-content">
  <a href="./index.php">Back to States List</a><br />

  <h1>New Country</h1>
  <?php echo display_errors($errors);?>
  <!-- TODO add form -->
  <form action = "new.php" method = "post">
    Country Name:<br>
    <input type = "text" name = "name" value = "<?php echo $country['name']; ?>"><br>
    Code:<br>
    <input type = "text" name = "code" value = "<?php echo $country['code']; ?>"><br>
    <input type = "submit" name = "submit" value = "Create">
  </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
