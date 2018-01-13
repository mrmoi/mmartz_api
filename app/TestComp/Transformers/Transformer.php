<?php
namespace TestComp\Transformers;

/**
 * Created by PhpStorm.
 * User: moimartz
 * Date: 1/10/18
 * Time: 6:20 PM
 */
abstract class Transformer
{


    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);

}