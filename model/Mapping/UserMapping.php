<?php

namespace model\Mapping;

use model\Abstract\AbstractMapping,
    model\Trait\TraitLaundryRoom,
    model\Trait\TraitTestString,
    model\Trait\TraitTestInt,
    Exception;

class UserMapping extends AbstractMapping
{
    use TraitTestString;
    use TraitTestInt;
    use TraitLaundryRoom;
    protected ?int $user_id;
    protected ?string $user_username;
    protected ?string $user_password;
    protected ?string $user_fullname;
    protected ?string $user_email;
    protected ?string $user_address;
    protected ?string $user_uniqid;
    protected ?string $user_roles;

    private function verifyUserRoles($roles) {
        if (is_string($roles)) {
            $roles = json_decode($roles, true);
        }

        if (!is_array($roles)) {
            return false;
        }
        $permittedRoles = ["ROLE_SUPER", "ROLE_ADMIN", "ROLE_USER"];

        foreach ($roles as $role) {
            if (!in_array($role, $permittedRoles)) {
                return false;
            }
        }
        return true;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): void
    {
        if(!$this->verifyInt($user_id)) throw new Exception('Id must be an integer');
        $user_id = $this->intClean($user_id);
        $this->user_id = $user_id;
    }

    public function getUserUsername(): ?string
    {
        return $this->user_username;
    }

    public function setUserUsername(?string $user_username): void
    {
        if(!$this->verifyString($user_username)) throw new Exception('Username must be a string');
        $user_username = $this->standardClean($user_username);
        $this->user_username = $user_username;
    }

    public function getUserPassword(): ?string
    {
        return $this->user_password;
    }

    public function setUserPassword(?string $user_password): void
    {
        if(!$this->verifyString($user_password)) throw new Exception('Password must be a string');
        $this->user_password = $user_password;
    }

    public function getUserFullname(): ?string
    {
        return $this->user_fullname;
    }

    public function setUserFullname(?string $user_fullname): void
    {
        if(!$this->verifyString($user_fullname)) throw new Exception('Fullname must be a string');
        $user_fullname = $this->standardClean($user_fullname);
        $this->user_fullname = $user_fullname;
    }

    public function getUserEmail(): ?string
    {
        return $this->user_email;
    }

    public function setUserEmail(?string $user_email): void
    {
        if(!$this->verifyString($user_email)) throw new Exception('Email must be a string');
        $user_email = $this->emailClean($user_email);
        $this->user_email = $user_email;
    }

    public function getUserAddress(): ?string
    {
        return $this->user_address;
    }

    public function setUserAddress(?string $user_address): void
    {
        if(!$this->verifyString($user_address)) throw new Exception('Address must be a string');
        $user_address = $this->standardClean($user_address);
        $this->user_address = $user_address;
    }

    public function getUserUniqid(): ?string
    {
        return $this->user_uniqid;
    }

    public function setUserUniqid(?string $user_uniqid): void
    {
        if(!$this->verifyString($user_uniqid)) throw new Exception('Uniqid must be a string');
        $user_uniqid = $this->standardClean($user_uniqid);
        $this->user_uniqid = $user_uniqid;
    }

    public function getUserRoles(): ?string
    {
        return $this->user_roles;
    }

    public function setUserRoles(?string $user_roles): void
    {

        if(!$this->verifyString($user_roles)) throw new Exception('Roles must be an string');
        if(!$this->verifyUserRoles($user_roles)) throw new Exception('Role not acceptable');
        $this->user_roles = $user_roles;
    }



} // end class