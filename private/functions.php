<?php

  function h($string="") {
    return htmlspecialchars($string);
  }

  function u($string="") {
    return urlencode($string);
  }

  function raw_u($string="") {
    return rawurlencode($string);
  }

  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  function display_errors($errors=array()) {
    $output = '';
    if (!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach ($errors as $error) {
        $output .= "<li>{$error}</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }

  // Custom helper function to format phone number
  function format_phone_num($value){
    $phone_num = str_replace("(","",$value);
    $phone_num = str_replace(")","",$phone_num);
    $phone_num = str_replace("-","",$phone_num);
    $phone_num = substr($phone_num,0,3)."-".substr($phone_num,3,3)."-".substr($phone_num,6);
    return $phone_num;
  }

  function insert_uniqueness($connection, $user){
    $unique_sql = "Select * from users where username = '" . $user['username'] . "';";
    $current_id = db_query($connection,$unique_sql);
    if (db_num_rows($current_id) > 0){
      return false;
    }
    return true;
  }

  function update_uniqueness($connection, $user){
    $unique_sql = "Select * from users where username = '" . $user['username'] . "';";
    $exe_sql = db_query($connection,$unique_sql);
    $current_user = db_fetch_assoc($exe_sql);
    if(is_null($current_user)){
      return true;
    }
    elseif ((int)$user['id'] != (int)$current_user['id']){
      return false;
    }
    return true;
  }
?>
