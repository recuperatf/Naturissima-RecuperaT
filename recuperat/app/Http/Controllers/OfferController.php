<?php

namespace App\Http\Controllers;

use App\Offer;
use App\OfferType;
use App\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("offer.index")->with("offers", Offer::all());
    }

    public function indexForClients()
    {
        $offers = Offer::all();
        $activeOffers = $offers->filter(function ($offer) {
            $startDate = $offer->start_date;
            $endDate = $offer->endDate;
            return $startDate && $endDate && $startDate->isPast() && $endDate->isFuture();
        });
        return view("offer.index_for_clients")->with("offers", $activeOffers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("offer.edit")->with("types", OfferType::all())->with("products", Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'products' => 'required',
        ], [
            'name.required' => 'El nombre de la oferta es requerido',
            'products.required' => 'Una oferta debe tener por lo menos un producto'
        ]);

        $A_request = $request->all();
        $A_request["json_conditions"]["week_days"] = isset($A_request["json_conditions"]["week_days"]) ? $A_request["json_conditions"]["week_days"] : "";
        $A_request["json_conditions"] = json_encode($A_request["json_conditions"]);
        unset($A_request["products"]);
        unset($A_request["none"]);

        if (isset($A_request["img"])) {
            $Img_product_image = $A_request["img"];
            $S_image_name = time() . uniqid(rand()) . "." . $Img_product_image->getClientOriginalExtension();
            $A_request["img"] = $S_image_name;
            if ($request->product_category_id == 1) {
                $A_request["img"] = "promociones/" . $A_request["img"];
            }
            $images_path = public_path("images/promociones/");
            $res = $Img_product_image->move($images_path, $S_image_name);
        } else {
            $A_request == null;
        }

        $offer = new Offer($A_request);



        $offer->save();
        foreach ($request->all()["products"] as $product) {
            $offer->products()->attach($product["id"], ['qty' => $product["qty"]]);
        }
        return view("offer.edit")->with("message", "Oferta creada!")->with("types", OfferType::all())->with("products", Product::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $oferta)
    {
        return view("offer.edit")->with("O_offer", $oferta)->with("types", OfferType::all())->with("products", Product::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $oferta)
    {
        return view("offer.edit")->with("O_offer", $oferta)->with("types", OfferType::all())->with("products", Product::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $oferta)
    {
        $A_request = $request->all();
        $A_request["json_conditions"]["week_days"] = isset($A_request["json_conditions"]["week_days"]) ? $A_request["json_conditions"]["week_days"] : "";
        $A_request["json_conditions"] = json_encode($A_request["json_conditions"]);
        unset($A_request["products"]);
        unset($A_request["none"]);
        if (!empty($A_request['img'])) {
            $Img_product_image = $A_request["img"];
            $S_image_name = time() . uniqid(rand()) . "." . $Img_product_image->getClientOriginalExtension();
            $A_request["img"] = $S_image_name;
            if ($request->product_category_id == 1) {
                $A_request["img"] = "promociones/" . $A_request["img"];
            }
            $images_path = public_path("images/promociones/");
            $res = $Img_product_image->move($images_path, $S_image_name);
        } elseif (empty($A_request['previous_image'])) {
            $A_request['img'] = null;
        }
        unset($A_request["previous_image"]);
        $oferta->update($A_request);
        $oferta->products()->detach();
        if (!empty($request->all()["products"])) {
            foreach ($request->all()["products"] as $product) {
                $oferta->products()->attach($product["id"], ['qty' => $product["qty"]]);
            }
        }
        return redirect(route("ofertas.index"))->with("status", "Tu oferta ha sido modificada");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $oferta)
    {
        $oferta->delete();
        return redirect(route("ofertas.index"))->with("status", "La oferta ha sido eliminada");
    }
}
