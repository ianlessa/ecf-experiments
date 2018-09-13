<?php

namespace Ecf\Base\Interfaces;

interface ValueObjectInterface
{
    /**
     * @param  ValueObjectInterface $valueObject
     * @return boolean
     */
    public function equals(ValueObjectInterface $valueObject);
}
