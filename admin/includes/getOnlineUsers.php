<?php
session_start();
include('../../includes/db.php');
include('functions.php');
//handling users online
if (isset($_GET['getOnlineUsers'])) {
  $sessionId = session_id();
  $time = time();
  $query = "SELECT * FROM sessions WHERE session_id='$sessionId'";
  $selectSessionQuery = mysqli_query($connection, $query);
  checkQuery($selectSessionQuery);
  if (mysqli_num_rows($selectSessionQuery) === 0) {
    //insert new row
    $query = "INSERT INTO sessions(session_id, session_time) VALUES ('$sessionId', $time)";
    $insertSessionQuery = mysqli_query($connection, $query);
    checkQuery($insertSessionQuery);
  } else {
    //update session time
    $query = "UPDATE sessions SET session_time = $time WHERE session_id = '$sessionId'";
    $updateSessionQuery = mysqli_query($connection, $query);
    checkQuery($updateSessionQuery);
  }
  $timeout = $time - 5;
  $query = "SELECT * FROM sessions WHERE session_time > $timeout";
  $selectSessionsQuery = mysqli_query($connection, $query);
  checkQuery($selectSessionsQuery);
  echo mysqli_num_rows($selectSessionsQuery);
}
