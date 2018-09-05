<?php

namespace Ecf\Transaction\Tests;

use DateTime;
use Ecf\Exception\InvalidOperationException;
use Ecf\Transaction\BaseTransaction;
use Ecf\Transaction\CancelTransaction;
use Ecf\Transaction\PaidTransaction;

class TransactionDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     * @covers \Ecf\Transaction\AbstractTransaction::setTotal
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     *
     * @covers \Ecf\Transaction\CancelTransaction::__construct
     * @covers \Ecf\Transaction\CancelTransaction::getTotal
     * @covers \Ecf\Transaction\CancelTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\CancelTransaction::getTotalPaid
     * @covers \Ecf\Transaction\CancelTransaction::setTotal
     *
     * @covers \Ecf\Transaction\PaidTransaction::__construct
     * @covers \Ecf\Transaction\PaidTransaction::canConstruct
     * @covers \Ecf\Transaction\PaidTransaction::getTotal
     * @covers \Ecf\Transaction\PaidTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\PaidTransaction::getTotalPaid
     * @covers \Ecf\Transaction\PaidTransaction::setTotal
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @throws \Ecf\Exception\InvalidOperationException
     */
    public function interationsBetweenDecoratorsShouldReturnCorrectValues()
    {
        $transaction = new BaseTransaction(100, new DateTime());
        $transaction = new PaidTransaction($transaction, 90, new DateTime());
        $transaction = new CancelTransaction($transaction, 25, new DateTime());
        $transaction = new CancelTransaction($transaction, 35, new DateTime());

        $this->assertEquals(100, $transaction->getTotal());
        $this->assertEquals(90, $transaction->getTotalPaid());
        $this->assertEquals(60, $transaction->getTotalCanceled());
    }

    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     * @covers \Ecf\Transaction\AbstractTransaction::setTotal
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     *
     * @covers \Ecf\Transaction\CancelTransaction::__construct
     * @covers \Ecf\Transaction\CancelTransaction::getTotal
     * @covers \Ecf\Transaction\CancelTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\CancelTransaction::getTotalPaid
     * @covers \Ecf\Transaction\CancelTransaction::setTotal
     *
     * @covers \Ecf\Transaction\PaidTransaction::__construct
     * @covers \Ecf\Transaction\PaidTransaction::canConstruct
     * @covers \Ecf\Transaction\PaidTransaction::getTotal
     * @covers \Ecf\Transaction\PaidTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\PaidTransaction::getTotalPaid
     * @covers \Ecf\Transaction\PaidTransaction::setTotal
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @covers \Ecf\Transaction\TransactionDecorator::getTransaction
     *
     * @expectedException InvalidOperationException
     */
    public function aComplexTransactionAlreadyPaidShouldNotBePaidAgain()
    {
        $this->expectException(InvalidOperationException::class);

        $transaction = new BaseTransaction(100, new DateTime());
        $transaction = new PaidTransaction($transaction, 90, new DateTime());
        $transaction = new CancelTransaction($transaction, 25, new DateTime());
        $transaction = new CancelTransaction($transaction, 35, new DateTime());
        $transaction = new PaidTransaction($transaction, 5, new DateTime());

        $this->assertEquals(100, $transaction->getTotal());
        $this->assertEquals(90, $transaction->getTotalPaid());
        $this->assertEquals(60, $transaction->getTotalCanceled());
    }
}
