<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 03/09/18
 * Time: 15:55
 */

namespace Ecf\Price;


abstract class PriceDecorator extends AbstractPrice
{
    /** @var AbstractPrice */
    protected $price;

    public function __construct(AbstractPrice $price, $value) {
        $this->price = $price;
        parent::__construct($value);
    }
}