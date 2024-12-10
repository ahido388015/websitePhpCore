<?php
$con = new mysqli("127.0.0.1","root","","bandienmay");

// Check connection
if ($con -> connect_errno) {
  echo "Không thể kết nối tới cơ sở dữ liệu  MySQL: " . $mysqli -> connect_error;
  exit();
}
?>