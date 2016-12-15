<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App;

class ProductController extends Controller
{
    
    var $shopify;
    
    
    public function __construct(){
        // This creates an instance of the Shopify API wrapper and
        // authenticates our app.
        $this->shopify = App::make('ShopifyAPI', [
          'API_KEY'     => '04271e0a2106fa28c57d1022f58522c8',
          'API_SECRET'  => '1dd6c052801b29bddc22320830aef73e',
          'SHOP_DOMAIN' => 'juanstan.myshopify.com',
          'ACCESS_TOKEN'=> '7a4a90029e50dd40dcb0b082d05b817a'
        ]);        
        
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gets a list of products
        $result = $this->shopify->call([
          'METHOD'=> 'GET',
          'URL'   => '/admin/products.json?page=1'
        ]);

        $products = $result->products;
        return view('products.index', ['products'=>$products]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request){
        
        $img_data = $request->file ? base64_encode(file_get_contents($request->file->path())) : false;
        
        $this->shopify->call([
            'METHOD'=> 'POST',
            'URL'   => '/admin/products.json',
            'DATA'  => [
                'product' => [
                    "title"         => $request->title,
                    "body_html"     => $request->description,
                    "vendor"        => $request->vendor,
                    "product_type"  => $request->product_type,
                    "images"        => [
                        [
                            "attachment" => $img_data
                        ]
                    ],
                    "variants" => [  
                        [
                            "option1" => "Default",
                            "sku" => $request->sku,
                            "price" => $request->price
                        ]
                    ]
                ]
            ]
        ]);
                 
        return response()->json(['status' => 'success', 'message' => 'all data introduced correctly']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
