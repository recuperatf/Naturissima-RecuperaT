<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\State;
use App\DownloadLink;
use App\SearchHistory;
use App\Parametrization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use File;
class ProductController extends Controller
{
    const HERBOLOGY_DOCUMENTS = 6;
    const HERBOLOGY_PRESCRIPTIONS_REMEDIES = 7;
    const EVENTS = 8;
    const HEALTH_SERVICES = 9;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $pagination_elements=24;
    public function __construct()
    {
        $this->middleware('is_admin')->except('index','checkout','AJAX_manageCart');
    }
    public function index(Request $request){
        $product_category = false;
        $products=Product::where("active",true);
        if (Auth::user()) {
            if(Auth::user()->rol->id==1)
            {
                $products=new Product();
            }
        }
        $product_category_id=false;
        $product_category_name=false;
        if($request->is_grevill){
            $products=$products->where('is_grevill',true);
        }
        if (($product_category_id=$request->product_category_id)) {
            $product_category = ProductCategory::find($product_category_id);
            $product_category_name=$product_category->name;
            $products=$products->where("product_category_id",$product_category_id);
        }
        if(($search_terms=$request->search_terms)){
            $products=$products->where("name","like","%".$search_terms."%")->orWhere("description","like","%".$search_terms."%");
            $history=new SearchHistory(["term"=>$search_terms, "results"=>$products->get()->count()]);
            $history->save();

        }
        $categoryString;
        switch ($product_category_id) {
            case self::HERBOLOGY_DOCUMENTS:
                $categoryString = "Documentos";
                break;
            case self::HERBOLOGY_PRESCRIPTIONS_REMEDIES:
                $categoryString = "Recetas y remedios de herbolaria";
                break;
            case self::EVENTS:
                $categoryString = "Eventos";
                break;
            case self::HEALTH_SERVICES:
                $categoryString = "Servicios de salud y terapéuticos";
                break;
            default:
                $categoryString = "Productos";
                break;
        }
        return view("product/index")->with("C_products",$products->paginate($this->pagination_elements))->with('SESSION_products', session()->get("IDs_cart_products"))->with("request",$request)->with("product_category_name",$product_category_name)->with("product_category_id",($product_category_id)?$product_category_id:false)->with('is_grevill',!(empty($request->grevill))?true:null)
            ->with('product_category', $product_category)
            ->with('categoryString', $categoryString);
    }

    public function nonCategorizedProducts()
    {
        $products= Product::where("product_category_id","=",null);
        return view("product/uncategorized_index")->with("C_products",$products->paginate(50));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("product/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$A_product=$request->all();
    	unset($A_product["_token"]);
        if(isset($A_product["img"])){
            $Img_product_image=$A_product["img"];
            $S_image_name=time().uniqid(rand()).".".$Img_product_image->getClientOriginalExtension();
            $A_product["img"]=$S_image_name;
            $res=$Img_product_image->move(public_path("images"),$S_image_name);
        }else{
            $b_removeProduct=($A_product['removePicture'])?true:false;
            if($b_removeProduct){
                $A_product['img']=null;
            }
        }
        if($request->file('file')){
            $filename = $request->file('file')->getClientOriginalName();
            $A_product['file']=$filename;
            //estamos subiendo aquí en el local
            // Storage::disk('local')->put('public/'.$filename, $request->file('file')->get());
            Storage::cloud()->put($filename, $request->file('file')->get());
        }
        $O_product=new Product($A_product);
        $O_product->save();
        return redirect(action("ProductController@index"));
    }

    public function downloadProductFile(Product $product){
        $filename = $product->file;
        $downloadName=$product->name;
        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!
        //return $file; // array with file info
        $rawData = Storage::cloud()->get($file['path']);
        return response($rawData, 200)
            ->header('ContentType', $file['mimetype'])
            ->header('Content-Disposition', "attachment; filename=".$file['name']);
    }

    public function clientDownloadProductFile($code){
        $product = false;
        dd(DownloadLink::where('code',$code)->get());
        $download_link = DownloadLink::where('code',$code)->where('used',false)->first();
        if(!$download_link){
            dd("Producto no encontrado");
        }else{
            $product = $download_link->product;
        }
        $filename = $product->file;
        $downloadName=$product->name;
        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!
        //return $file; // array with file info
        $rawData = Storage::cloud()->get($file['path']);
        $download_link->used = true;
        $download_link->save();
        return response($rawData, 200)
            ->header('ContentType', $file['mimetype'])
            ->header('Content-Disposition', "attachment; filename=".$file['name']);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        dd("holasdgsg");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        return view("product/create")->with("product",Product::find($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $product=Product::find($product);
        $A_product=$request->all();
        unset($A_product["_token"]);
        unset($A_product["_method"]);
        if($request->file('file')){
                $filename = $request->file('file')->getClientOriginalName();
                $A_product['file']=$filename;
                //estamos subiendo aquí en el local
                // Storage::disk('local')->put('public/'.$filename, $request->file('file')->get());
                Storage::cloud()->put($filename, $request->file('file')->get());
        }
        if(isset($A_product["img"])){
            $Img_product_image=$A_product["img"];
            $S_image_name=time().uniqid(rand()).".".$Img_product_image->getClientOriginalExtension();
            $A_product["img"]=$S_image_name;
            $res=$Img_product_image->move(public_path("images"),$S_image_name);
        }else{
            $b_removeProduct=($A_product['removePicture'])?true:false;
            if($b_removeProduct){
                $A_product['img']=null;
            }
        }
        $A_product['active']=($request->active=="on")?true:false;
        $A_product['is_grevill']=!empty($request->is_grevill)?true:false;
        $product->update($A_product);
        return redirect()->back()->with('message', 'Producto Modificado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $productId)
    {
        $product = Product::find($productId);
        $product->delete();
        return redirect(route("store.index"))->with('message', 'Producto Modificado!');;
    }

    public function checkout(){
        $products_id=session()->get("IDs_cart_products");
        $products=Product::getProductByIds($products_id);
        $states=State::all();
        return view("product/checkout")->with("C_products",$products)->
        with('SESSION_products', session()->get("IDs_cart_products"))->
        with('states',$states)->
        with('minimum_checkout', env('MINIMUM_CHECKOUT_LOCAL', 350))->
        with('minimun_national', env('MINIMUM_CHECKOUT_NATIONAL', 850));
    }

    public function AJAX_manageCart(Request $request){
        $session=session();
        if(!$session->has("products")){
            $session->put("products",[]);
        }
        $key="IDs_cart_products.".$request->product_info['id'];
        if($request->cart_method=="put"){
            $key.=".product_info";
        }
        $session->{$request->cart_method}($key,$request->product_info);
        if($request->cart_method == "none"){
            return json_encode([
                "code"=>"200",
                "IDs_cart_products"=>$session->get("IDs_cart_products"),
                "text"=>"(".sizeof($session->get("IDs_cart_products")).")",
            ]);
        }
        if(($session->has($key) && $request->cart_method == "put")
            || (!$session->has($key) && $request->cart_method == "forget")){
            return json_encode([
                "code"=>"200",
                "IDs_cart_products"=>$session->get("IDs_cart_products"),
                "text"=>($request->cart_method=="put")?"Producto agregado con éxito a tu carrito de compras":"Producto eliminado con éxito del carrito de compras",
            ]);
    }
    return json_encode([
        "code"=>"400",
        "IDs_cart_products"=>$session->get("IDs_cart_products"),
        "text"=>"Error indefinido",
    ]);
}
}
