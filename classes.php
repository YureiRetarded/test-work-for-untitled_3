<?php

abstract class Tree
{
    //Уникальный регистрационный номер
    private int $id;

    function __construct(int $id)
    {
        $this->id = $id;
    }

    //Получения номера
    function display_id(): int
    {
        return $this->id;
    }

    abstract function getCount();


}

abstract class Fruit
{
    //Вес фрукта
    private int $weight;

    function __construct(int $weight)
    {
        $this->weight = $weight;
    }

    //Получение вес
    function getWeight(): int
    {
        return $this->weight;
    }

    abstract function isWeightCorrect(int $weight);
}

class Apple extends Fruit
{
    function __construct(int $weight)
    {
        $this->isWeightCorrect($weight) ? $this->weight = $weight : $this->weight = 160;
    }

    //Проверка чтобы вес соответствовал нужным значениям
    function isWeightCorrect(int $weight)
    {
        return $weight >= 150 && $weight <= 180;
    }
}

class Pear extends Fruit
{
    function __construct(int $weight)
    {
        $this->isWeightCorrect($weight) ? $this->weight = $weight : $this->weight = 140;
    }

    //Проверка чтобы вес соответствовал нужным значениям
    function isWeightCorrect(int $weight)
    {
        return $weight >= 130 && $weight <= 170;
    }
}

class AppleTree extends Tree
{
    private array $apples;

    function __construct(int $id)
    {
        parent::__construct($id);
        $this->createApples();
    }

    function getApple()
    {
        if (count($this->apples) > 0) {
            return array_pop($this->apples);
        }
        return null;
    }

    function createApples()
    {
        for ($i = 0; $i < rand(60, 100); $i++) {
            $this->apples[] = new Apple(rand(150, 180));
        }
    }

    function getCount()
    {
        return count($this->apples);
    }

}

class PearTree extends Tree
{
    private array $pears;

    function __construct(int $id)
    {
        parent::__construct($id);
        $this->createPears();
    }

    function getPear()
    {
        if (count($this->pears) > 0) {
            return array_pop($this->pears);
        }
        return null;
    }

    function createPears()
    {
        for ($i = 0; $i < rand(25, 30); $i++) {
            $this->pears[] = new Pear(rand(130, 170));
        }
    }

    function getCount()
    {
        return count($this->pears);
    }
}

class Garden
{
    private array $trees;

    function addTree(Tree $tree)
    {
        $this->trees[] = $tree;
    }

    function getTrees()
    {
        if (count($this->trees) > 0) {
            return $this->trees;
        }
        return null;
    }

    function getCountTrees()
    {
        return count($this->trees);
    }

    function getInfo()
    {
        $appleTree = 0;
        $pearTree = 0;
        foreach ($this->trees as $tree) {
            if ($tree instanceof AppleTree)
                $appleTree++;
            if ($tree instanceof PearTree)
                $pearTree++;
        }
        echo 'Кол-во яблонь: ' . $appleTree . PHP_EOL;
        echo 'Кол-во груш: ' . $pearTree . PHP_EOL;
    }
}

class Worker
{
    public Garden $garden;

    function __construct(Garden $garden)
    {
        $this->garden = $garden;
    }

    function addTree(Tree $tree)
    {
        $this->garden->addTree($tree);
    }

    function getFruits()
    {
        $harvestedFruits = [];
        foreach ($this->garden->getTrees() as $tree) {
            if ($tree instanceof AppleTree)
                for ($i = 0; $i < rand(40, 50); $i++) {
                    $harvestedFruits[] = $tree->getApple();
                }

            if ($tree instanceof PearTree)
                for ($i = 0; $i < rand(0, 20); $i++) {
                    $harvestedFruits[] = $tree->getPear();
                }

        }
        return $harvestedFruits;
    }

    function getInfoOfPackFruits(array $fruits)
    {
        $countApples = 0;
        $weightApples = 0;
        $countPears = 0;
        $weightPears = 0;
        foreach ($fruits as $fruit) {
            if ($fruit instanceof Apple) {
                $countApples++;
                $weightApples += $fruit->weight;
            }
            if ($fruit instanceof Pear) {
                $countPears++;
                $weightPears += $fruit->weight;
            }
        }
        echo 'Кол-во яблок: ' . $countApples . PHP_EOL;
        echo 'Общий вес яблок: ' . $weightApples . 'гр' . PHP_EOL;
        echo 'Кол-во груш: ' . $countPears . PHP_EOL;
        echo 'Общий вес груш: ' . $weightPears . 'гр' . PHP_EOL;
    }
}

