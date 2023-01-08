<?php

namespace Strategy\Invoice;

use Strategy\Order\Order;

interface InvoiceStrategy
{
	public function generate(Order $order);
}