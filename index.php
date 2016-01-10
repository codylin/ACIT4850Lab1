<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>

    </head>
    <body>
        <?php
        // start new game if no board given, else continue from board state
        if (isset($_GET['board'])) {
            $squares = $_GET['board'];
        } else {
            $squares = '---------';
        }
        $game = new Game($squares);
        // assumed player is o and AI is x
        if ($game->winner('o')) {
            echo "You win. Lucky guesses!";
        } else if ($game->winner('x')) {
            echo "I win. Muahahahaha";
        } else {
            // pick_move returns board state after AI makes its move
            $squares = $game->pick_move();
            $game = new Game($squares);
            if ($game->winner('x')) {
                echo "I win. Muahahahaha";
            }
        } $game->display();
        ?>
    </body>
</html>
<?php

class Game {

    var $position;
    // couldn't figure out how to overload constructors 
    // (google says it's not possible without a workaround) 
    function __construct($squares) {
        $this->position = str_split($squares);
    }

    /**
     * returns true if $token wins the game, else false
     * @param type $token 
     * @return boolean
     */
    function winner($token) {
        $result = false;
        // horizontal check
        for ($row = 0; $row < 3; $row++) {
            $result = true;
            for ($col = 0; $col < 3; $col++) {
                if ($this->position[3 * $row + $col] != $token) {
                    $result = false;
                }
            }
            // if someone won, there is no further need to check the board
            if ($result == true) {
                return $result;
            }
        }
        //vertical check
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
        //diagonal check (2)
        if ($this->position[0] == $token && $this->position[4] == $token && $this->position[8] == $token) {
            $result = true;
        }
        if ($this->position[2] == $token && $this->position[4] == $token && $this->position[6] == $token) {
            $result = true;
        }
        return $result;
    }

    /**
     * returns a table cell with $token or - with link of board state if 
     * - is chosen 
     * @param type $which cell number
     * @return type td with $link of board state
     */
    function show_cell($which) {
        $token = $this->position[$which];
        if ($token <> '-') {
            return '<td>' . $token . '</td>';
        }
        $this->newposition = $this->position;
        $this->newposition[$which] = 'o';
        $move = implode($this->newposition);
        $link = '/?board=' . $move;
        return '<td><a href="' . $link . '">-</a></td>';
    }

    /**
     * table of 9 cells, contents populated by show_cell()
     */
    function display() {
        echo '<table cols=”3” style=”font­size:large; font­weight:bold”>';
        echo '<tr>'; // open the first row
        for ($pos = 0; $pos < 9; $pos++) {
            echo $this->show_cell($pos);
            if ($pos % 3 == 2) {
                echo '</tr><tr>';
            }
        }
        echo '</tr>';
        echo '</table>';
    }

    /**
     * simplest algorithm of filling the next empty (-) slot from $this->position
     * @return type board state after AI makes its move
     */
    function pick_move() {
        $newposition = $this->position;
        for ($pos = 0; $pos < 9; $pos++) {
            if ($this->position[$pos] == '-') {
                $newposition[$pos] = 'x';
                $move = implode($newposition);
                return $move;
            }
        }
    }

}
?>
