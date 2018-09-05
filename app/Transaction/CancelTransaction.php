<?php

namespace Ecf\Transaction;

use DateTime;
use Ecf\Exception\InvalidOperationException;

class CancelTransaction extends TransactionDecorator
{


    public function __construct(AbstractTransaction $transaction, $value, DateTime $createdAt)
    {
        parent::__construct($transaction, $value, $createdAt);
    }

    /**
     * @param  int $total
     * @return AbstractTransaction
     * @throws InvalidOperationException
     */
    protected function setTotal($total)
    {
        $intTotal = intval($total);

        $newTotalCanceled = $this->transaction->getTotalCanceled() + $total;

        if ($newTotalCanceled > $this->transaction->getTotalPaid()) {
            throw new InvalidOperationException(
                "New cancel total plus total is greater than total paid! " .
                "{$newTotalCanceled} > {$this->transaction->getTotalPaid()}"
            );
        }

        parent::setTotal($intTotal);

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPaid()
    {
        return $this->transaction->getTotalPaid();
    }

    /**
     * @return int
     */
    public function getTotalCanceled()
    {
        return $this->total + $this->transaction->getTotalCanceled();
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->transaction->getTotal();
    }
}
