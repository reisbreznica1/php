<?php


$num = 4;


if($num >0){
    echo "$num is greater than 0";
}



$age = 14;


echo "<br>";
if(($age > 12) && ($age < 20)) {
    echo "You are a teenager";
}



echo "<br>";
$age = 19;
if ($age < 18) {
    echo "You are under 18";
}else{
    echo "You are an adult";
}

echo "<br>";
$number = 1;
if ($number < 0) {
    echo "The number $number is negative";
}elseif ($number == 0) {
    echo "The number $number is zero";
} else {
    echo "The number $number is pozitive";
}

echo "<br>";
$number1 = 9874234;
$number2 = 9874235;
if ($number1 < $number2) {
    echo "The number $number1 is smaller then $number2";
}elseif ($number1 == $number2) {
    echo "The number $number is equal to $number2";
} else {
    echo "The number $number is larger then $number2";
}

echo "<br>";
$number3 = 19;
$number4 = 18;
if ($number3 < $number4) {
    echo "The number $number3 is smaller then $number4";
}else{
    echo "The number $number4 is smaller then $number3";
}


echo "<br>";
$dita = 3;

switch($dita){
    case 1:
        echo "E hane";
        break;
    case 2:
        echo "E marte";
        break;
    case 3:
        echo "E merkure";
        break;
    case 4:
        echo "E ejte";
        break;
    default:
    echo "Dite tjeter";
}
?>