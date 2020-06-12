<?php

namespace Stripe;

/**
 * Class PaymentIntent
 *
 * @property string $id
 * @property string $object
 * @property int $amount
 * @property int $amount_capturable
 * @property int $amount_received
 * @property string $application
 * @property int $application_fee_amount
 * @property int $canceled_at
 * @property string $cancellation_reason
 * @property string $capture_method
 * @property Collection $charges
 * @property string $client_secret
 * @property string $confirmation_method
 * @property int $created
 * @property string $currency
 * @property string $customer
 * @property string $description
 * @property mixed $last_payment_error
 * @property bool $livemode
 * @property StripeObject $metadata
 * @property mixed $next_action
 * @property string $on_behalf_of
 * @property string $payment_method
 * @property string[] $payment_method_types
 * @property string $receipt_email
 * @property string $review
 * @property mixed $shipping
 * @property string $source
 * @property string $statement_descriptor
 * @property string $status
 * @property mixed $transfer_data
 * @property string $transfer_group
 *
 * @package Stripe
 */
class PaymentIntent extends ApiResource
{

    const OBJECT_NAME = "payment_intent";

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    /**
     * These constants are possible representations of the status field.
     *
     * @link https://stripe.com/docs/api/payment_intents/object#payment_intent_object-status
     */
    const STATUS_CANCELED                = 'canceled';
    const STATUS_PROCESSING              = 'processing';
    const STATUS_REQUIRES_ACTION         = 'requires_action';
    const STATUS_REQUIRES_CAPTURE        = 'requires_capture';
    const STATUS_REQUIRES_CONFIRMATION   = 'requires_confirmation';
    const STATUS_REQUIRES_PAYMENT_METHOD = 'requires_payment_method';
    const STATUS_SUCCEEDED               = 'succeeded';

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return PaymentIntent The canceled payment intent.
     */
    public function cancel($params = null, $options = null)
    {
        $url = $this->instanceUrl() . '/cancel';
        list($response, $opts) = $this->_request('post', $url, $params, $options);
        $this->refreshFrom($response, $opts);
        return $this;
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return PaymentIntent The captured payment intent.
     */
    public function capture($params = null, $options = null)
    {
        $url = $this->instanceUrl() . '/capture';
        list($response, $opts) = $this->_request('post', $url, $params, $options);
        $this->refreshFrom($response, $opts);
        return $this;
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return PaymentIntent The confirmed payment intent.
     */
    public function confirm($params = null, $options = null)
    {
        echo $url = $this->instanceUrl() . '/confirm';
        list($response, $opts) = $this->_request('post', $url, $params, $options);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}


/*
Here are couple of question written in parantheses()

I want to sell social media posts. (Q:will you fetch social media posts from your respective social media account into your website, and users will purchase them from there?)

people can make a profile and then order posts from our service. 
They can buy one basic post or they can buy a custom post or a post with paid advertising and a budget.(Q: So they can buy one random post or all posts using monthly/yearly subscription?)

I want it to be flexible for the client and also as simple as possible for them to p-y for the service once they fill an order.
information we would need for their profile is

name, e-mail p#, facebook business profile, instagram link to profile, twitter and linkedin.

that is one

the simple version



*/