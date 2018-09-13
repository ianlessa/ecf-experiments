<?php

namespace Ecf\Price;

abstract class PriceDecorator extends AbstractPrice
{
    /**
     * @var AbstractPrice
     */
    protected $price;

    public function __construct(AbstractPrice $price, $value)
    {
        $this->price = $price;
        parent::__construct($value);
    }
}
