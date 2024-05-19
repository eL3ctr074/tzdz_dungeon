<?php

require 'classes/gamecontroller.php';

$dungeonData = [
    '0,0' => ['type' => 'treasure', 'content' => 1],
    '0,1' => ['type' => 'monster', 'content' => ['strength' => 15, 'decrement' => 5]],
    '1,0' => ['type' => 'empty'],
    '1,1' => ['type' => 'treasure', 'content' => 2],
];

$game = new GameController($dungeonData);

$game->movePlayer('right');
$game->movePlayer('down');
$game->movePlayer('left');
$game->movePlayer('up');

echo 'Очки игрока: ' . $game->getScore() . PHP_EOL;

echo 'Кратчайший путь: ' . implode(', ', $game->getPath()) . PHP_EOL;