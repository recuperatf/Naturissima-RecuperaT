<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Product;
use App\Order;
use App\DownloadLink;
use App\Mail\OrderCreated;
// use Illuminate\Support\Facades\Mail;
use Redirect, Response, DB, Config;
use Mail;

class OpenPayController extends Controller
{

  public function store(Request $request)
  {
    ini_set('max_execution_time', 600);
    // dd($request->all());
    $checkout_final_report = Product::getFinalCheckoutReport($request->products);
    $A_request = $request->all();
    unset(
      $A_request["_token"],
      $A_request["products"],
      $A_request["product"],
      $A_request["buyer_expire_month"],
      $A_request["buyer_expire_year"],
      $A_request["buyer_security_code"],
      $A_request["deviceIdHiddenFieldName"],
      $A_request["token_id"],
      $A_request["telephone_card"]
    );

    //setear automaticamente estado y municipio ya que solo se puede este por el momento
    // $A_request["state_send_address"]=14;
    // $A_request["municipality_send_address"]=651;


    if (isset($A_request["appoinment_date"])) {
      $A_request["appoinment_date"] = $A_request["appoinment_date"] . " " . $A_request["appoinment_time"];
    }
    if ($checkout_final_report) {
      $A_request["json_report"] = json_encode($checkout_final_report);
    }

    //create codes for downloadeble products
    // dd($checkout_final_report);
    $A_request["delivery"] = $request->delivery ? true : false;
    $A_request["store_pickup"] = $request->delivery ? true : false;
    $A_request["telephone"] = $request->card_telephone ? $request->card_telephone : false;
    $order = new Order($A_request);
    unset($A_request["appoinment_time"]);

    unset($A_request["address_visit"]); //usaremos esto para setear la dirección en caso de que este on

    if (!$request->buyer_name) {
      $A_request["buyer_name"] = $request->appoinment_patient_name;
    }
    if (($request->delivery) || ($request->products)) {
      if ($order) {
        try {
          $order->save();
          \Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE', false));
          \Openpay::setSandboxMode(env('OPENPAY_SANDBOX_MODE', true));
          $openpay = \Openpay::getInstance(
            env('OPENPAY_ID', 'none'),
            env('OPENPAY_SK', 'none')
          );
          $customer = array(
            'name' => $request->buyer_name,
            'phone_number' => $request->telephone_card,
            'email' => $request->card_email,
          );
          $method = 'card';
          $chargeData = array(
            'method' => $method,
            'amount' => $checkout_final_report ? $checkout_final_report["total_price"] : Product::find($request->product_id)->price_mxn,
            'device_session_id' => $request->deviceIdHiddenFieldName,
            'description' => 'Cargo Naturissima Farmacias',
            'customer' => $customer,
            "currency" => 'MXN',
          );
          if ($method == 'card') {
            $chargeData['source_id'] = $request->token_id;
            $chargeData['order_id'] = 'ORDEN-CARD-' . $order->id;
          }
          if ($method == 'bank_account') {
            $chargeData['order_id'] = 'ORDEN-BANK-' . $order->id;
          }
          $charge = $openpay->charges->create($chargeData);
          $order->token_id = $charge->id;
          $order->save();
          $C_download_links = new Collection();
          foreach ($checkout_final_report['products'] as $key => $product) {
            $product = Product::find($product['id']);
            if ($product->is_downloadable) {
              $download_link = new DownloadLink();
              $download_link->code = Product::generateRandomCode();
              $download_link->order_id = $order->id;
              $C_download_links->push($product->download_links()->save($download_link));
            }
          }
          //condicionar
        } catch (\OpenpayApiTransactionError $e) {
          if ($e->getErrorCode() == 3001) {
            echo "Su tarjeta ha sido declinada";
          }
          return view('openpay.errors.generic')->with('error', "error en la transaccion" . $e->getErrorCode() . $e->getMessage());
        } catch (\OpenpayApiRequestError $e) {
          return view('openpay.errors.generic')->with('error', 'ERROR on the request: ' . $e->getMessage());

        } catch (\OpenpayApiConnectionError $e) {
          return view('openpay.errors.generic')->with('error', 'ERROR while connecting to the API: ' . $e->getMessage());

        } catch (\OpenpayApiAuthError $e) {
          return view('openpay.errors.generic')->with('error', 'ERROR on the authentication: ' . $e->getMessage());
        } catch (\OpenpayApiError $e) {
          return view('openpay.errors.generic')->with('error', 'ERROR on the API: ' . $e->getMessage());

        } catch (Exception $e) {
          return view('openpay.errors.generic')->with('error', 'Error on the script: ' . $e->getMessage());
        }
      }
    } else {
      unset($order->appoinment_time);
      $order->buyer_name = $order->appoinment_patient_name;
      $order->save();
      return redirect("/")->with("message", "Tu cita ha sido creada, ¡nos vemos pronto!");
    }
    if (!empty($order->card_email)) {
      Mail::to($order->card_email)->send(new OrderCreated($order));
    }
    session()->forget("IDs_cart_products");
    return redirect()->action(
      "OpenPayController@detalles_de_compra",
      [$order->id, (Mail::failures() ? false : true)]
    );
  }
  public function detalles_de_compra($id, $mailstatus)
  {
    $order = Order::find($id);
    return view("openpay.success")->with("order", $order)->with("mail_status", $mailstatus)->with("OrderMessage", "¡Tu compra se realizó con éxito!");
  }
  public function send_email(Order $order)
  {
    Mail::to(request()->all()["email"])->send(new OrderCreated($order));
    return view("openpay.success")->with("order", $order)->with("mail_status", "mail-status", ((Mail::failures()) ? false : true))->with("OrderMessage", "El email se ha re-enviado!");
  }
}