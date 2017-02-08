<?php

  //
  // COUNTRY QUERIES
  //

  // Find all countries, ordered by name
  function find_all_countries() {
    global $db;
    $sql = "SELECT * FROM countries ORDER BY name ASC;";
    $country_result = db_query($db, $sql);
    return $country_result;
  }

  // Find country by ID
  function find_country_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM countries ";
    $sql .= "WHERE id='" . $id . "';";
    $country_result = db_query($db, $sql);
    return $country_result;
  }

  function validate_country($country, $errors=array()) {
    // TODO add validations
    if(is_blank($country['name'])){
      $errors[] = "Country cannot be blank.";
    }
    elseif(!has_length($country['name'],array('min'=>2, 'max'=>255))){
      $errors[] = "Country must be between 2 and 255 characters.";
    }
    //My custom validation: Only allow alphabets and space
    elseif(!preg_match('/\A[A-Za-z\s]+\Z/', $country['name'])){
      $errors[] = "Country must be in a valid format.";
    }

    if(is_blank($country['code'])){
      $errors[] = "Country Code cannot be blank.";
    }
    elseif(!has_length($country['code'],array('min'=>2, 'max'=>255))){
      $errors[] = "Country Code must be between 2 and 255 characters.";
    }
    //My custom validation: Only allow alphabets
    elseif(!preg_match('/\A[A-Za-z]+\Z/', $country['code'])){
      $errors[] = "Country Code must be in a valid format.";
    }

    return $errors;
  }

  // Add a new country to the table
  // Either returns true or an array of errors
  function insert_country($country) {
    global $db;

    $errors = validate_country($country);
    if (!empty($errors)) {
      return $errors;
    }

    //Sanitizing SQLI
    $name = db_escape($db,$country['name']);
    $code = db_escape($db,$country['code']);

    $sql = "INSERT INTO countries(name, code)";
    $sql .= "VALUES (";
    $sql .= "'" . $name . "',";
    $sql .= "'" . $code . "'";
    $sql .= ");";

    // TODO add SQL
    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a Country record
  // Either returns true or an array of errors
  function update_country($country) {
    global $db;

    $errors = validate_Country($country);
    if (!empty($errors)) {
      return $errors;
    }

    //Sanitizing SQLI
    $name = db_escape($db,$country['name']);
    $code = db_escape($db,$country['code']);

    $sql = "UPDATE countries SET ";
    $sql.= "name = '" .  $name . "',";
    $sql.= "code = '" . $code . "'";
    $sql.= "WHERE id = '". $country['id'] . "'";
    $sql.= "LIMIT 1;";
    // TODO add SQL
    // For update_country statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }


  //
  // STATE QUERIES
  //

  // Find all states, ordered by name
  function find_all_states() {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find all states, ordered by name
  function find_states_for_country_id($country_id=0) {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE country_id='" . $country_id . "' ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find state by ID
  function find_state_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE id='" . $id . "';";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  function validate_state($state, $errors=array()) {
    // TODO add validations
    if(is_blank($state['name'])){
      $errors[] = "State cannot be blank.";
    }
    elseif(!has_length($state['name'],array('min'=>2, 'max'=>255))){
      $errors[] = "State must be between 2 and 255 characters.";
    }
    //My custom validation: Only allow alphabets and space
    elseif(!preg_match('/\A[A-Za-z\s]+\Z/', $state['name'])){
      $errors[] = "State must be in a valid format.";
    }

    if(is_blank($state['code'])){
      $errors[] = "State Code cannot be blank.";
    }
    elseif(!has_length($state['code'],array('min'=>2, 'max'=>255))){
      $errors[] = "State Code must be between 2 and 255 characters.";
    }
    //My custom validation: Only allow alphabets
    elseif(!preg_match('/\A[A-Za-z]+\Z/', $state['code'])){
      $errors[] = "State Code must be in a valid format.";
    }

    if(is_blank($state['country_id'])){
      $errors[] = "State cannot be blank.";
    }
    elseif(!has_length($state['country_id'],array('min'=>1, 'max'=>11))){
      $errors[] = "State must be between 1 and 11 digits.";
    }
    //My custom validation: Only allow integer
    elseif(!preg_match('/\A[\d]+\Z/', $state['country_id'])){
      $errors[] = "State must be in a valid format.";
    }
    return $errors;
  }

  // Add a new state to the table
  // Either returns true or an array of errors
  function insert_state($state) {
    global $db;

    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }

    //Sanitizing SQLI
    $name = db_escape($db,$state['name']);
    $code = db_escape($db,$state['code']);
    $country_id = db_escape($db,$state['country_id']);

    $sql = "INSERT INTO states(name, code, country_id)";
    $sql .= "VALUES (";
    $sql .= "'" . $name . "',";
    $sql .= "'" . $code . "',";
    $sql .= "'" . $country_id . "'";
    $sql .= ");";

    // TODO add SQL
    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a state record
  // Either returns true or an array of errors
  function update_state($state) {
    global $db;

    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }

    //Sanitizing SQLI
    $name = db_escape($db,$state['name']);
    $code = db_escape($db,$state['code']);
    $country_id = db_escape($db,$state['country_id']);

    $sql = "UPDATE states SET ";
    $sql.= "name = '" .  $name . "',";
    $sql.= "code = '" . $code . "',";
    $sql.= "country_id = '" . $country_id . "' ";
    $sql.= "WHERE id = '". $state['id'] . "'";
    $sql.= "LIMIT 1;";
    // TODO add SQL
    // For update_state statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // TERRITORY QUERIES
  //

  // Find all territories, ordered by state_id
  function find_all_territories() {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "ORDER BY state_id ASC, position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find all territories whose state_id (foreign key) matches this id
  function find_territories_for_state_id($state_id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE state_id='" . $state_id . "' ";
    $sql .= "ORDER BY position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find territory by ID
  function find_territory_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE id='" . $id . "';";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  function validate_territory($territory, $errors=array()) {
    // TODO add validations
    if(is_blank($territory['name'])){
      $errors[] = "Territory name cannot be blank.";
    }
    elseif(!has_length($territory['name'], array('min'=>2, 'max'=>255))){
      $errors[] = "Territory name must be between 2 and 255 characters.";
    }
    //My custom validation: Only allow alphabets and space
    elseif(!preg_match('/\A[A-Za-z\s]+\Z/',$territory['name'])){
      $errors[] = "Territory name must be in valid format.";
    }

    if(is_blank($territory['position'])){
      $errors[] = "Territory position cannot be blank.";
    }
    elseif(!has_length($territory['position'], array('min'=>1, 'max'=>11))){
      $errors[] = "Territory position must be between 1 and 11 digits.";
    }
    //My custom validation: Only allow integers
    elseif(!preg_match('/\A[\d]+\Z/',$territory['position'])){
      $errors[] = "Territory position must be in valid format.";
    }
    return $errors;
  }

  // Add a new territory to the table
  // Either returns true or an array of errors
  function insert_territory($territory) {
    global $db;

    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    }

    //Sanitizing SQLI
    $name = db_escape($db,$territory['name']);
    $state_id = db_escape($db,$territory['state_id']);
    $position = db_escape($db,$territory['position']);

    $sql = "INSERT INTO territories(";
    $sql.= "name, state_id, position) ";
    $sql.= "VALUES (";
    $sql.= "'". $name ."',";
    $sql.= "'". $state_id ."',";
    $sql.= "'". $position ."');";

     // TODO add SQL
    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT territoryment failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a territory record
  // Either returns true or an array of errors
  function update_territory($territory) {
    global $db;

    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    }

    //Sanitizing SQLI
    $name = db_escape($db,$territory['name']);
    $state_id = db_escape($db,$territory['state_id']);
    $position = db_escape($db,$territory['position']);

    $sql = "UPDATE territories SET ";
    $sql.= "name = '". $name ."',";
    $sql.= "state_id = '". $state_id . "',";
    $sql.= "position = '". $position . "' ";
    $sql.= "WHERE id = '". $territory['id'] . "' ";
    $sql.= "LIMIT 1;";

     // TODO add SQL
    // For update_territory statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE territoryment failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // SALESPERSON QUERIES
  //

  // Find all salespeople, ordered last_name, first_name
  function find_all_salespeople() {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // To find salespeople, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same territory ID.
  function find_salespeople_for_territory_id($territory_id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (salespeople_territories.salesperson_id = salespeople.id) ";
    $sql .= "WHERE salespeople_territories.territory_id='" . $territory_id . "' ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // Find salesperson using id
  function find_salesperson_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "WHERE id='" . $id . "';";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  function validate_salesperson($salesperson, $errors=array()) {
    // TODO add validations
    if(is_blank($salesperson['first_name'])){
      $errors[] = "First name cannot be blank.";
    }
    elseif(!has_length($salesperson['first_name'], array('min'=>2, 'max'=>255))){
      $errors[] = "First name must be between 2 and 255 characters.";
    }//My custom validation: Allow only A-Z a-z , . - \ "space"
    elseif(!preg_match('/\A[A-Za-z\s\-\.\,\']+\Z/', $salesperson['first_name'])){
      $errors[] = "First name must be in a valid format.";
    }

    if(is_blank($salesperson['last_name'])){
      $errors[] = "Last name cannot be blank.";
    }
    elseif(!has_length($salesperson['last_name'], array('min'=>2, 'max'=>255))){
      $errors[] = "Last name must be between 2 and 255 characters.";
    }//My custom validation: Allow only A-Z a-z , . - \ "space"
    elseif(!preg_match('/\A[A-Za-z\s\-\.\,\']+\Z/', $salesperson['last_name'])){
      $errors[] = "Last name must be in a valid format.";
    }

    if(is_blank($salesperson['phone'])){
      $errors[] = "Phone number cannot be blank.";
    }
    //My custom validation: Only allow integers
    elseif(!preg_match('/\A[\d\-\(\)]+\Z/', $salesperson['phone'])){
      $errors[] = "Phone number must be in a valid format.";
    }
    //My custom validation: Allow only 10 digits(not including "()-")
    elseif(!has_valid_phone_length($salesperson['phone'])){
      $errors[] = "Phone number has to be 10 digits";
    }

    if(is_blank($salesperson['email'])){
      $errors[] = "Email cannot be blank.";
    }
    elseif(!has_length($salesperson['email'], array('min'=>2, 'max'=>255))){
      $errors[] = "Email must be between 2 and 255 characters.";
    }
    //My custom validation: Allow only A-Z a-z , . - \ "space"
    elseif(!has_valid_email_format($salesperson['email']) or !preg_match('/\A[A-Za-z\s\d\@\.\_\-]+\Z/', $salesperson['email'])){
      $errors[] = "Email must be in a valid format.";
    }
    return $errors;
  }

  // Add a new salesperson to the table
  // Either returns true or an array of errors
  function insert_salesperson($salesperson) {
    global $db;

    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {
      return $errors;
    }

    //Sanitizing SQLI
    $first_name = db_escape($db,$salesperson['first_name']);
    $last_name = db_escape($db,$salesperson['last_name']);
    $email = db_escape($db,$salesperson['email']);
    $phone_number = db_escape($db,$salesperson['phone_number']);

    //format phone number into xxx-xxx-xxxx
    $phone_number = format_phone_num($salesperson['phone']);

    $sql = "INSERT INTO salespeople (first_name, last_name, phone, email)
    VALUES ('". $first_name."',
     '". $last_name ."',
     '". $phone_number ."' ,
     '". $email ."');"; // TODO add SQL
     //For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a salesperson record
  // Either returns true or an array of errors
  function update_salesperson($salesperson) {
    global $db;

    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {
      return $errors;
    }

    //Sanitizing SQLI
    $first_name = db_escape($db,$salesperson['first_name']);
    $last_name = db_escape($db,$salesperson['last_name']);
    $email = db_escape($db,$salesperson['email']);
    $phone_number = db_escape($db,$salesperson['phone_number']);

    //format phone number into xxx-xxx-xxxx
    $phone_number = format_phone_num($salesperson['phone']);

    $sql = "UPDATE salespeople SET
    first_name='".$first_name."',
    last_name='". $last_name ."',
    phone='". $phone_number."',
    email='". $email."'
    WHERE id = '". $salesperson["id"]."'
    LIMIT 1;"; // TODO add SQL
    // For update_salesperson statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // To find territories, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same salesperson ID.
  function find_territories_by_salesperson_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (territories.id = salespeople_territories.territory_id) ";
    $sql .= "WHERE salespeople_territories.salesperson_id='" . $id . "' ";
    $sql .= "ORDER BY territories.name ASC;";
    $territories_result = db_query($db, $sql);
    return $territories_result;
  }

  //
  // USER QUERIES
  //

  // Find all users, ordered last_name, first_name
  function find_all_users() {
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $users_result = db_query($db, $sql);
    return $users_result;
  }

  // Find user using id
  function find_user_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM users WHERE id='" . $id . "' LIMIT 1;";
    $users_result = db_query($db, $sql);
    return $users_result;
  }

  function validate_user($user, $errors=array()) {
    if (is_blank($user['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($user['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if (is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if (is_blank($user['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('max' => 255))) {
      $errors[] = "Username must be less than 255 characters.";
    }
    return $errors;
  }

  // Add a new user to the table
  // Either returns true or an array of errors
  function insert_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }
    //Santizing sqli injection
    $first_name = db_escape($db, $user['first_name']);
    $last_name = db_escape($db, $user['last_name']);
    $email = db_escape($db, $user['email']);
    $username = db_escape($db, $user['username']);
    $created_at = date("Y-m-d H:i:s");
    $sql = "INSERT INTO users ";
    $sql .= "(first_name, last_name, email, username, created_at) ";
    $sql .= "VALUES (";
    $sql .= "'" . $first_name . "',";
    $sql .= "'" . $last_name . "',";
    $sql .= "'" . $email . "',";
    $sql .= "'" . $username . "',";
    $sql .= "'" . $created_at . "'";
    $sql .= ");";

    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a user record
  // Either returns true or an array of errors
  function update_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }
    //Santizing Sqli
    $first_name = db_escape($db, $user['first_name']);
    $last_name = db_escape($db, $user['last_name']);
    $email = db_escape($db, $user['email']);
    $username = db_escape($db, $user['username']);
    $sql = "UPDATE users SET ";
    $sql .= "first_name='" . $first_name . "', ";
    $sql .= "last_name='" . $last_name . "', ";
    $sql .= "email='" . $email . "', ";
    $sql .= "username='" . $username . "' ";
    $sql .= "WHERE id='" . $user['id'] . "' ";
    $sql .= "LIMIT 1;";
    // For update_user statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Delete user
  function delete_user($user){
    global $db;

    $sql = "DELETE FROM users ";
    $sql.= "WHERE id = '". $user['id'] . "' LIMIT 1;";
    $result = db_query($db, $sql);
    if($result){
      return true;
    } else{
      echo_db_error($db);
      db_close($db);
      exit;
    }
  }

?>
