<?php

namespace Ecf\Price\Tests;

use Ecf\Price\BasePrice;
use Ecf\Price\DiscountPrice;

class AbstractPriceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * @covers Ecf\Price\AbstractPrice::__construct
     * @covers Ecf\Price\AbstractPrice::equals
     * @covers Ecf\Price\AbstractPrice::setValue
     *
     * @covers Ecf\Price\BasePrice::getValue
     *
     * @covers Ecf\Price\DiscountPrice::getValue
     *
     * @covers Ecf\Price\PriceDecorator::__construct
     */
    public function itMustBePossibleToVerifyStructuralEqualityOfTwoPrices()
    {
        $basePrice = new BasePrice(10);
        $basePrice = new DiscountPrice($basePrice, 3);

        $sameBasePrice = new BasePrice(10);
        $sameBasePrice = new DiscountPrice($sameBasePrice, 3);

        $differentBasePrice = new BasePrice(10);
        $differentBasePrice = new DiscountPrice($differentBasePrice, 4);

        $this->assertTrue($basePrice->equals($sameBasePrice));
        $this->assertFalse($basePrice->equals($differentBasePrice));
    }
}
