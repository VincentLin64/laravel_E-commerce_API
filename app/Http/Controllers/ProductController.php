<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = $this->getData();
        return response($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $vInputData = $request->all();
        $vGetOriginData = $this->getData();
        $vGetOriginData->push(collect($vInputData));
        return $vGetOriginData;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $vInput = $request->all();
        $vSelectData = $this->getData()->where('id', $id)->first();
        $vReturnData = $vSelectData->merge(collect($vInput));
        return response($vReturnData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $vData = $this->getData();
        $vReturnData = $vData->filter(function ($product) use ($id) {
           return  $product['id'] != $id;
        })->values();
        return response($vReturnData);
    }

    public function getData()
    {
        return collect([
            collect(['id' => 0, 'title' => '測試商品1', 'content' => '棒', 'price' => 50]),
            collect(['id' => 1, 'title' => '測試商品2', 'content' => '讚', 'price' => 55]),
        ]);
    }
}
