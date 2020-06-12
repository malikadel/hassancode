<?php include('init.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style type="text/css">
      .boldelem{font-weight: bold;}
      .fontlow{font-size:13px;}
      .btn-custom{background-color: tomato;font-weight: bold;}
      .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 2px solid tomato;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
      }
      .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
      }
      .StripeElement--invalid {
        border-color: #fa755a;
      }
      .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
      }
      #error-stripe{color:green;font-weight:bold;}
      .hide{display:none;}
    </style>
    <script type="text/javascript">
      function populate_price(price)
      {  
        $("#amount").val(price);
      }
/*      $(document).ready(function(){


$('#stripe').click(function () {
   $('#RBtest1').prop('checked', true).checkboxradio('refresh');
   $('#RBtest2').prop('checked', false).checkboxradio('refresh');
 });

 $('#paypal').click(function () {
   $('#RBtest2').prop('checked', true).checkboxradio('refresh');
   $('#RBtest1').prop('checked', false).checkboxradio('refresh');
   $('#test').append('test');
 });




      });*/

    </script>
  <script src="https://www.paypal.com/sdk/js?client-id=AbFW7dg86asszPcQM7siqc_WgNUhmwdWQExnUSpKRPR8ZB7Upkdx3yTV1pffsbiLqWPpxhMP4WTAu_VK"></script>
</head>
<body>

<div class="container">
  <br><br>
  <form id="payment-form" action="payment.php" method="post" enctype="utf-8">
    <button type="button" class="btn btn-light btn-sm" onClick="populate_price(1);">$1.00</button>
    <button type="button" class="btn btn-light btn-sm" onClick="populate_price(20);">$20.00</button>
    <button type="button" class="btn btn-light btn-sm" onClick="populate_price(50);">$50.00</button>
    <button type="button" class="btn btn-light btn-sm" onClick="populate_price(100);">$100.00</button>
    <button type="button" class="btn btn-light btn-sm" onClick="populate_price(300);">$300.00</button>
    <button type="button" class="btn btn-light btn-sm" onClick="populate_price(500);">$500.00</button>
    <br>
    <br>
    <div class="input-group mb-3" style="width:300px;">
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input type="number" id="amount" class="form-control" aria-label="Amount (to the nearest dollar)" name="amount">
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <br>
    <h6 class="boldelem">Select Payment Method<hr></h6>
    <div class="form-check">
      <label class="form-check-label fontlow boldelem">
        <input type="radio" id="stripe" class="form-check-input" name="paymentmethod" checked="checked">Card Payments
      </label>
    </div>
    <div class="form-check">
      <label class="form-check-label fontlow boldelem">
        <input type="radio" id="paypal" class="form-check-input fontlow boldelem" name="paymentmethod">Paypal
      </label>
    </div>
    <br>
    <h6 class="boldelem">Personal Info<hr></h6>
    <div class="form-group">
      <label for="fname" class="fontlow boldelem">First Name:</label>
      <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname">
    </div>
    <div class="form-group">
      <label for="lname" class="fontlow boldelem">Last Name:</label>
      <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname">
    </div>
    <div class="form-group">
      <label for="email" class="fontlow boldelem">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label class="fontlow boldelem">Card Details</label>
      <div id="card-element"></div>
      <div id="error-stripe"></div>
    </div>
    <div class ="form-group hide">
      <div id="paypal-button-container"></div>
      <script>
        paypal.Buttons().render('#paypal-button-container');
      </script>
    </div>
  </form>
  <br><br><br>
</div>


    <script src='https://js.stripe.com/v3/'></script>
    <script>    
      var key = '<?php echo $stripe_public_key; ?>';
      var stripe = Stripe(key);
      var elements = stripe.elements();

      var cardElement = elements.create('card',{ hidePostalCode: true});
      cardElement.mount('#card-element');
      var cardButton = document.getElementById('card-button');
      $(document).ready(function () {




        cardButton.addEventListener('click', function(ev) {


          $('#card-button').prop('disabled', true);

      var fname = document.getElementById('fname').value;
      var lname = document.getElementById('lname').value;
      var fullname = fname+' '+lname;

      var allAreFilled = true;
      document.getElementById("payment-form").querySelectorAll("[required]").forEach(function(i) {
      if (!allAreFilled) return;
      if (!i.value) allAreFilled = false;
      });
      if (!allAreFilled) 
      {
          $('#card-button').prop('disabled', false);
          $("#card-button").removeClass('disable-button-class-ssp');
          
          $('#error-stripe').css('color','tomato');
          $('#error-stripe').html('All fields are Required.');
          return false;
      }


          stripe.createPaymentMethod('card', cardElement, {
            billing_details: {
                name: fullname,
                email:$("#email").val()}
          }).then(function(result) {

            $("#error-amount").html();
            if (result.error) {
              jQuery('#error-stripe').css('color','tomato');
              jQuery('#error-stripe').html(result.error);
              $("#card-button").prop('disabled', false);
            } else {

              var amount = ($("#amount").val())*100;

              var fname = document.getElementById('fname').value;
              var lname = document.getElementById('lname').value;
              var fullname = fname+' '+lname;
              var email = $("#email").val();



              var payments = JSON.stringify({ 
                payment_method_id: result.paymentMethod.id, 
                name : fullname,
                email : email,
                amount: amount,
              });
              $.ajax({
                url: '<?php echo $ajaxpath; ?>confirm_payment.php',
                type : "POST",
                dataType : 'json',
                data : payments,
                success : function(result) {
                    var jsonres = JSON.stringify(result);
                    handleServerResponse(result,$);

                },
                error: function(xhr, resp, text) {
                  console.log(text);
                  jQuery('#error-stripe').css('color','tomato');
                    jQuery('#error-stripe').html('Some Thing broken.');
                    $("#card-button").prop('disabled', false);
                }});
            }
          });
        });

      });

      function handleServerResponse(response,$) {
        if (response.error) {
            $("#card-button").prop('disabled', false);
          // Show error from server on payment form
        } else if (response.requires_action) {
          // Use Stripe.js to handle required card action
          stripe.handleCardAction(
            response.payment_intent_client_secret
          ).then(function(result) {
            if (result.error) {
              // Show error in payment form
              $('#error-stripe').css('color','tomato');
              $('#error-stripe').html(result.error.message);
              $("#card-button").prop('disabled', false);
            } else {
              //console.log(result);
              var amount = $("#amount").val()*100;
              var fname = document.getElementById('fname').value;
              var lname = document.getElementById('lname').value;
              var fullname = fname+' '+lname;
              var email = $("#email").val();

              var payments = JSON.stringify({ 
                payment_intent_id: result.paymentIntent.id, 
                amount : amount,
                name : fullname,
                email : email,
              });
              $.ajax({
                url: '<?php echo $ajaxpath; ?>reconfirm_payment.php',
                type : "POST",
                data : payments,
                success : function(result) {
                    console.log(result);
                    $('#error-stripe').css('color','green');
                    $('#error-stripe').html('Payment is successfully Authorized(SCA).');

                },
                error: function(xhr, resp, text) {
                    console.log(text);
                    $('#error-stripe').css('color','tomato');
                    $('#error-stripe').html('Some Thing broken.');
                    $("#card-button").prop('disabled', false);
                    $("#card-button").removeClass('disable-button-class-ssp');
                }});

            }
          });
        } else {
          // Show success message
            $('#error-stripe').css('color','green');
            $('#error-stripe').html('Payment is successfully completed(Non Sca).');
        }
      }
      </script>

</body>
</html>
