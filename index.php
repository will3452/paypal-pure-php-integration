<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script
    src="https://www.paypal.com/sdk/js?client-id=<YOUR_CLIENT_ID_HERE>&currency=PHP"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
  </script>
    <div style="display:flex;">
        <img src="./product.png" width="300" alt="">
        <div >
            <h2>
                Chocolate
            </h2>
            <h3>
                Price: PHP 250.00
            </h3>
        </div>
    </div>

   

  <div id="paypal-button-container"></div>

  <script>
    paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '250.00'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        window.location.href="/PayPalIntegration/transaction-completed.php?orderID="+data.orderID;
      });
    }
  }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
  </script>
</body>
</html>
<!-- https://developer.paypal.com/docs/checkout/integrate/ -->