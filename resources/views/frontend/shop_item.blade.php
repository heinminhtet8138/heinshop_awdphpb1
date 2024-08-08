@extends('layouts.frontend')
@section('content')
<!-- @php 
    var_dump($item);
@endphp -->
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{$item->image}}" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">Code No: {{$item->codeNo}}</div>
                        <h1 class="display-5 fw-bolder">{{$item->name}}</h1>
                        <a href="{{route('items.category',$item->category_id)}}" class="text-decoration-none badge text-bg-primary">{{$item->category->name}}</a>
                        <div class="fs-5 mb-5">
                            @if($item->discount == 0)
                                <span>{{$item->price}} Ks</span>
                                
                            @else 
                                <span class="text-decoration-line-through">{{$item->price}} Ks</span>
                                <span>{{$item->price - (($item->discount/100)*$item->price)}} Ks</span>
                            @endif
                        </div>
                        <p class="lead">{{$item->description}}</p>
                        <div class="d-flex">
                            @if($item->inStock == 1)
                                <input class="form-control text-center me-3 qty" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                                <button class="btn btn-outline-dark flex-shrink-0 addToCart" type="button" data-id="{{$item->id}}" data-codeno="{{$item->codeNo}}" data-name="{{$item->name}}" data-price="{{$item->price}}" data-discount="{{$item->discount}}">
                                    <i class="bi-cart-fill me-1"></i>
                                    Add to cart
                                </button>
                            @else
                                <button class="btn btn-primary flex-shrink-0 " type="button" disable>Oute of Stock</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 ">
                @foreach($items as $item)
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="{{$item->image}}" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{$item->name}}</h5>
                                        <!-- Product price-->
                                        @if($item->discount == 0)
                                            <span>{{$item->price}} Ks</span>
                                            
                                        @else 
                                            <span class="text-decoration-line-through">{{$item->price}} Ks</span>
                                            <span>{{$item->price - (($item->discount/100)*$item->price)}} Ks</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('front.show',$item->id)}}">View</a></div>
                                        </div>
                                        <div class="col-md-8">
                                            @if($item->inStock == '1')
                                                <input type="hidden" value="1" class="qty">

                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto addToCart" data-id="{{$item->id}}" data-codeno="{{$item->codeNo}}" data-name="{{$item->name}}" data-price="{{$item->price}}" data-discount="{{$item->discount}}">Add to Cart</a></div> 
                                            @else 
                                                <div class="text-center"><a class="btn btn-primary mt-auto ">Out of Stock</a></div> 
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
@endsection
        