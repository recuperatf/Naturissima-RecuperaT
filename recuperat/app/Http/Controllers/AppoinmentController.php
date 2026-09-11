<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Appoinment;
use \App\State;
use \App\Product;
use \App\Clinic;
use \App\ProductCategory;
use \App\Order;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\AppointmentConfirmation;
use Carbon\Carbon;

class AppoinmentController extends Controller
{
    /**
     * Create a new controller instance. Middleware can_see_apoinments is applied to index method.
     */
    public function __construct()
    {
        $this->middleware("can_see_apoinments")->only("index");
    }

    /**
     * Creates the view for the creation of a new appointment.
     * @return mixed|\Illuminate\View\View
     */
    public function create()
    {
        $states = State::all();
        $therapies = Product::where('product_category_id', 1)->where('active', true)->where('name', 'like', '%onsulta%')->get();
        return view('appoinments.create')->with([
            'product_therapies' => $therapies->pluck('name', 'id'),
            'states' => $states,
            'clinics' => Clinic::all()
        ]);
    }

    /**
     * Creates the view for the creation of a new appointment for a product (which is can include services).
     * @param $product_id
     * @return mixed|\Illuminate\View\View
     */
    public function create_appointment_for_product($product_id)
    {
        $states = State::all();
        $product = Product::find($product_id);
        return view("appoinments.create_for_product")->
            with('states', $states)->
            with("product", $product);
    }

    /**
     * Creates the view for the creation of a new appointment for a product (which is can include services).
     * @param $product_id
     * @return mixed|\Illuminate\View\View
     */

    public function destroy($product_id)
    {
        Order::find($product_id)->delete();
        return redirect(route('appoinments.index'));
    }

    /**
     * Creates the view for the creation of a new appointment for a product (which is can include services).
     * @param $product_id
     * @return mixed|\Illuminate\View\View
     */

    public function store(Request $request)
    {
        set_time_limit(60);
        $this->validate($request, [
            'appoinment_patient_name' => 'required',
            'telephone' => 'required|max:15',
            'appoinment_date' => 'required|after:yesterday',
            'appoinment_time' => 'required',
            'clinic_id' => 'required|gt:0'
        ], [
            'appoinment_patient_name.required' => 'Por favor define el nombre del paciente',
            'telephone.required' => 'Por favor define un numero de telefono',
            'telephone.max' => 'El telefono no debería tener más de 15 caracteres',
            'appoinment_date.required' => 'Por favor define un día para la cita',
            'appoinment_date.after' => 'La fecha debe ser para el día de hoy o posterior',
            'appoinment_time.required' => 'Selecciona una hora',
            'clinic_id.gt' => 'Debes seleccionar una clínica',
        ]);

        $A_request = $request->all();
        $A_request["appoinment_date"] = (!empty($A_request["appoinment_date"]) ? $A_request["appoinment_date"] : "") . " " . (!empty($A_request["appoinment_time"]) ? $A_request["appoinment_time"] : "");
        $A_request["buyer_name"] = $A_request['appoinment_patient_name'];
        unset($A_request["appoinment_time"]);
        unset($A_request["redirect"]);
        unset($A_request["telephone_card"]);
        unset($A_request["buyer_expire_month"]);
        unset($A_request["buyer_expire_year"]);
        unset($A_request["buyer_security_code"]);
        unset($A_request["deviceIdHiddenFieldName"]);
        unset($A_request["_token"]);
        if (Auth::user() && !empty($A_request['user_id'])) {
            $A_request["user_id"] = Auth::id();
        }
        $appoinment = new Appoinment($A_request);
        $appoinment->save();
        try {
            Mail::to('recuperatf@gmail.com')->send(new AppointmentConfirmation(Order::find($appoinment->id)));
            Mail::to('luise.ruelasz@gmail.com')->send(new AppointmentConfirmation(Order::find($appoinment->id)));
            Mail::to('marieli140765@gmail.com')->send(new AppointmentConfirmation(Order::find($appoinment->id)));
            Mail::to('adcor98@hotmail.com')->send(new AppointmentConfirmation(Order::find($appoinment->id)));
            Mail::to('rocioelizabethfisioterapia@gmail.com')->send(new AppointmentConfirmation(Order::find($appoinment->id)));
        } catch (\Exception $e) {
            return redirect(route('answer.create'))->with('error', 'Lo sentimos, algo salió mal.');
        }
        return redirect(action("AppoinmentController@create_appointment_for_product", $A_request['product_id']))->with('message', 'Tu cita ha sido creada, muchas gracias por reservar con nosotros');
    }

    /**
     * Creates the view for the display of all appointments.
     * @param $product_id
     * @return mixed|\Illuminate\View\View
     */
    public function index()
    {
        return view("appoinments.index")->with(["appoinments" => Order::where("appoinment_date", "!=", null)->get()]);
    }

    /**
     * Creates an interaction point with javascript for getting all the apointments by filtered date.
     * @param $product_id
     * @return mixed|\Illuminate\View\View
     */
    public function ajax_get_appoinments_from_date($date)
    {
        $orders = Order::whereDate("appoinment_date", "=", $date)->get();
        return view("ajax.ajax")->with("appoinments", $orders);
    }

    /**
     * Creates an interaction point with javascript for getting all the apointments by filtered date.
     * @param $product_id
     * @return mixed|\Illuminate\View\View
     */
    public function ajax_json_get_appoinments_from_date($date)
    {
        $orders = Order::whereDate("appoinment_date", "=", $date)->get();
        return response()->json($orders, 200);
    }

    /**
     * Creates an interaction point with javascript for getting all remaining available times after considering existing apointments.
     * @param $product_id
     * @return mixed|\Illuminate\View\View
     */
    public function ajax_get_remaining_times_from_date($date = false, $clinic_id = false)
    {
        $array_hours = [];
        $carbonDate = Carbon::parse($date);
        $weekDay = $carbonDate->weekday();
        $minHour = 8; //exclusive
        $maxHour = 20; // exclusive
        if ($weekDay == 5) {
            $maxHour = 14;
        }
        if ($weekDay == 6) {
            return ['No está disponible'];
        }
        for ($i = 0; $i < 25; $i++) {
            if ($i > $minHour && $i < $maxHour) {
                $array_hours[(($i >= 10) ? $i : ("0" . $i)) . ":00:00"] = (($i >= 10) ? $i : ("0" . $i)) . ":00";
            }
        }
        if ($date) {
            $builder = Order::where("appoinment_date", 'like', $date . '%');
            if ($clinic_id) {
                $builder->where('clinic_id', $clinic_id);
            }
            $A_appoinments_dates = $builder->get()->pluck("appoinment_date");
            foreach ($A_appoinments_dates as $key => $date_time) {
                $array_hours_key = explode(" ", $date_time)[1];
                unset($array_hours[$array_hours_key]);
            }
        }
        return $array_hours;
    }

    /**
     * Creates an interaction point with javascript for getting all therapies available (services).
     * @param $product_id
     * @return mixed|\Illuminate\View\View
     */
    public function ajax_json_get_all_therapies()
    {
        return Product::all()->where('product_category_id', 1)->where('active', true)->pluck('name', 'id');
    }
}
