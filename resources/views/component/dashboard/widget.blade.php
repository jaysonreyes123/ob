<!-- Sales Card -->
<div class="col-12 col-lg-4">
    <div class="card card-widget">
    <div class="card-body">
        
        <h4 class="card-title">{{$label}}</span></h4>
        @include('compontent.dashboard.loader',["loader_id" => $key])
        <div id="{{$key}}-content" style="display: none">
            <div class="d-flex align-items-center">
            <div class="card-icon {{$key}}_class rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-{{$icon}}"></i>
            </div>
            <div class="ps-3">
                <h6 id="{{$key}}_count">0</h6>
            </div>
            </div>
        </div>
    </div>
    </div>
</div><!-- End Sales Card -->