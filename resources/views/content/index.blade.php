@extends('layout._main',["title" => "Index"])
@section('content')
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 gx-5">
            @foreach (\App\Models\ObProduct::with("product_details_")->get() as $product)
            <div class="col mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mt-4 fw-bold" style="font-size: 16px">
                            <span>14-DAYS TRIAL RISK FREE!</span>
                            <br>
                            <span>{{$product->product}}</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <img style="width: 80%;max-height: 150px" src="{{$product->image}}" alt="Image">
                        </div>
                        <div class="mt-3">
                            <p class="px-4 fw-bold">Try and Save. Skip or Cancel Anytime.</p>
                            <ul style="list-style-type: none">
                                @foreach ($product->product_details_ as $product_details )
                                    <li>{{$product_details->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="text-center fw-bold" style="font-size: 23px">
                            <div class=" mt-4"  >
                                <button class="btn btn-light" style="background: #e9e9e9 !important">Terms & Condition</button>
                            </div>
                            <div class="mt-3">
                                <div class="row mx-auto" style="width: 60%">
                                    @if ((int) $product->price != 0)
                                        <div class="col">
                                            <div class="text-muted" style="position: relative">
                                                <div style="position: absolute;width: 100%;height: 1px;background: red;display: block;top: 50%;transform: rotate(-20deg)"></div>
                                                <span>${{$product->price}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col">
                                        <span>${{$product->shipping}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center mb-2" style="border-top: none">
                        <a href="{{ route('product.show', ['id'=>$product->id]) }}" class="btn btn-success w-75">Buy now <i class="bi bi-arrow-right"></i></a>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection