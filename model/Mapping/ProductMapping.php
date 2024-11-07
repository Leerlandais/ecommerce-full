<?php

namespace model\Mapping;

use model\Abstract\AbstractMapping;
use model\Trait\TraitLaundryRoom;
use model\Trait\TraitTestString;
use model\Trait\TraitTestInt;

class ProductMapping extends AbstractMapping
{

    use TraitTestString;
    use TraitTestInt;
    use TraitLaundryRoom;

    protected ?int $prod_id;
    protected ?string $prod_name;
    protected ?string $prod_desc;
    protected ?string $prod_img;
    protected ?string $prod_price;
    protected ?int $prod_amount;

    public function getProdId(): ?int
    {
        return $this->prod_id;
    }

    public function setProdId(?int $prod_id): void
    {
        $this->prod_id = $prod_id;
    }

    public function getProdName(): ?string
    {
        return $this->prod_name;
    }

    public function setProdName(?string $prod_name): void
    {
        $this->prod_name = $prod_name;
    }

    public function getProdDesc(): ?string
    {
        return $this->prod_desc;
    }

    public function setProdDesc(?string $prod_desc): void
    {
        $this->prod_desc = $prod_desc;
    }

    public function getProdImg(): ?string
    {
        return $this->prod_img;
    }

    public function setProdImg(?string $prod_img): void
    {
        $this->prod_img = $prod_img;
    }

    public function getProdPrice(): ?string
    {
        return $this->prod_price;
    }

    public function setProdPrice(?string $prod_price): void
    {
        $this->prod_price = $prod_price;
    }

    public function getProdAmount(): ?int
    {
        return $this->prod_amount;
    }

    public function setProdAmount(?int $prod_amount): void
    {
        $this->prod_amount = $prod_amount;
    }



} // end class