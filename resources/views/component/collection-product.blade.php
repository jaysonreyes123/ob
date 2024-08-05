
    <div class="card shadow-none">
        <div class="card-body">
            <h4 class="card-title" style="font-weight: bold;font-size: 20px">{{$product->product}}</h4>
                <div class="row">
                    @foreach ($product->price_ as $price )
                        <div class="col-2 mb-3 product-content ">
                            <div class="form-check">
                                <input class="form-check-input radio-price" type="radio" name="exampleRadios" data-product="{{$product->id}}" data-id="{{$price->id}}" id="{{$product->id}}-{{$price->id}}" value="{{$price->price}}">
                                <label class="form-check-label" for="{{$product->id}}-{{$price->id}}">
                                    ${{$price->price}}
                                </label>
                            </div>
                            <div id="{{$product->id}}-{{$price->id}}-quantity" class="quantity-content"></div>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
