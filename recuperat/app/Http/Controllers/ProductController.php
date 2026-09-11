<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Parametrization;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $pagination_elements=16;
    public function __construct()
    {
        $this->middleware('is_admin')->except('index','checkout','AJAX_manageCart');
    }
    public function index(Request $request){
        $products=Product::where("active",true)->where("product_category_id","!=",1);
        if (Auth::user()) {
            if(Auth::user()->rol->id==1)
            {
                $products=Product::where("product_category_id","!=",1);
            }
        }
        $product_category_name=false;
        if($request->input('unclassified')){
            $products = Product::where('product_category_id',null);
        }
        if (($product_category_id=$request->product_category_id)) {
            $product_category_name=ProductCategory::find($product_category_id)->name;
            $products=$products->where("product_category_id",$product_category_id);
        }
        if(($search_terms=$request->search_terms)){
            $products=$products->where("name","like","%".$search_terms."%");
        }
        return view("product/index")->with("C_products",$products->paginate($this->pagination_elements))->with('SESSION_products', session()->get("IDs_cart_products"))->with("request",$request)->with("product_category_name",$product_category_name);
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
        $A_validator = [
            "name" => 'required|unique:products',
            "price_mxn" => 'required',
        ];
        $A_validator_messages = [
            "name.required" => 'El nombre es requerido',
            "name.unique" => 'El producto con ese nombre ya existe',
            "price_mxn.required" => 'El precio es requerido',
        ];
        Validator::make($request->all(), $A_validator, $A_validator_messages)->validate();
    	$A_product=$request->all();
        unset($A_product["_token"]);
        if(isset($A_product["img"])){
            $Img_product_image=$A_product["img"];
            $S_image_name=time().uniqid(rand()).".".$Img_product_image->getClientOriginalExtension();
            $A_product["img"]=$S_image_name;
            if($request->product_category_id==1){
                $A_product["img"]="servicios/".$A_product["img"];
            }
            $images_path=public_path("images/");
            $images_url_complement=($request->product_category_id==1)?"servicios/":"";
            $res=$Img_product_image->move($images_path.$images_url_complement,$S_image_name);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        return view("product.create")->with("product",Product::find($product));
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
        $A_validator = [
            "name" => 'required|unique:products,name,'.$product->id,
            "price_mxn" => 'required',
        ];
        $A_validator_messages = [
            "name.required" => 'El nombre es requerido',
            "name.unique" => 'El producto con ese nombre ya existe',
            "price_mxn" => 'required',
        ];
        Validator::make($request->all(), $A_validator, $A_validator_messages)->validate();
        $A_product=$request->all();
        unset($A_product["_token"]);
        unset($A_product["_method"]);
        if(!empty($A_product["img"])){
            $Img_product_image=$A_product["img"];
            $S_image_name=time().uniqid(rand()).".".$Img_product_image->getClientOriginalExtension();
            $A_product["img"]=$S_image_name;
            $images_path=public_path("images/");
            $images_url_complement=($request->product_category_id==1)?"servicios/":"";
            $res=$Img_product_image->move($images_path.$images_url_complement,$S_image_name);
        } elseif (empty($request['previous_image'])) {
            $A_product['img'] = null;
        }
        if($request->file('file')){
                $filename = $request->file('file')->getClientOriginalName();
                $A_product['file']=$filename;
                Storage::cloud()->put($filename, $request->file('file')->get());
        }
        $A_product['active']=($request->active=="on")?true:false;
        $product->update($A_product);
        return redirect(route('store.edit', $product->id))->with('message', 'Producto Modificado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        $product = Product::find($productId);
        $product->delete();
        return redirect(route('store.index'))->with('message', 'Producto Eliminado!');
    }

    public function checkout(){
        $products_id=session()->get("IDs_cart_products");
        $products=Product::getProductByIds($products_id);
        $states=State::all();
        return view("product/checkout")->with("C_products",$products)->
        with('SESSION_products', session()->get("IDs_cart_products"))->
        with('states',$states);
        //->
        // with("minimum_checkout",Parametrization::where("parameter","compra_minimo_requerido")->first()->value);
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
            ->header('Content-Disposition', "attachment; filename=$downloadName");
    }

    public function clientDownloadProductFile($code){
        $product = false;
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
            ->header('Content-Disposition', "attachment; filename=$downloadName");
    }
}
