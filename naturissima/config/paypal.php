<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', 'sb-oeubj15020@business.example.com'),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', 'AXfv-GRNXWhKrtDpzb6VwgmezDECeTAOzNCtDI_FVEwBMYcvqXMRuesk9WtN1mfvN-GqFCnrRfdoHOZu'),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', 'EFsMddD-zeTDrE6_ztuSRXiw-wyxvimpQEsKrD-xOECVM_uyUacpDHI89TUSoikI5Cd3k-jJsTNAghWK'),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', 'AYaolBZqBp3tKLKYhTxO5cxsAS4TAL.0mEi.y8tllWB.T51V1EJd96kk'),
        'app_id'      => 'APP-80W284485P519543T', // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', ''),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', ''),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => '', // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
