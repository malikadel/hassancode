<?php
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require_once('../init.php');


  header('Content-Type: application/json');

  $json_str = file_get_contents('php://input');
  $json_obj = json_decode($json_str);
  $intent = null;

  try {
    if (isset($json_obj->payment_method_id)) {
      # Create the PaymentIntent
      $intent = \Stripe\PaymentIntent::create([
        'payment_method' => $json_obj->payment_method_id,
        'amount' => $json_obj->amount,
        'currency' => 'USD',
        'confirmation_method' => 'manual',
        'confirm' => true,
      ]);


/*      $payment_method = \Stripe\PaymentMethod::retrieve($json_obj->payment_method_id);

      $last4 = $payment_method->card->last4;
      $expmonth = $payment_method->card->exp_month;
      $expyear = $payment_method->card->exp_year;

      generatePaymentResponse($intent,$last4,$expmonth,$expyear);
exit;*/
    }
    if (isset($json_obj->payment_intent_id)) {
      $intent = \Stripe\PaymentIntent::retrieve(
        $json_obj->payment_intent_id
      );
      $intent->confirm();
      
    }
    generatePaymentResponse($intent);
    
  } catch (\Stripe\Error\Base $e) {
    # Display error on client
    echo json_encode([
      'error' => $e->getMessage()
    ]);
    //email_on_transaction_error($json_obj,$e->getMessage());
    exit;
  }

  function generatePaymentResponse($intent='',$last4='',$expmonth='',$expyear='') {
    //echo '<pre>';print_r($intent);echo'</pre>';exit;
    $json_str = file_get_contents('php://input');
    $json_obj = json_decode($json_str);
    # Note that if your API version is before 2019-02-11, 'requires_action'
    # appears as 'requires_source_action'.
    if (($intent['status'] == 'requires_action' or $intent['status'] == 'requires_source_action') &&
            $intent['next_action']['type'] == 'use_stripe_sdk') {
      # Tell the client to handle the action
      echo json_encode([
        'requires_action' => true,
        'payment_intent_client_secret' => $intent->client_secret,
        'token'=> $intent->id,
        'PaymentType'=>'Authorized',
        'Amount'=>($json_obj->amount/100),
      ]);exit;

    } else if ($intent->status == 'succeeded') {
        $post = [
        'token'=> $intent->id,
        'PaymentType'=>'Approved',
        'Amount'=>($json_obj->amount/100),
        ];
        $post['getcall'] = true;
        $post['success'] = true;
        echo json_encode($post);exit;
      } else {
      # Invalid status
      //http_response_code(500);
      echo json_encode(['error' => 'Invalid PaymentIntent status']);
      //email_on_transaction_error($json_obj,'Invalid PaymentIntent status');
      exit;
    }
  }

?>


​
