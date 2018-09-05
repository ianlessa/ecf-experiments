<?php

namespace Ecf\Transaction\Tests;

use DateTime;
use Ecf\Transaction\BaseTransaction;
use Ecf\Transaction\PaidTransaction;

class AbstractTransactionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * @covers \Ecf\Transaction\AbstractTransaction::__construct
     * @covers \Ecf\Transaction\AbstractTransaction::equals
     * @covers \Ecf\Transaction\AbstractTransaction::setCreatedAt
     * @covers \Ecf\Transaction\AbstractTransaction::setTotal
     *
     * @covers \Ecf\Transaction\BaseTransaction::__construct
     * @covers \Ecf\Transaction\BaseTransaction::getTotal
     * @covers \Ecf\Transaction\BaseTransaction::getTotalCanceled
     * @covers \Ecf\Transaction\BaseTransaction::getTotalPaid
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
    public function itMustBePossibleToVerifyStructuralEqualityOfTwoTransactions()
    {
        $now = new DateTime();

        $baseTransaction = new BaseTransaction(10, $now);
        $baseTransaction = new PaidTransaction($baseTransaction, 3, $now);

        $sameBaseTransaction = new BaseTransaction(10, $now);
        $sameBaseTransaction = new PaidTransaction($sameBaseTransaction, 3, $now);

        $differentBaseTransaction = new BaseTransaction(10, $now);
        $differentBaseTransaction = new PaidTransaction($differentBaseTransaction, 4, $now);

        $this->assertTrue($baseTransaction->equals($sameBaseTransaction));
        $this->assertFalse($baseTransaction->equals($differentBaseTransaction));
    }
}
