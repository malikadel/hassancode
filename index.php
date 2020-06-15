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
        border: 2px solid #0089D7;
        /*border-radius: 4px;*/
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
      }
      #card-cvc{border-bottom: 2px solid #0089D7; border-left:2px solid #0089D7; border-right:2px solid #0089D7; border-top:0px solid #0089D7; float:left; width:50%;}
      #card-expiry{border-bottom: 2px solid #0089D7;border-right:2px solid #0089D7; border-top:0px solid #0089D7; border-left:0px solid #0089D7; float:left; width:50%;}
      .StripeElement--focus,#card-cvc--focus,#card-expiry--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
        border:2px solid #0089D7;
      }
      .StripeElement--invalid {
        border-color: #fa755a;
      }
      .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
      }
      #error-stripe{color:green;font-weight:bold;}
      .hide{display:none;}
      .btn-cstm
      {
        background: #ededed;
        border: 1px solid #ccc;
        color: #333;
        padding: 8px 10px;
        cursor: pointer;
        line-height: 1.2em;
        font-size: 1em;
      }
      .amount-input-box
      {
        width:300px;
      }
      .caution-clr{color: #a00;}
  </style>
        <script type="text/javascript">
          function populate_price(price)
          {  
            $("#amount").val(price);
            $("#finalamount").val('$'+price);
          }
          function initiate_price()
          {
            $("#amount").val('');
            $("#amount").focus(); 
          }
      $(document).ready(function(){
        $('#stripe').click(function () {
          $(".paypal-holder").addClass("hide");
          $(".stripe-holder").removeClass("hide");
        });

        $('#paypal').click(function () {
          $(".stripe-holder").addClass("hide");
          $(".paypal-holder").removeClass("hide");
         });

        $("#amount").change(function(a,b) {
          var am = $("#amount").val();
          $("#finalamount").val('$'+am);
        });
     });
    </script>
<script src="https://www.paypal.com/sdk/js?client-id=AbFW7dg86asszPcQM7siqc_WgNUhmwdWQExnUSpKRPR8ZB7Upkdx3yTV1pffsbiLqWPpxhMP4WTAu_VK"></script>

</head>
<body>

<div class="container">
  <br><br>

<h2>Donate for us</h2>

  <form id="payment-form" method="post" enctype="utf-8">


    <button type="button" class="btn btn-light btn-sm btn-cstm" onClick="populate_price(1);">$1.00</button>
    <button type="button" class="btn btn-light btn-sm btn-cstm" onClick="populate_price(20);">$20.00</button>
    <button type="button" class="btn btn-light btn-sm btn-cstm" onClick="populate_price(50);">$50.00</button>
    <button type="button" class="btn btn-light btn-sm btn-cstm" onClick="populate_price(100);">$100.00</button>
    <button type="button" class="btn btn-light btn-sm btn-cstm" onClick="populate_price(300);">$300.00</button>
    <button type="button" class="btn btn-light btn-sm btn-cstm" onClick="populate_price(500);">$500.00</button>
   <button type="button" class="btn btn-light btn-sm btn-cstm" onClick="initiate_price();">Give a Custom Amount</button>
    <br>
    <br>



    <div class="input-group mb-3 amount-input-box" >
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input type="number" id="amount" class="form-control" aria-label="Amount (to the nearest dollar)" name="amount">

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
      <label for="fname" class="fontlow boldelem">First Name <span class="caution-clr">*</span></label>
      <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" required>
    </div>
    <div class="form-group">
      <label for="lname" class="fontlow boldelem">Last Name:</label>
      <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname">
    </div>
    <div class="form-group">
      <label for="email" class="fontlow boldelem">Email <span class="caution-clr">*</span></label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
    <div class="form-group stripe-holder">
      <label class="fontlow boldelem">Card Details</label>
      <div id="card-element"></div>
      
      <div id="card-cvc"></div>
      <div id="card-expiry"></div>
    </div>
    <div class="form-group">
      <div id="error-stripe"></div>
    </div>

    <div class ="form-group paypal-holder hide">
          <div id="paypal-button-container"></div>
          <script>
            paypal.Buttons({
              createOrder: function(data, actions) {
                return actions.order.create({
                  purchase_units: [{
                    amount: {
                      value: $("#amount").val()
                    }
                  }]
                });
              },
              onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                  alert('Transaction completed by ' + details.payer.name.given_name);
                });
              }
            }).render('#paypal-button-container');
          </script>
    </div>
<br>
    <div class="input-group mb-3 mt-5 amount-input-box" >
      <div class="input-group-prepend">
        <span class="input-group-text">Donation Total</span>
      </div>
      <input type="text" id="finalamount" disabled="disabled" class="form-control" aria-label="Amount (to the nearest dollar)">

    </div>


    <button type="button" class="btn btn-danger" id="card-button">Donate Now</button>
  </form>
  <br><br><br>
</div>


    <script src='https://js.stripe.com/v3/'></script>
    <script>    
      var key = '<?php echo $stripe_public_key; ?>';
      var stripe = Stripe(key);
      var elements = stripe.elements();
      hidePostalCode = true;
      var style = {
          base: {
              color: '#0089D7',
              lineHeight: '18px',
              fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
              fontSmoothing: 'antialiased',
              fontSize: '16px',
              '::placeholder': {
                  color: '#ccc'
              }
          },
          invalid: {
              color: '#a07',
              iconColor: '#a07'
          }
      };


      var cardNumber = elements.create('cardNumber', {style: style});
      cardNumber.mount('#card-element');

      var cardExpiry = elements.create('cardExpiry', {style: style});
      cardExpiry.mount('#card-expiry');

      var cardCvc = elements.create('cardCvc', {style: style});
      cardCvc.mount('#card-cvc');





/*      var cardElement = elements.create('card',{ hidePostalCode: true});
      cardElement.mount('#card-element');*/
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


          stripe.createPaymentMethod('card', cardNumber, {
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
        } else if (response.requires_action) {
          stripe.handleCardAction(
            response.payment_intent_client_secret
          ).then(function(result) {
            if (result.error) {
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
