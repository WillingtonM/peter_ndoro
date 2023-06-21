<?php

if(isset($_SESSION['user_id'])) {
  $user_id    = $_SESSION['user_id'];
  $user_qdta  = get_user_by_id($user_id);
}
