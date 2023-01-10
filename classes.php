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

    function __construct(int $id, array $apples)
    {
        parent::__construct($id);
        $this->apples = $apples;
    }

    function getApple()
    {
        if (count($this->apples) > 0) {
            return array_pop($this->apples);
        }
        return null;
    }

}

class PearTree extends Tree
{
    private array $pears;

    function __construct(int $id, array $pears)
    {
        parent::__construct($id);
        $this->pears = $pears;
    }

    function getPear()
    {
        if (count($this->pears) > 0) {
            return array_pop($this->pears);
        }
        return null;
    }

}

class Garden
{
    private array $trees;

    function __construct(array $trees)
    {
        $this->trees = $trees;
    }

    function getTrees()
    {
        if (count($this->trees) > 0) {
            return $this->trees;
        }
        return null;
    }
}


