<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    function addData(Request $req)
    {
        $product = new Product;

        $req->validate([
            'p_name' => 'required|max:20',
            'p_code' => 'required|min:3|max:7',
            'p_desc' => 'required|min:10',
            'p_category' => '',
            'p_price' => '',
            'p_quantity' => '',
            'p_stock_date' => '',
            'p_rating' => '',
            'p_purchased' => ''


        ]);

        $product->p_name = $req->p_name;
        $product->p_code = $req->p_code;
        $product->p_desc = $req->p_desc;
        $product->p_category = $req->p_category;
        $product->p_price = $req->p_price;
        $product->p_quantity = $req->p_quantity;
        $product->p_stock_date = $req->p_stock_date;
        $product->p_rating = $req->p_rating;
        $product->p_purchased = $req->p_purchased;
        $product->save();

        $data = $req->p_name;
        $req->session()->flash('product',$data);
        return redirect ('add');
    }
    function showData()
    {
        $data = Product::all();
        return view('product',['collection'=>$data]);
    }
    function showProduct($id)
    {
        $data = Product::find($id);
        return view('detail',['info'=>$data]);
    }
    function showEdit($id)
    {
        $data = Product::find($id);
        return view('update',['info'=>$data]);
    }
    function updateProduct(Request $req)
    {
        $product = Product::find($req->id);

        $req->validate([
            'p_name' => 'required|max:20',
            'p_code' => 'required|min:3|max:7',
            'p_desc' => 'required|min:10',
            'p_category' => '',
            'p_price' => '',
            'p_quantity' => '',
            'p_stock_date' => '',
            'p_rating' => '',
            'p_purchased' => ''


        ]);



        $product->p_name = $req->p_name;
        $product->p_code = $req->p_code;
        $product->p_desc = $req->p_desc;
        $product->p_category = $req->p_category;
        $product->p_price = $req->p_price;
        $product->p_quantity = $req->p_quantity;
        $product->p_stock_date = $req->p_stock_date;
        $product->p_rating = $req->p_rating;
        $product->p_purchased = $req->p_purchased;
        $product->created_at = $product->created_at;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();

        $data = $product->p_name;
        $req->session()->flash('product',$data);
        return redirect ('product');
    }

    function delete($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect ('product');
    }


}
