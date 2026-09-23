<?php

$dogs = array(
    array ("Labrador Retriever",	"Canada",	10),
    array ("German Shepherd",	"Germany",	12),
    array ("Golden Retriever",	"	Scotland",	11),
);

echo $dogs [0][0]. ": Origin: ". $dogs[0][1]. ", life spam: ". $dogs[0][2];
echo "<br>";
echo $dogs [1][0]. ": Origin: ". $dogs[1][1]. ", life spam: ". $dogs[1][2];
echo "<br>";
echo $dogs [2][0]. ": Origin: ". $dogs[2][1]. ", life spam: ". $dogs[2][2];
 


for($row = 0; $row < 3; $row++){
    echo "<p><b> Row number $row </b></p>";
    echo "<ul>";
    for($col= 0; $col <3; $col++){
        echo "<li>" . $dogs[$row][$col] . "</li>";
    }

    echo "</ul>";
}

for($i=0; $i<10; $i++){
    for($j=0;$j<=$i;$j++){
        echo"*";
    }
    echo "<br>";
}



?>