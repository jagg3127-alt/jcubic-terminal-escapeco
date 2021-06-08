<?php
require('json-rpc.php');
$logs = array(
  "Logs \nn1. \nn2. \nn3.",
  "log 1 is corupt",
  "log 2 empty",
  "log 3 failed to startup"
  );
$users = array(
  array(
    'user' => 'jon',
    'password' => 'secret'
  )
);

function get_user($username) {
  global $users;
  $arr = array_filter($users, function($user) use ($username) {
    return $user['user'] == $username;
  });
  if (count($arr) == 1) {
    return $arr[0];
  }
  return null;
}

session_start();

class Demo {
  function valid_user($username) {
    return get_user($username) != null;
  }
  // ---------------------------------------------------------------------------
  function login($username, $password) {
    $user = get_user($username);
    if ($user == null) {
      return false;
    }
    if ($user['password'] != $password) {
      return null;
    }
    $_SESSION['token'] = md5(time());
    return $_SESSION['token'];
  }
  // ---------------------------------------------------------------------------
  function valid_token($token) {
    if ($_SESSION['token'] != $token) {
      throw new Exception("Access Denied");
    }
  }
  // ---------------------------------------------------------------------------
  function logs($token, $choice = 0) {
    $this->valid_token($token);
    global $logs;
    if (isset($logs[$choice])) {
      $log = $logs[$choice];
      if ($choice == 0) {
        return "[[ send '$log::logs' ]]";
      } else {
        return "[[ send '$log::logs::1000' ]]";
      }
    } else {
      throw new Error('Invalid choice');
    }
  }
  // ---------------------------------------------------------------------------
  function hello($token) {
    $this->valid_token($token);
    return "Welcome jon";
  }
}

handle_json_rpc(new Demo());

?>
