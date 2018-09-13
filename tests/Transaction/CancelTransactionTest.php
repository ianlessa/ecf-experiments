<?php

namespace Ecf\Transaction\Tests;

use DateTime;
use Ecf\Base\Exceptions\InvalidOperationException;
use Ecf\Transaction\BaseTransaction;
use Ecf\Transaction\CancelTransaction;
use Ecf\Transaction\PaidTransaction;

class CancelTransactionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::setTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @covers \Ecf\Transaction\CancelTransaction::__construct
     * @covers \Ecf\Transaction\CancelTransaction::setTotal
     *
     * @expectedException \Ecf\Base\Exceptions\InvalidOperationException
     */
    public function aCancelTransactionValueShouldNotBeNegative()
    {
        $this->expectException(InvalidOperationException::class);

        $transaction = new BaseTransaction(10, new DateTime());
        new CancelTransaction($transaction, -10, new DateTime());
    }

    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     * @covers \Ecf\Transaction\BaseTransaction::setTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     *
     * @covers \Ecf\Transaction\CancelTransaction::__construct
     * @covers \Ecf\Transaction\CancelTransaction::setTotal
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @expectedException \Ecf\Base\Exceptions\InvalidOperationException
     */
    public function aCancelTransactionValueShouldNotBeGreaterThanBaseTotalValue()
    {
        $this->expectException(InvalidOperationException::class);

        $transaction = new BaseTransaction(10, new DateTime());
        new CancelTransaction($transaction, 50, new DateTime());
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
     * @covers \Ecf\Transaction\CancelTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\CancelTransaction::getTotalPaid
     * @covers \Ecf\Transaction\CancelTransaction::setTotal
     *
     * @covers \Ecf\Transaction\PaidTransaction::__construct
     * @covers \Ecf\Transaction\PaidTransaction::canConstruct
     * @covers \Ecf\Transaction\PaidTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\PaidTransaction::getTotalPaid
     * @covers \Ecf\Transaction\PaidTransaction::setTotal
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @throws InvalidOperationException
     */
    public function aCancelTransactionShouldAddValueToTotalPaid()
    {
        $transaction = new BaseTransaction(10, new DateTime());
        $transaction = new PaidTransaction($transaction, 9, new DateTime());
        $transaction = new CancelTransaction($transaction, 7, new DateTime());
        $transaction = new CancelTransaction($transaction, 2, new DateTime());

        $this->assertEquals(9, $transaction->getTotalCanceled());
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
     * @throws InvalidOperationException
     */
    public function aCancelTransactionShouldRetrieveTheCorrectTransactionValues()
    {
        $transaction = new BaseTransaction(10, new DateTime());
        $transaction = new PaidTransaction($transaction, 9, new DateTime());
        $transaction = new CancelTransaction($transaction, 7, new DateTime());

        $this->assertEquals(10, $transaction->getTotal());
        $this->assertEquals(9, $transaction->getTotalPaid());
        $this->assertEquals(7, $transaction->getTotalCanceled());
    }

    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     * @covers \Ecf\Transaction\AbstractTransaction::setTotal
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     *
     * @covers \Ecf\Transaction\CancelTransaction::__construct
     * @covers \Ecf\Transaction\CancelTransaction::setTotal
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @expectedException InvalidOperationException
     */
    public function aCancelTransactionShouldNotBeGreatherThanPaidValue()
    {
        $this->expectException(InvalidOperationException::class);

        $transaction = new BaseTransaction(10, new DateTime());

        new CancelTransaction($transaction, 9, new DateTime());
    }
}
