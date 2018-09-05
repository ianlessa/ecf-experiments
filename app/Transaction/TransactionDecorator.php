<?php

namespace Ecf\Transaction;

use DateTime;

abstract class TransactionDecorator extends AbstractTransaction
{
    /**
     * @var AbstractTransaction
     */
    protected $transaction;

    public function __construct(AbstractTransaction $transaction, $value, DateTime $createdAt)
    {
        $this->transaction = $transaction;
        parent::__construct($value, $createdAt);
    }
}