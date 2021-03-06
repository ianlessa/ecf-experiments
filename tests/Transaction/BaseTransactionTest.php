<?php

namespace Ecf\Transaction\Tests;

use DateTime;
use Ecf\Base\Exceptions\InvalidOperationException;
use Ecf\Transaction\BaseTransaction;

class BaseTransactionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::setTotal
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     *
     * * @covers \Ecf\Base\Exceptions\InvalidOperationException
     *
     * @expectedException InvalidOperationException
     */
    public function aTransactionShouldNotBeCreatedWithNegativeValue()
    {
        $this->expectException(InvalidOperationException::class);

        new BaseTransaction(-10, new DateTime());
    }

    /**
     * @test
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     * @covers \Ecf\Transaction\BaseTransaction::setTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     * @covers \Ecf\Transaction\BaseTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\BaseTransaction::getCreatedAt
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     *
     * @throws InvalidOperationException
     */
    public function aTransactionShouldBeCorrectInitialized()
    {
        $now = new DateTime();
        $transaction = new BaseTransaction(10, $now);

        $this->assertEquals(10, $transaction->getTotal());
        $this->assertEquals(0, $transaction->getTotalPaid());
        $this->assertEquals(0, $transaction->getTotalCanceled());
        $this->assertEquals($now, $transaction->getCreatedAt());
    }
}
