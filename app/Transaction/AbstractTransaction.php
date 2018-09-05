<?php

namespace Ecf\Transaction;

use DateTime;
use Ecf\Base\ValueObjectInterface;
use Ecf\Exception\InvalidOperationException;

abstract class AbstractTransaction implements ValueObjectInterface
{
    /**
     * The total of the transaction
     *
     * @var int
     */
    protected $total;
    /**
     * The total that was paid.
     *
     * @var int
     */
    protected $totalPaid;
    /**
     * The total tha was canceled
     *
     * @var int
     */
    protected $totalCanceled;
    /**
     * The creation date & time of the transaction
     *
     * @var DateTime
     */
    protected $createdAt;

    /**
     * AbstractTransaction constructor.
     *
     * @param  int      $total
     * @param  DateTime $createdAt
     * @throws InvalidOperationException
     */
    public function __construct($total, DateTime $createdAt)
    {
        $this->setTotal($total);
        $this->setCreatedAt($createdAt);

        $this->totalPaid = 0;
        $this->totalCanceled = 0;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param AbstractTransaction $valueObject
     *
     * @return boolean
     */
    public function equals(ValueObjectInterface $valueObject)
    {
        return
            is_a($valueObject,static::class) &&
            $this->getTotal() === $valueObject->getTotal() &&
            $this->getTotalPaid() === $valueObject->getTotalPaid() &&
            $this->getTotalCanceled() === $valueObject->getTotalCanceled();
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

    /**
     * @param DateTime $createdAt
     */
    protected function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    abstract public function getTotalPaid();

    /**
     * @return int
     */
    abstract public function getTotalCanceled();

    /**
     * @return int
     */
    abstract public function getTotal();
}
