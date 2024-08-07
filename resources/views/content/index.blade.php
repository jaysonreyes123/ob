@extends('layout._main',["title" => "Index"])
@section('content')
  <style>
    body{
      background-image: url('{{ asset("assets/img/bg.jpg") }}');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 100% 100%;
    }
  </style>
  
           <div class="text-center mt-4 fw-bold" style="font-size: 16px">
                         <h5 style="color:red;"><marquee>ATTENTION: Due to a high demand from recent media coverage our stock is going fast and limited! As of right now we currently have products in-stock and will ship within 24 hours of purchase.</marquee></h5>
                            <h3>LINKSPARK NUTRA-ESSENTIALS PRODUCTS</h3>
                            <br>
       
                        </div>
  
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 gx-3">
            @foreach (\App\Models\ObProduct::with("product_details_")->get() as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mt-4 fw-bold" style="font-size: 16px">
                            <!--<span>14-DAYS TRIAL RISK FREE!</span>-->
                            <br>
                            <span>{{$product->product}}</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <img style="width: 90%;max-height: 180px;" src="{{$product->image}}" alt="Image">
                        </div>
                        <div class="mt-3">
                            <p class="px-4 fw-bold">Try and Save. Skip or Cancel Anytime.</p>
                            <ul style="list-style-type: none">
                                @foreach ($product->product_details_ as $product_details )
                                 <li>  <i class="bi bi-check-circle" style="color:green;"></i> {{$product_details->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="text-center fw-bold" style="font-size: 23px">
                            <div class=" mt-4"  >
                                <button  class="btn btn-light terms_condition" data-id="{{$product->id}}" style="background: 
rgba(185, 146, 184, 0.53)
 !important; font-size:13px;"><b>Terms & Condition</b></button>
                            </div>
                            <div class="mt-3">
                                <div class="row mx-auto" style="width: 70%">
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
                        <a href="{{ route('product.show', ['id'=>$product->id,"access_token" => $access_token]) }}" class="btn btn-success w-75">Buy Now <i class="bi bi-arrow-right"></i></a>
                    </div>
                  </div>
            </div>
            <textarea hidden name="" id="id-{{$product->id}}" cols="30" rows="10">{{$product->terms_condition}}</textarea>
            @endforeach
        </div>
    </div>
@include('component.terms_condiition');
@push('script')
    <script>
        $(".terms_condition").click(function(){
            const id = $(this).data('id');
            const terms_condition = $("#id-"+id).val();
            $("#terms-condition-content").html(terms_condition);
            $("#terms-condition-modal").modal('show');
        })
    </script>
@endpush
@endsection