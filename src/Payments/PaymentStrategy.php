<?php

namespace Strategy\Payments;

interface PaymentStrategy
{
	public function pay($amount);
}