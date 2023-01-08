<?php

namespace Strategy\Invoice;

use Strategy\Invoice\InvoiceStrategy;
use Strategy\Order\Order;

class TextInvoice implements InvoiceStrategy
{
	public function generate(Order $order)
	{
		echo "TEXT INVOICE\n";
		echo "Customer: {$order->getName()} <{$order->getEmail()}>\n";
		echo "-----------------ORDER ITEMS------------------\n";
		foreach ($order->getItems() as $itemData)
		{
			$item = $itemData['item'];
			$quantity = $itemData['quantity'];

			echo $item->getName() . "\t" . $quantity . "\t" . $item->getPrice() . "\t=\t" . ($quantity * $item->getPrice()) . "\n";
		}
		echo "\t\tTotal\t=\t" . $order->getTotal() . "\n";
	}
}