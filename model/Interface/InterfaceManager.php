<?php

namespace model\Interface;

use model\MyPDO;
use Exception;

use model\Abstract\AbstractMapping;


interface InterfaceManager
{
    public function __construct(MyPDO $pdo);

}