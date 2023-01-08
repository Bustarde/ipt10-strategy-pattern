<?php

namespace Strategy\Customer;

class Customer
{
	protected $name;
	protected $address;
	protected $email;

	public function __construct($name, $address, $email)
	{
		$this->name = $name;
        $this->address = $address;
        $this->email = $email;
	}

    public function getName(){
        return $this->name;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getEmail(){
        return $this->email;
    }
	
}