@extends('layouts.frontend')
@section('content')
    <!-- @php 
        var_dump($items);
    @endphp -->
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
                </div>
            </div>
        </header>

        <!-- Category section -->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach($categories as $category)
                        <a class="col mb-5" href="{{route('items.category',$category->id)}}">
                            <div class="card text-bg-dark">
                                <img src="{{$category->image}}" class="card-img" alt="...">
                                <div class="card-img-overlay">
                                    <h5 class="card-title">{{$category->name}}</h5>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <h1 class="text-center mb-5">Products</h1>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
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