<?php

namespace Strategy\Order;

use Exception;
use Strategy\Invoice\InvoiceStrategy;
use Strategy\Payments\PaymentStrategy;

class Order
{
	protected $name;
	protected $email;
	protected $address;
	protected $items;
	protected $total;
	protected $paymentMethod;
	protected $invoiceGenerator;

	public function __construct($customer, $cart)
	{
		$this->name = $customer->getName();
		$this->email = $customer->getEmail();
		$this->address = $customer->getAddress();
		$this->items = $cart->getItems();
		$this->total = $cart->getTotal();
	}

	public function getName()
	{
		return $this->name;
	}

	public function getEmail()
	{
		return $this->email;
	}

    public function getAddress()
	{
		return $this->address;
	}

	public function getItems()
	{
		return $this->items;
	}

	public function getTotal()
	{
		return $this->total;
	}

	public function setPaymentMethod(PaymentStrategy $method)
	{
		$this->paymentMethod = $method;
	}

	public function payInvoice()
	{
		try {
			if (empty($this->paymentMethod)) {
				throw new Exception('Invalid payment method');
			}
	
			$total = $this->total;
			$this->paymentMethod->pay($total);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function setInvoiceGenerator(InvoiceStrategy $generator)
	{
		$this->invoiceGenerator = $generator;
	}

	public function generateInvoice()
	{
		try {
			if (empty($this->invoiceGenerator)) {
				throw new Exception("Invoice generator is missing");
			}
			$this->invoiceGenerator->generate($this);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}