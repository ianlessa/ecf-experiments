<?php

namespace Ecf\Transaction;

use DateTime;
use Ecf\Base\Exceptions\InvalidOperationException;

class PaidTransaction extends TransactionDecorator
{

    public function __construct(AbstractTransaction $transaction, $value, DateTime $createdAt)
    {

        if (!$this->canConstruct($transaction)) {
            throw new InvalidOperationException('Transaction already paid!');
        }

        parent::__construct($transaction, $value, $createdAt);
    }

    /**
     * @return int
     */
    public function getTotalPaid()
    {
        return $this->total + $this->transaction->getTotalPaid();
    }

    /**
     * @return int
     */
    public function getTotalCanceled()
    {
        return $this->transaction->getTotalCanceled();
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->transaction->getTotal();
    }

    /**
     * @param  int $total
     * @return AbstractTransaction
     * @throws InvalidOperationException
     */
    protected function setTotal($total)
    {
        $intTotal = intval($total);

        $newTotalPaid = $this->transaction->getTotalPaid() + $total;

        if ($newTotalPaid > $this->transaction->getTotal()) {
            throw new InvalidOperationException(
                "New paid total plus total is greater than total! " .
                "{$newTotalPaid} > {$this->transaction->getTotalPaid()}"
            );
        }

        parent::setTotal($intTotal);

        return $this;
    }

    private function canConstruct($transaction)
    {
        $currentTransaction = $transaction;
        while (is_a($currentTransaction, TransactionDecorator::class)) {
            if (is_a($currentTransaction, self::class)) {
                return false;
            }
            /**
             * @var TransactionDecorator $currentTransaction
             */
            $currentTransaction = $currentTransaction->getTransaction();
        }

        return true;
    }
}
