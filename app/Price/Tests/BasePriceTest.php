<?php

namespace Ecf\Price\Tests;

use Ecf\Exception\InvalidOperationException;
use Ecf\Price\BasePrice;

class BasePriceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @covers            Ecf\Price\AbstractPrice::__construct
     * @covers            Ecf\Price\AbstractPrice::setValue
     * @expectedException InvalidOperationException
     */
    public function a_price_should_not_be_created_with_negative_value()
    {
        $this->expectException(InvalidOperationException::class);

        new BasePrice(-10);
    }

    /**
     * @test
     * @covers Ecf\Price\AbstractPrice::__construct
     * @covers Ecf\Price\AbstractPrice::setValue
     * @covers Ecf\Price\BasePrice::getValue
     */
    public function a_price_should_be_created_with_positive_value()
    {
        $price = new BasePrice(100);

        $this->assertEquals(100, $price->getValue());
    }
}
