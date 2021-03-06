<?php
use PGNChess\Game;
use PGNChess\PGN\Convert;
use PGNChess\PGN\Symbol;

require_once __DIR__ . '/../vendor/autoload.php';

$pairs = array_filter(preg_split('/[0-9]+\./', $pgn));

$moves = [];

foreach ($pairs as $pair) {
    $moves[] = array_values(array_filter(explode(' ', $pair)));
}

$moves = array_values(array_filter($moves));

$game = new Game;

for ($i=0; $i<count($moves); $i++) {

    $whiteMove = str_replace("\r", '', str_replace("\n", '', $moves[$i][0]));

    if (isset($moves[$i][1])) {
        $blackMove = str_replace("\r", '', str_replace("\n", '', $moves[$i][1]));
    }

    echo Symbol::WHITE . " played {$whiteMove}" . PHP_EOL;

    if ($game->play(Convert::toObject(Symbol::WHITE, $whiteMove))) {

        if ($game->isCheck()) {            
            echo 'Check!' . PHP_EOL;            
            if ($game->isMate()) {
                echo 'Mate!' . PHP_EOL;
                exit;
            }
        }
        
    }
    else {
        
        echo 'Illegal move' . PHP_EOL;
        exit;
        
    }

    if (isset($moves[$i][1])) {

        echo Symbol::BLACK . " played {$blackMove}" . PHP_EOL;

        if ($game->play(Convert::toObject(Symbol::BLACK, $blackMove))) {

            if ($game->isCheck()) {
                echo 'Check!' . PHP_EOL;
                if ($game->isMate()) {
                    echo 'Mate!' . PHP_EOL;
                    exit;
                }
            }

        } else {
            
            echo 'Illegal move' . PHP_EOL;
            exit;
            
        }
    }
}
