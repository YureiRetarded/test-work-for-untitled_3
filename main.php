<?php
require_once('classes.php');

//Массив с деревьями
echo 'Создаём деревья...' . PHP_EOL;
$index_tree = 1;
$trees = [];
while (count($trees) != 10) {
    $trees[] = new AppleTree($index_tree);
    $index_tree++;
}

while (count($trees) != 25) {
    $trees[] = new PearTree($index_tree);
    $index_tree++;
}
echo count($trees);

//Сад
echo 'Создаём сад...' . PHP_EOL;
$garden = new Garden();

//Наша система
echo 'Создаём систему...' . PHP_EOL;
$worker = new Worker($garden);

echo 'Рассаживаем деревья...' . PHP_EOL;
foreach ($trees as $tree) {
    $worker->addTree($tree);
}

echo 'Собираем фрукты...' . PHP_EOL;
$fruits = $worker->getFruits();
echo 'Смотрим что получили...' . PHP_EOL;
$worker->getInfoOfPackFruits($fruits);


