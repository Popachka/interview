<?php

trait SingletonTrait
{
    private static $instance = null;

    // Запрещаем прямое создание

    private function __construct()
    {
    }

    // Запрещаем клонирование

    private function __clone()
    {
    }

    // Запрещаем десериализацию



    // retrun SingletonTrait|null

    public static function getInstance()
    {
        return static::$instance ?? (static::$instance = new static());
    }
}