<?php

namespace Strategy\Cart;

use Strategy\Cart\Item;

class ShoppingCart
{
	protected $items;

	public function __construct()
	{
		$this->items = [];
	}

	public function addItem(Item $item, $quantity = 1)
	{
		array_push($this->items, [
			'item' => $item,
			'quantity' => $quantity
		]);
	}

	public function getTotal()
	{
		$total = 0;
		foreach ($this->items as $itemData)
		{
			$item = $itemData['item'];
			$quantity = $itemData['quantity'];
			$total += $item->getPrice() * $quantity;
		}

		return $total;
	}

	public function displayItems()
	{
		echo "Shopping Cart Items\n";
		foreach ($this->items as $itemData)
		{
			$item = $itemData['item'];
			$quantity = $itemData['quantity'];

			echo $item->getName() . "\t" . $quantity . "\t" . $item->getPrice() . "\t=\t" . ($quantity * $item->getPrice()) . "\n";
		}
		echo "\t\tTotal\t=\t" . $this->getTotal() . "\n\n";
	}

	public function getItems()
	{
		return $this->items;
	}
}