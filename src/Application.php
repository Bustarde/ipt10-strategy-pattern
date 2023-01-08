<?php

namespace Strategy;

use Strategy\Cart\Item;
use Strategy\Cart\ShoppingCart;
use Strategy\Order\Order;
use Strategy\Invoice\TextInvoice;
use Strategy\Invoice\PDFInvoice;
use Strategy\Customer\Customer;
use Strategy\Payments\CashOnDelivery;
use Strategy\Payments\CreditCardPayment;
use Strategy\Payments\PaypalPayment;

class Application
{
    public static function run()
    {
        $apple = new Item('APPLE', 'An apple fruit', 100);
        $orange = new Item('ORANGE', 'An orange fruit', 200);
        $kiwi = new Item('KIWI', 'A kiwi fruit', 250);

        $cart = new ShoppingCart();
        $cart->addItem($kiwi, 2);
        $cart->addItem($apple, 6);

        $customer = new Customer('John Doe', 'Angeles City', 'johndoe@gmail.com');
        
        $order = new Order($customer, $cart);

        $text_invoice = new TextInvoice();
        $order->setInvoiceGenerator($text_invoice);
        $text_invoice->generate($order);

        $cash_on_delivery = new CashOnDelivery($customer);
        $order->setPaymentMethod($cash_on_delivery);
        $order->payInvoice();
        
        echo "\n ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";

        $cart2 = new ShoppingCart();
        $cart2->addItem($orange,1);
        $cart2->addItem($apple,1);
        $cart2->addItem($kiwi,1);

        $order2 = new Order($customer, $cart2);

        $pdf_invoice = new PDFInvoice();
        $order2->setInvoiceGenerator($pdf_invoice);
        $pdf_invoice->generate($order2);

        $paypal_payment = new PaypalPayment('johndoe@gmail.com', '75467867');
        $order2->setPaymentMethod($paypal_payment);
        $order2->payInvoice();

        echo "\n ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";

        $customer2 = new Customer('Jane Doe', 'Tarlac', 'janedoe@gmail.com');

        $cart3 = new ShoppingCart();
        $cart3->addItem($kiwi, 10);

        $order3 = new Order($customer2, $cart3);
        $order3->setInvoiceGenerator($text_invoice);
        $text_invoice->generate($order3);

        $credit_card_payment = new CreditCardPayment('Jane Doe', '12121212', '8989', '11/25');
        $order3->setPaymentMethod($credit_card_payment);
        $order3->payInvoice();
    }
}