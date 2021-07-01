<?php

namespace Sample;

require __DIR__ . '/vendor/autoload.php';
//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

require('./paypal-client.php');

$orderID = $_GET['orderID'];

class GetOrder
{

  // 2. Set up your server to receive a call from the client
  /**
   *You can use this function to retrieve an order by passing order ID as an argument.
   */
  public static function getOrder($orderId)
  {

    // 3. Call PayPal to get the transaction details
    $client = PayPalClient::client();
    $response = $client->execute(new OrdersGetRequest($orderId));
    $orderID = $response->result->id;
    $email = $response->result->payer->email_address;
    $name = $response->result->purchase_units[0]->shipping->name->full_name;
    $address1 = $response->result->purchase_units[0]->address->address_line_1;
    $address2 = $response->result->purchase_units[0]->address->admin_area_1;
    $addres3 = $response->result->purchase_units[0]->address->admin_area_2;
    $address4 = $response->result->purchase_units[0]->address->postal_code;
    $address5 = $response->result->purchase_units[0]->address->country_code;
    $fullAddress = $address1.' '.$address2.' '.$address3.' '.$address4.' '.$address4;

    //save database

    //
    header('Location: ./success.php?name='.$name.'&orderID='.$orderID);

  }
}

/**
 *This driver function invokes the getOrder function to retrieve
 *sample order details.
 *
 *To get the correct order ID, this sample uses createOrder to create an order
 *and then uses the newly-created order ID with GetOrder.
 */
if (!count(debug_backtrace()))
{
  GetOrder::getOrder($orderID, true);
}
?>