@extends('layout._main',["title"=>"checkout"])
@section('content')
<style>
@media (min-width: 1400px) {
    .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
        max-width: 1400px !important;
    }
}
td{
    text-align: left;
}
</style>
    <div class="container">
        @include('component.status-message')
        <div class="row">
            <div class="col-lg-12 mt-3 mb-3">
              <a href="{{ route('index',['access_token' => $access_token]) }}"  class="btn btn-primary px-4"><i style="vertical-align: text-bottom" class="bi bi-arrow-left"></i> Back</a>
            </div>
            <div class="col-lg-8">
                <div class="card shadow h-100">
                    <div class="card-body">
                        
                        <div class="card-title">
                            Order Summary
                        </div>
                        <div style="position: sticky">
                          <table class="table">
                            <thead>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            <span style="vertical-align: top;margin-left: 5px;font-size:20px">{{$product->product}}</span>
                                            <br>
                                            <img src="{{$product->image}}" style="width: 250px" alt="">
                                        </div>
                                        
                                    </td>
                                    <td>1</td>
                                    <td>${{$product->shipping}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td><span class="h5">Total</span></td>
                                    <td><span class="h5">${{$product->shipping}}</span></td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 shadow mb-3">
                    <div class="card-body">
                                     <img src="{{ asset('assets/img/card.jpg') }}" alt="" style="width: 100%;margin-top: 10px">
                        <form class="g-3" id="form" method="post">
                            @csrf
                            <h5 class="card-title mb-3">Customer Information</h5>
                            @php
                              $fields = array(
                                "firstname" => "text",
                                "lastname"  => "text",
                                "address"   => "text",
                                "zip_code"  => "text",
                                "city"      => "text",
                                "state"     => "text",
                                "phone"     => "text",
                                "email"     => "email"
                              );
                            @endphp
                            @foreach ($fields as $fieldname => $type )
                              @php
                                $value = $model->$fieldname ?? "";
                              @endphp
                              @include('component.text-field',["fieldname" => $fieldname,"type" => $type, 'value' => $value])
                            @endforeach
                       
                            <h5 class="card-title mt-4 mb-3">Card Information</h5>
                            <div class="col-12 mb-3">
                                <label >Card Number</label>
                                <input type="text" placeholder="Card number" value="{{$model->card_number ?? ""}}" id="card_number" name="card_number" class="form-control">
                            </div>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" name="mm" value="{{$model->mm ?? ""}}" placeholder="MM" maxlength="2" class="form-control" onkeyup="if(this.value.length == 2) document.getElementById('year').focus()" >
                                        </div>
                                    </div>
                                    <div class="col">
                                         <div class="form-group">
                                            <div class="form-group">
                                                <input type="text" name="yy" value="{{$model->yy ?? ""}}" placeholder="YY" id="year" maxlength="2" onkeyup="if(this.value.length == 2) document.getElementById('cvc').focus()" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <input type="text" name="cvc" value="{{$model->cvc ?? ""}}" placeholder="CVC" id="cvc" maxlength="3" class="form-control">
                                                <img src="{{ asset('assets/img/cvv-img.png') }}" alt="" style="width:90px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="disclaimer" style="padding: 10px 10px 0 10px;">
                           By submitting, you affirm to have read and agreed to our 
                             <a href="javascript:void(0);" onclick="javascript:openNewWindow('a.php','modal');" style="color:inherit;text-decoration:underline; cursor: pointer;">Terms &amp; Conditions</a>.  
                         <!--  <a href='#' data-modal-url='/sk-cp-1/terms/' style='color:inherit;text-decoration:underline; cursor: pointer;'>Terms &amp; Conditions</a>. After your  trial period has expired, you will be enrolled in our membership program for $129.95 per month. You can cancel anytime by calling 866-272-2509.  -->                               
                        </div>
                            <!--<h5 class="card-title mt-4 mb-3">Payment Option</h5>-->
                            @php
                              $payments = array('magpie');
                            @endphp
                            @foreach ($payments as $payment )
                              @include('component.payment-method',["payment" => $payment])
                            @endforeach
                            @php
                              $price =  $product->shipping - $product->price;
                            @endphp
                            <input type="hidden" name="unit_price" id="unit_price" value="{{$price}}">
                            <input type="hidden" id="product" name="product" value="{{$id}}">
                            <input type="hidden" id="price" name="price" value="{{$price}}">
                            <input type="hidden" id="quantity" value="1" name="quantity">
                            <div class="col-12 mb-4 mt-4">
                              <button class="btn btn-primary w-100" type="submit">Pay Now</button>
                            </div>
                            <div class="col-12 mb-4 mt-4">
                              <a class="btn btn-warning w-100" id="clearform" >Clear</a>
                            </div>
                            
                             
                          </form>
                              <img src="{{ asset('assets/img/secureicons.jpg') }}" alt="" style="width:100%;">
                         
                    </div>
                  </div>
            </div>
        </div>
    </div>
@push('script')
<script>
    var payments_option = @json($payments);
    var id = @json($id);
    var retry_option = 100;
    var role = "ob";
    var fields = {
      product:"",
      price:"",
      payment:"",
      firstname:"",
      lastname:"",
      address:"",
      zip_code:"",
      city:"",
      state:"",
      phone:"",
      email:"",
      card_number:"",
      mm:"",
      yy:"",
      cvc:"",
      unit_price:"",
      quantity:"",
    }


    // loadField();

    $("#form").on('submit',function(e){
      e.preventDefault();
      const payment_list = $("input:radio[name='payment']").is(":checked");
      if(!payment_list){
        swal.fire({
          icon:"error",
          title:"Payment option is required"
        })
        return false;
      }
      
      serialize_data();
      loader()
      $.ajax({
        url:"{{route('payment.process')}}",
        method:"post",
        data:$(this).serialize(),
        success:function(data){
          location.href=data;
        },
        error:function(err){
          if(err.status == 412){
            Swal.fire({
              title: "Something wrong",
              html: err.responseJSON.error,
              icon: "error"
            });
          }
          loader(false);
        }
      })
      payment_retry_function();
      localStorage.removeItem('dataStore');
      localStorage.setItem('dataStore',JSON.stringify(fields))
    })
    function serialize_data(){
        const fields_ = Object.keys(fields);
        fields_.map((item)=>{
            fields[item] = $("input[name='"+item+"']").val();
        })
    }

    function loadField(){
      const dataStore = localStorage.getItem('dataStore');
      const paymentStore = localStorage.getItem('paymentStore');
      if(dataStore != null){
        const data = JSON.parse(dataStore);
        const keys = Object.keys(fields);
        keys.map((item,index)=>{
          if(item == "product"){
            const product_id = role == "collection" ? data['product']+"-"+data['price'] : data[item];
            $("#"+product_id).prop("checked",true);
            $("#product-"+product_id).addClass('active');
            $("input[name='"+item+"']").val(data[item])
            const quantity = data['quantity'];
            $("#"+product_id+"-quantity").html('Quantity:<input type="number" value="'+quantity+'" class="form-control" min="1" id="quantity-field">');
          }
          else{
            $("input[name='"+item+"']").val(data[item])
          }
        })
      }

      if(paymentStore != null){
        var payment_ctr = 0;
        if(paymentStore != null){
          const payments = JSON.parse(paymentStore);
          payments.map((item,index)=>{
              if(item.retry >= retry_option){
                $("#"+item.name).prop("disabled",true)
                $("#"+item.name).prop("checked",false)
                payment_ctr++;
              }
          })
          if(payment_ctr == payments_option.length){
            localStorage.removeItem('paymentStore')
            $("input[name='payment']").prop("disabled",false);
          }
        }
      }
    }

    function payment_retry_function(){
      const payment = $("input:radio:checked[name='payment']").val();
      var payment_array = [];
          const paymentStore = localStorage.getItem('paymentStore');
          if(paymentStore == null){
            payment_array.push({name:payment,retry:1})
          }
          else{
            payment_array = JSON.parse(paymentStore);
            var payments = [];
            payment_array.map((item,index)=>{
              payments.push(item.name);
            })
            const paymentIndex = payments.indexOf(payment);
            if(paymentIndex == -1){
              payment_array.push({name:payment,retry:1})
            }
            else{
              payment_array[paymentIndex].retry = payment_array[paymentIndex].retry+=1;
            }
          }
          localStorage.setItem('paymentStore',JSON.stringify(payment_array))
    }

    $(".radio-price").click(function(){
      var amount = $(this).val();
      $("#unit_price").val(amount);
      $("#price").val($(this).data('id'));
      $("#product").val($(this).data('product'));
      $(".quantity-content").html("");
      $(this).closest(".product-content ").find(".quantity-content").html('Quantity:<input type="number" class="form-control" min="1" value="1" placeholder="quantity" id="quantity-field"> ');
      $("#quantity-field").blur(function(){
        $("#quantity").val($(this).val())
      })
      // $("#pay-total").text("$"+amount)
    })

    $(".product-list.list-group-item-action").click(function(){
      $(".product-list.list-group-item-action").removeClass('active')
      $(this).addClass('active')
      const find_total = $(this).find('.total');
      const total = $(find_total).val();
      $("#pay-total").text("$"+total)
      $("#product").val($(this).data('id'));
      $(".quantity-content").html("");
      $(this).closest(".product-content").find(".quantity-content").html('Quantity:<input type="number" placeholder="quantity" class="form-control" value="1" min="1"  id="quantity-field"> ');
      $("#quantity-field").blur(function(){
        $("#quantity").val($(this).val())
      })
      $("input[name='unit_price']").val(total)
    })

    function loader(show = true){
      if(show){
        $("#loader").show();
        $("body").css("overflow","hidden");
        $(window).scrollTop(0);
      }
      else{
        $("#loader").hide();
        $("body").css("overflow","auto");
      }
    }

    $("#clearform").click(function(){
      clearform();
      const url = $(location).attr('href');
      if(id != null){
        window.location = url.slice(0,-1);
      }
      
    })

    function clearform(){
      const fields_keys = Object.keys(fields);
      localStorage.clear();
      fields_keys.map((item,index)=>{
        if(item == "product"){
          $("input[name='"+item+"']").val("");
          $("input:radio").prop("checked",false);
          $(".product-list.list-group-item-action").removeClass('active')
        }
        else if(item == "payment"){
          $("input:radio").prop("disabled",false);
          $("input:radio").prop("checked",false);
          $("input[name='"+item+"']").val("");
        }
        else{
          $("input[name='"+item+"']").val("");
        } 
      })
      $(".quantity-content").html("");
    }
  </script>
@endpush
@endsection