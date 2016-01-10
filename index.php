<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>

    </head>
    <body>
        <?php
        if (!isset($_GET['board'])) {
            echo "no input";
        } else {
            $squares = $_GET['board'];
        }
        $game = new Game($squares);
        $game->display();
        if ($game->winner('x')) {
            echo "You win. Lucky guesses!";
        } else if ($game->winner('o')) {
            echo "I win. Muahahahaha";
        } else {
            echo "No winner yet, but you are losing.";
        }

        class Game {

            var $position;

            function __construct($squares) {
                $this->position = str_split($squares);
            }

            function winner($token) {
                //
                $result = false;
                for ($row = 0; $row < 3; $row++) {
                    $result = true;
                    for ($col = 0; $col < 3; $col++) {
                        if ($this->position[3 * $row + $col] != $token) {
                            $result = false;
                        }
                    }
                    if ($result == true) {
                        return $result;
                    }
                }
                for ($col = 0; $col < 3; $col++) {
                    $result = true;
                    for ($row = 0; $row < 3; $row++) {
                        if ($this->position[3 * $row + $col] != $token) {
                            $result = false;
                        }
                    }
                    if ($result == true) {
                        return $result;
                    }
                }
                if ($this->position[0] == $token && $this->position[4] == $token && $this->position[8] == $token) {
                    $result = true;
                }
                if ($this->position[2] == $token && $this->position[4] == $token && $this->position[6] == $token) {
                    $result = true;
                }
                return $result;
            }
            function show_cell($which) {
                $token = $this->position[$which];
                if ($token <> '­')
                    return '<td>' . $token . '</td>';
                $this->newposition = $this­ > position;
                $this->newposition[$which] = 'o';
                $move = implode($this->newposition);
                $link = '/?board=' . $move;
                return '<td><a href=”' . $link . '”>­</a></td>';
            }

            function display() {
                echo '<table cols=”3” style=”font­size:large; font­weight:bold”>';
                echo '<tr>'; // open the first row
                for ($pos = 0; $pos < 9; $pos++) {
                    echo $this->show_cell($pos);
                    if ($pos % 3 == 2){
                        echo '</tr><tr>';
                    }
                }
                echo '</tr>';
                echo '</table>';
            }

        }
        ?>
    </body>
</html>

