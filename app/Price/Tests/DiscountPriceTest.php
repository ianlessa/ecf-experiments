<?php

namespace Ecf\Price\Tests;

use Ecf\Exception\InvalidOperationException;
use Ecf\Price\BasePrice;
use Ecf\Price\DiscountPrice;

class DiscountPriceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * @covers \Ecf\Price\AbstractPrice::__construct
     * @covers \Ecf\Price\AbstractPrice::setValue
     * @covers \Ecf\Price\BasePrice::getValue
     * @covers \Ecf\Price\PriceDecorator::__construct
     * @covers \Ecf\Price\DiscountPrice::getValue
     */
    public function discount_value_should_be_removed_from_final_price()
    {
        $basePrice = new BasePrice(10);
        $priceWithDiscount = new DiscountPrice($basePrice,7);

        $this->assertEquals(3,$priceWithDiscount->getValue());
    }

    /**
     * @test
     *
     * @covers \Ecf\Price\AbstractPrice::__construct
     * @covers \Ecf\Price\AbstractPrice::setValue
     * @covers \Ecf\Price\BasePrice::getValue
     * @covers \Ecf\Price\PriceDecorator::__construct
     * @covers \Ecf\Price\DiscountPrice::getValue
     */
    public function multiple_discount_value_should_be_removed_from_final_price()
    {
        $basePrice = new BasePrice(10);
        $priceWithDiscount = new DiscountPrice($basePrice,7);
        $priceWithDiscount = new DiscountPrice($priceWithDiscount,2);

        $this->assertEquals(1,$priceWithDiscount->getValue());
    }

    /**
     * @test
     *
     * @covers \Ecf\Price\AbstractPrice::__construct
     * @covers \Ecf\Price\AbstractPrice::setValue
     * @covers \Ecf\Price\BasePrice::getValue
     * @covers \Ecf\Price\PriceDecorator::__construct
     * @covers \Ecf\Price\DiscountPrice::getValue
     *
     * @expectedException InvalidOperationException
     */
    public function a_price_with_discount_should_not_be_less_than_zero()
    {
        $this->expectException(InvalidOperationException::class);

        $basePrice = new BasePrice(10);
        $priceWithDiscount = new DiscountPrice($basePrice,70);

        $priceWithDiscount->getValue();
    }
}
