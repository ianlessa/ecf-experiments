<?php

namespace Ecf\Base;


interface ValueObjectInterface
{
    /**
     * @param ValueObjectInterface $valueObject
     * @return boolean
     */
    public function equals(ValueObjectInterface $valueObject);
}