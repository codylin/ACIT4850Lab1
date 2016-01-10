<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        
    </head>
    <body>
        <?php
            if (!isset ($_GET['board'])){echo "no input";}
            else {
                $position = $_GET['board'];
                $squares = str_split($position);

                if (winner('x',$squares)){ echo "You win.";}
                else if (winner('o',$squares)) {echo "I win.";}
                else {echo "No winner yet.";}
            }
        ?>
    </body>
</html>
<?php

function winner($token,$position) {
    //
    $result = false;
    for($row=0; $row<3; $row++) {
        $result = true;
        for($col=0; $col<3; $col++)
            {if ($position[3*$row+$col] != $token) {$result = false;}}
        if ($result == true){ return $result;}
    }
    for($col=0; $col<3; $col++) {
        $result = true;
        for($row=0; $row<3; $row++)
            {if ($position[3*$row+$col] != $token) {$result = false;}}
        if ($result == true){ return $result;}
    }
    if ($position[0]==$token&&$position[4]==$token&&$position[8]==$token){
        $result = true;
    }
    if ($position[2]==$token&&$position[4]==$token&&$position[6]==$token){
        $result = true;
    }
    return $result;
}



?>
