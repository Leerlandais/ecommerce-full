<?php

namespace model\Mapping;

use model\Abstract\AbstractMapping;

class UserMapping extends AbstractMapping
{
    protected ?int $user_id;
    protected ?string $user_username;
    protected ?string $user_password;
    protected ?string $user_fullname;
    protected ?string $user_email;
    protected ?string $user_address;
    protected ?string $user_uniqid;
    protected ?array $user_roles;



} // end class