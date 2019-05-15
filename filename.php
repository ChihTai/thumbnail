<?php

//檔名的可能規則

$filename="king_".date("Ymdhis");

echo "filename1=".$filename;
echo "<br>";
$filename=md5(date("Ymdhis").rand(100,999));
echo "filename2=".$filename;
echo "<br>";

$filename=hash("sha256",date("Ymdhis").rand(100,999));
echo "filename2=".$filename;
echo "<br>";
?>