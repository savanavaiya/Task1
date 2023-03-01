<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Json;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->Product = new Product;
    }
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $product = $this->Product;
            $search = $request->get('sername');
            $min_price = $request->get('min_price');
            $max_price = $request->get('max_price');

            if($min_price != null && $max_price != null){
                $product = $product->whereBetween('price',[(int)$min_price,(int)$max_price]);
            }
            if($search != ''){
                $product = $product->where('name', 'like', '%'.$search.'%');
            }
            $product = $product->with('img')->paginate(2);
            // $product = $product->paginate(2);
            $total_row = $product->count();
            $data = view('data',compact('product','total_row'))->render();
            $response['data'] = $data;
            return $response;

        }
        return view('viewdata');
    }

    public function addproduct()
    {
        return view('addproduct');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
     
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        if($request->sku == null){
            $sku = "#".rand(11111,99999);
        }else
        {
            $sku = $request->sku;
        }

        $product = new Product;
        $product = $product->updateOrCreate([
            'id' => $request->id,
        ],[
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'sku' => $sku,
            'desc' => $request->desc,
        ]);

        if($request->file('image'))
        {
            $i = 1;
            foreach($request->image as $image){
                $new = "IMG".time().$i++.".JPG";

                $image->move(public_path('image'),$new);

                $proimage = new ProductsImage;
                $proimage = $proimage->create([
                    'pro_image' => $new,
                    'pro_id' => $product->id,
                ]);
            }

        }

        // return true;

        if($request->id == '0'){
            // return redirect()->route('index')->with('SUCCESS','Add Data Successfully');
            return true;
        }else{
            // return redirect()->route('viewproduct')->with('SUCCESS','Edit Data Successfully');
            return false; 
        }

    }

    public function DeleteData(Request $request)
    {
        // dd($request->all());
        $deleteData =  Product::with('img')->find($request->id);
        foreach($deleteData->img as $value){
            if (file_exists(public_path('image/'.$value->pro_image))) {

                @unlink(public_path('image/'.$value->pro_image));
        
            }
            $value->delete();
        }
        $deleteData->delete();
        
        return true;
    }   

    public function EditData($id)
    {
        $editData = Product::with('img')->find($id);

        return view('addproduct',compact('editData'));
    }

    public function delimg($id)
    {
        $deleteImage = ProductsImage::find($id);
        if (file_exists(public_path('image/'.$deleteImage->pro_image))) {

            @unlink(public_path('image/'.$deleteImage->pro_image));
    
        }
        $deleteImage->delete();

        return redirect()->back();
    }


}
