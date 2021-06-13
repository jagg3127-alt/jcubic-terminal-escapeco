<?php
require('json-rpc.php');
define('DEBUG', true);

  if (DEBUG) {
    $users = array(
      array(
        'user' => 'a',
        'password' => 'b'
      )
    );
    $logs = array(
      "Logs \n1. Chat log 1/1 \n2. file b \n3.",
      "Chat log:\nDEBUG",
      "File Content",
      "test",
      "test",
    );
  } else {
    $users = array(
      array(
        'user' => 'Agent 8&9',
        'password' => 'x559Ab78X'
      )
    );  
    $logs = array(
      "Logs \n1. Chat log 1/1 \n2. file b \n3.",
   //chat log--------------------------------------------------------------------------------   
      "Chat log:  
      \nPlease read aloud for all viewers with bad eyesight 
      \nWarden: I called this meeting under extreme circumstances. 
      \nMich: Why am I the only one here, and what circumstances? 
      \nD#E.T joined the chat 
      \nWarden: Mich?! Sound all alarms, dont worry about the meeting ill explain later, this is not an alert. So Cat what do you want? 
      \nD#E.T: DONT CALL ME BY THAT NAME! YOU RUINED ME WITH YOUR EXPERIMENTS THEN TORCHERED ME. 
      \nMich: Warden who is this and what experiments are they talking about? 
      \nWarden: I did do experiments but never on Cat, it was the governmental agency eradicating all inhumans subjects. 
      \nMich: So they were an inhuman subject that sounds even worse? 
      \nD#E.T: I did it to myself but I dont think hes telling you everything 
      \nMich: Warden, what do they mean? 
      \nJosh joined the chat 
      \nJosh: Warden, activate erase of all logs, NOW! 
      \nWarden: I cant, we need records of this. Ill explain the very essence of this in do time. 
      \nWarden left the chat 
      \nMich: So Josh what does he mean? 
      \nJosh: The warden was an experiment from the dark lab. He was forced to do extremely bad things; it was also a time where Cat was his closes friend. 
      \nD#E.T left the chat 
      \nMich: Im going to toss the physical forms in the shredder. 
      \nMich left the chat 
      \nJosh: /Init && /leave -s
   ",
   //file b -------------------------------------------------------------------------------
   " \nThings that start with b: \n \n... \n,,, \n--- \n``` \nDATABASE 000065419 Day1-004/nExperiment beta on subject cat \ndata seems to say she can phase through any surface but no physical signs yet \n \nExperiment 0 on subject REDACTED(warden) \nHes gone rogue escaping every challenge at record speed, weve locked him in a state of the art prison escape room no one ever escapes/n \n \n... \n,,, \n--- \n``` \nDATABASE 000065419Day1-005/nExperiment beta on subject cat \nShe fell through the ground and is now being torn apart by the gravity of earth and burned in the core we are activating zero gravity suit now \n \nExperiment 0 on subject REDACTED(warden) \nHe passed the best escape room and is sprinting strait towards cats testing room, Im just a AI so I cant help \n \n \n... \n,,, \n--- \n``` \nDATABASE 000065419 Day1-005/nExperiment beta on subject cat \nBeing torn off of life support. Alarms are sounding and guards are called in. Experiment 0 on subject REDACTED(warden) \nHe tears her off life support and locks himself in the room after threatening the scientists to leave. Cuts off data ch-ip-s--- \n \nDataBase corrupt Exiting in …3…2…1…0"
     );}
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
    $_SESSION['lock'] = true;
    return $_SESSION['token'];
  }
  // ---------------------------------------------------------------------------
  function valid_token($token) {
    if ($_SESSION['token'] != $token) {
      throw new Exception("Access Denied");
    }
  } 
  // ---------------------------------------------------------------------------
  function echo($token) {
    return "[[ send '\nCode x file b now able to be opened\nExiting in …3…2…1…0::logs::1000' ]]";
 }
  function unlock($token){
    $this->valid_token($token);
    $_SESSION['lock'] = false;
    return "[[ send 'Code x initiated' ]]";
    return "[[ progress '20::echo' ]]";
  }
  //----------------------------------------------------------------------------
  function logs($token, $choice = 0) {
    $this->valid_token($token);
    global $logs;
    if (isset($logs[$choice])) {
      $log = $logs[$choice];
      if ($choice == 0) {
        return "[[ send '$log::logs' ]]";
      } else if ($choice == 2 && $_SESSION['lock']) { // file b
          return "[[ send 'Error::logs::1000' ]]";
      } else {
        $next = 'logs';
        if ($choice == 1) { // lock
          $next = 'unlock';
        }
        return "[[ send '$log::$next::1000' ]]";
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
