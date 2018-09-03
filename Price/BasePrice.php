<?php

namespace Ecf\Price;

class BasePrice extends AbstractPrice
{
    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}