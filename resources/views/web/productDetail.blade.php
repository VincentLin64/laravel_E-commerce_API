@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row gx-5">
            <aside class="col-lg-6">
                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                    <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="{{$product->image_url}}">
                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="{{$product->image_url}}" />
                    </a>
                </div>
                <!-- thumbs-wrap.// -->
                <!-- gallery-wrap .end// -->
            </aside>
            <main class="col-lg-6">
                <div class="ps-lg-3">
                    <h4 class="title text-dark">
                        {{$product->title}}
                    </h4>


                    <div class="mb-3">
                        <span class="h5">NT${{$product->price}}</span>
                        <span class="text-muted">/{{$product->unit_name}}</span>
                    </div>

                    <p>
                        {{$product->content}}
                    </p>

                    <div class="mb-3">
                        <span class="h5">庫存：{{$product->quantity}}</span>
                    </div>

{{--                    <div class="row">--}}
{{--                        <dt class="col-3">Type:</dt>--}}
{{--                        <dd class="col-9">Regular</dd>--}}

{{--                        <dt class="col-3">Color</dt>--}}
{{--                        <dd class="col-9">Brown</dd>--}}

{{--                        <dt class="col-3">Material</dt>--}}
{{--                        <dd class="col-9">Cotton, Jeans</dd>--}}

{{--                        <dt class="col-3">Brand</dt>--}}
{{--                        <dd class="col-9">Reebook</dd>--}}
{{--                    </div>--}}

                    <hr />

                    <div class="row mb-4">
{{--                        <div class="col-md-4 col-6">--}}
{{--                            <label class="mb-2">Size</label>--}}
{{--                            <select class="form-select border border-secondary" style="height: 35px;">--}}
{{--                                <option>Small</option>--}}
{{--                                <option>Medium</option>--}}
{{--                                <option>Large</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <!-- col.// -->
{{--                        <div class="col-md-4 col-6 mb-3">--}}
{{--                            <label class="mb-2 d-block">Quantity</label>--}}
{{--                            <div class="input-group mb-3" style="width: 170px;">--}}
{{--                                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark">--}}
{{--                                    <i class="fas fa-minus"></i>--}}
{{--                                </button>--}}
{{--                                <input type="text" class="form-control text-center border border-secondary" placeholder="14" aria-label="Example text with button addon" aria-describedby="button-addon1" />--}}
{{--                                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark">--}}
{{--                                    <i class="fas fa-plus"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
{{--                    <a href="#" class="btn btn-warning shadow-0"> Buy now </a>--}}
{{--                    <a href="#" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </a>--}}
                    <a href="/" class="btn btn-light border border-secondary py-2 icon-hover px-3">  返回 </a>
                </div>
            </main>
        </div>
    </div>
@endsection
