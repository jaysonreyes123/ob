@php
    $label = ucfirst(str_replace("_"," ",$fieldname));
@endphp
<div class="col-12 mb-3">
    <label>{{$label}}</label>
    <input type="{{$type}}" value="{{$value}}" placeholder="{{$label}}" name="{{$fieldname}}" id="{{$fieldname}}" class="form-control">
</div>