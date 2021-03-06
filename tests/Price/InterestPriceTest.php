<?php

namespace Ecf\Price\Tests;

use Ecf\Price\BasePrice;
use Ecf\Price\InterestPrice;

class InterestPriceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @covers \Ecf\Price\AbstractPrice::__construct
     * @covers \Ecf\Price\AbstractPrice::setValue
     * @covers \Ecf\Price\BasePrice::getValue
     * @covers \Ecf\Price\PriceDecorator::__construct
     * @covers \Ecf\Price\InterestPrice::getValue
     */
    public function interestValueShouldBeAddedIntoFinalPrice()
    {
        $basePrice = new BasePrice(10);
        $priceWithInterest = new InterestPrice($basePrice, 7);

        $this->assertEquals(17, $priceWithInterest->getValue());
    }

    /**
     * @test
     * @covers \Ecf\Price\AbstractPrice::__construct
     * @covers \Ecf\Price\AbstractPrice::setValue
     * @covers \Ecf\Price\BasePrice::getValue
     * @covers \Ecf\Price\PriceDecorator::__construct
     * @covers \Ecf\Price\InterestPrice::getValue
     */
    public function multipleInterestValueShouldBeAddedIntoFinalPrice()
    {
        $basePrice = new BasePrice(10);
        $priceWithInterest = new InterestPrice($basePrice, 7);
        $priceWithInterest = new InterestPrice($priceWithInterest, 14);

        $this->assertEquals(31, $priceWithInterest->getValue());
    }
}
