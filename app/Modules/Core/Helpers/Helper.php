<?php

namespace App\Modules\Core\Helpers;

use Illuminate\Support\Arr;
use ReflectionClass;
use ReflectionException;

class Helper
{
    /**
     * @param $class
     * @return string
     */
    public static function getResourceName($class): string
    {
        try {
            $reflectionClass = new ReflectionClass($class);
            return $reflectionClass->getShortName();
        } catch (ReflectionException $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @param $request
     * @param $key
     * @return bool
     */
    public static function checkIfNotNull($request, $key): bool
    {
        return (Arr::has($request, $key) && !is_null(Arr::get($request, $key)));
    }

    /**
     * @param $request
     * @param $key
     * @return bool
     */
    public static function checkIfTrue($request, $key): bool
    {
        return (Arr::has($request, $key) && (bool)Arr::get($request, $key) === true);
    }
}
