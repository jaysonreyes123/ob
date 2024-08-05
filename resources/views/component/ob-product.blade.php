@php
    $total = $product->price+$product->shipping;
@endphp
<div class="product-content mb-2">
<a href="javascript:void(0)" id="product-{{$product->id}}" data-id={{$product->id}} class="product-list list-group-item list-group-item-action flex-column align-items-start">
    <div class="row">
      <div class="col-lg-4 d-flex justify-content-center  align-items-center ">
        <img style="width: 100%" src="{{$product->image}}" alt="">
      </div>
      <div class="col-lg-8">
        <table class="table table-borderless">
          <thead>
            <th>{{$product->name}}</th>
            <th></th>
          </thead>
          <tbody>
            <tr>
              <td>Price</td>
              <td>${{$product->price}}</td>
            </tr>
            <tr>
              <td>Shipping & Handling</td>
              <td>${{$product->shipping}}</td>
            </tr>
          </tbody>
          <tfoot>
            <th>Total</th>
            <th>${{$total}}</th>
          </tfoot>
        </table>
        <input type="hidden" class="total" value="{{$total}}">
       
      </div>
    </div>
  </a>
  <div id="{{$product->id}}-quantity" class="quantity-content"></div>
</div>