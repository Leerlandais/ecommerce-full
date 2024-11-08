<?php

namespace model\Mapping;

use model\Abstract\AbstractMapping,
    model\Trait\TraitLaundryRoom,
    model\Trait\TraitTestString,
    model\Trait\TraitTestInt,
    Exception;

class CategoryMapping extends AbstractMapping
{
    use TraitTestString;
    use TraitTestInt;
    use TraitLaundryRoom;
    protected ?int $cats_id;
    protected ?string $cats_name;
    protected ?string $cats_desc;

    public function getCatsId(): ?int
    {
        return $this->cats_id;
    }

    public function setCatsId(?int $cats_id): void
    {
        if(!$this->verifyInt($cats_id)) throw new Exception("Id must be an integer");
        $cats_id = $this->intClean($cats_id);
        $this->cats_id = $cats_id;
    }

    public function getCatsName(): ?string
    {
        return $this->cats_name;
    }

    public function setCatsName(?string $cats_name): void
    {
        if(!$this->verifyString($cats_name)) throw new Exception("Name must be a string");
        $cats_name = $this->standardClean($cats_name);
        $this->cats_name = $cats_name;
    }

    public function getCatsDesc(): ?string
    {
        return $this->cats_desc;
    }

    public function setCatsDesc(?string $cats_desc): void
    {
        if(!$this->verifyString($cats_desc)) throw new Exception("Description must be a string");
        $cats_desc = $this->standardClean($cats_desc);
        $this->cats_desc = $cats_desc;
    }



} // end class