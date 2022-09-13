<?php

class Profile
{
    private static $id;
    private $code;
    private $profile;

    public function __construct(string $code, string $profile)
    {
        self::$id++;
        $this->code = $code;
        $this->profile = $profile;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     */
    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set the value of profile
     */
    public function setProfile($profile): self
    {
        $this->profile = $profile;

        return $this;
    }
}