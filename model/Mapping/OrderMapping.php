<?php

namespace model\Mapping;

use model\Abstract\AbstractMapping,
    DateTime,
    model\Trait\TraitLaundryRoom,
    model\Trait\TraitTestString,
    model\Trait\TraitTestInt,
    Exception;

class OrderMapping extends AbstractMapping
{
    use TraitTestString;
    use TraitTestInt;
    use TraitLaundryRoom;
    private ?int $order_id;
    private DateTime $order_date_created;
    private bool $order_completed;
    private DateTime $order_date_completed;
    private string $order_content;

    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    public function setOrderId(?int $order_id): void
    {
        if(!$this->verifyInt($order_id)) throw new Exception("Id must be an integer");
        $order_id = $this->intClean($order_id);
        $this->order_id = $order_id;
    }

    public function getOrderDateCreated(): DateTime
    {
        return $this->order_date_created;
    }

    public function setOrderDateCreated(DateTime $order_date_created): void
    {
        $this->order_date_created = $order_date_created;
    }

    public function isOrderCompleted(): bool
    {
        return $this->order_completed;
    }

    public function setOrderCompleted(bool $order_completed): void
    {
        $this->order_completed = $order_completed;
    }

    public function getOrderDateCompleted(): DateTime
    {
        return $this->order_date_completed;
    }

    public function setOrderDateCompleted(DateTime $order_date_completed): void
    {
        $this->order_date_completed = $order_date_completed;
    }

    public function getOrderContent(): string
    {
        return $this->order_content;
    }

    public function setOrderContent(string $order_content): void
    {
        $this->order_content = $order_content;
    }


}