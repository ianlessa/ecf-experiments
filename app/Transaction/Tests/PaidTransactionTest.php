<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 05/09/18
 * Time: 10:20
 */

namespace Ecf\Transaction\Tests;

use DateTime;
use Ecf\Exception\InvalidOperationException;
use Ecf\Transaction\BaseTransaction;
use Ecf\Transaction\PaidTransaction;

class PaidTransactionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::setTotal
     *
     * @covers \Ecf\Transaction\PaidTransaction::__construct
     * @covers \Ecf\Transaction\PaidTransaction::canConstruct
     * @covers \Ecf\Transaction\PaidTransaction::setTotal
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @expectedException \Ecf\Exception\InvalidOperationException
     */
    public function aPaidTransactionValueShouldNotBeNegative()
    {
        $this->expectException(InvalidOperationException::class);

        $transaction = new BaseTransaction(10, new DateTime());
        new PaidTransaction($transaction, -10, new DateTime());
    }

    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     * @covers \Ecf\Transaction\BaseTransaction::setTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     *
     * @covers \Ecf\Transaction\PaidTransaction::__construct
     * @covers \Ecf\Transaction\PaidTransaction::canConstruct
     * @covers \Ecf\Transaction\PaidTransaction::setTotal
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @expectedException \Ecf\Exception\InvalidOperationException
     */
    public function aPaidTransactionValueShouldNotBeGreaterThanBaseTotalValue()
    {
        $this->expectException(InvalidOperationException::class);

        $transaction = new BaseTransaction(10, new DateTime());
        new PaidTransaction($transaction, 50, new DateTime());
    }

    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     * @covers \Ecf\Transaction\BaseTransaction::setTotal
     *
     * @covers \Ecf\Transaction\PaidTransaction::__construct
     * @covers \Ecf\Transaction\PaidTransaction::canConstruct
     * @covers \Ecf\Transaction\PaidTransaction::getTotalPaid
     * @covers \Ecf\Transaction\PaidTransaction::setTotal
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @throws InvalidOperationException
     */
    public function aPaidTransactionShouldAddValueToTotalPaid()
    {
        $transaction = new BaseTransaction(10, new DateTime());
        $transaction = new PaidTransaction($transaction, 7, new DateTime());

        $this->assertEquals(7,$transaction->getTotalPaid());
    }

    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     * @covers \Ecf\Transaction\BaseTransaction::setTotal
     *
     * @covers \Ecf\Transaction\PaidTransaction::__construct
     * @covers \Ecf\Transaction\PaidTransaction::canConstruct
     * @covers \Ecf\Transaction\PaidTransaction::setTotal
     *
     * @covers \Ecf\Transaction\TransactionDecorator::__construct
     *
     * @expectedException  InvalidOperationException
     */
    public function aPaidTransactionShouldNotPaidAAlreadyPaidTransaction()
    {
        $this->expectException(InvalidOperationException::class);

        $transaction = new BaseTransaction(10,new DateTime());
        $transaction = new PaidTransaction($transaction,1,new DateTime());

        new PaidTransaction($transaction,2,new DateTime());
    }


    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
     * @covers \Ecf\Transaction\BaseTransaction::setTotal
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
    public function aPaidTransactionShouldRetrieveTheCorrectTransactionValues()
    {
        $transaction = new BaseTransaction(10,new DateTime());
        $transaction = new PaidTransaction($transaction,2,new DateTime());

        $this->assertEquals(10,$transaction->getTotal());
        $this->assertEquals(2,$transaction->getTotalPaid());
        $this->assertEquals(0,$transaction->getTotalCanceled());
    }
}
