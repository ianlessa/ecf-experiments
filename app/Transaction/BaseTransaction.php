<?php

namespace Ecf\Transaction;


use DateTime;
use Ecf\Exception\InvalidOperationException;

class BaseTransaction extends AbstractTransaction
{

    /**
     * BaseTransaction constructor.
     *
     * @param  int      $total
     * @param  DateTime $createdAt
     * @throws \Ecf\Exception\InvalidOperationException
     */
    public function __construct($total, DateTime $createdAt)
    {
        parent::__construct($total, $createdAt);
    }


    /**
     * @return int
     */
    public function getTotalPaid()
    {
        return $this->totalPaid;
    }

    /**
     * @return int
     */
    public function getTotalCanceled()
    {
        return $this->totalCanceled;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param  int $total
     * @return AbstractTransaction
     * @throws InvalidOperationException
     */
    protected function setTotal($total)
    {
        $intTotal = intval($total);
        if ($intTotal < 0) {
            throw new InvalidOperationException('Total must not be less than 0!');
        }

        $this->total = $intTotal;
        return $this;
    }
}