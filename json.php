<?php  

header("content-type:application/json");
mysql_connect("localhost","root","");
mysql_select_db("json");
$sql= "select * from json limit 10";
$results=mysql_query($sql);
 
 $data= array();// creating an empty array

 while ($row=mysql_fetch_assoc($results))// retreive single rows from results set
 {
 	//echo $row["id"]."<br>";
 	//var_dump($row);
 	$data[]=$row;// inserting each rows to the array
 }

$json=  json_encode($data);//Function that generates actual json string

echo $json;