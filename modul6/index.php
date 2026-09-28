<?php

//$my_file = fopen("file1.txt","w");

//fclose($my_file );

//fread

$filename = "file1.txt";
$file = fopen($filename, "r");

$filesize = filesize($filename);

$my_filedata = fread($file,$filesize);
echo $my_filedata . "<br>";
fclose($file);



$file1 = fopen("myfile.txt","r");
while(!feof($file1)){
    echo fgets($file1) ."<br>";
}

//fwrite

$my_file1 = fopen("example.txt", "w");

$test = "computer programming";

fwrite($my_file1,$test);


//w+ (read and write only)
$file2 = fopen("data.txt", "w+");
fwrite($file2, "Welcome to digital school");

//a+
$file3 = fopen("data.txt", "a+");
fwrite($file3, "Liridona")



?>