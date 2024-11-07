<?php

namespace model\Mapping;

use model\Abstract\AbstractMapping,
    model\Trait\TraitLaundryRoom,
    model\Trait\TraitTestString,
    model\Trait\TraitTestInt,
    Exception;

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
        if(!$this->verifyInt($prod_id)) throw new Exception('Id must be an integer');
        $prod_id = $this->intClean($prod_id);
        $this->prod_id = $prod_id;

    }

    public function getProdName(): ?string
    {
        return $this->prod_name;
    }

    public function setProdName(?string $prod_name): void
    {
        if(!$this->verifyString($prod_name)) throw new Exception('Title cannot be empty');
        $prod_name = $this->standardClean($prod_name);
        $this->$prod_name = $prod_name;
    }

    public function getProdDesc(): ?string
    {
        return $this->prod_desc;
    }

    public function setProdDesc(?string $prod_desc): void
    {
        if(!$this->verifyString($prod_desc)) throw new Exception('Description cannot be empty');
        $prod_desc = $this->standardClean($prod_desc);
        $this->$prod_desc = $prod_desc;
    }

    public function getProdImg(): ?string
    {
        return $this->prod_img;
    }

    public function setProdImg(?string $prod_img): void
    {
        if(!$this->verifyString($prod_img)) throw new Exception('Image location cannot be empty');
        $prod_img = $this->standardClean($prod_img);
        $this->$prod_img = $prod_img;
    }

    public function getProdPrice(): ?string
    {
        return $this->prod_price;
    }

    public function setProdPrice(?string $prod_price): void
    {
        if(!$this->verifyString($prod_price)) throw new Exception('Image location cannot be empty');
        $prod_price = $this->standardClean($prod_price);
        $this->$prod_price = $prod_price;
    }

    public function getProdAmount(): ?int
    {
        return $this->prod_amount;
    }

    public function setProdAmount(?int $prod_amount): void
    {
        if(!$this->verifyInt($prod_amount)) throw new Exception('Id must be an integer');
        $prod_amount = $this->intClean($prod_amount);
        $this->$prod_amount = $prod_amount;
    }



} // end class