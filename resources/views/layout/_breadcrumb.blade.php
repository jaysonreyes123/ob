<div class="pagetitle">
  <h1>{{$title}}</h1>
  <nav class="d-flex justify-content-between ">
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item active">{{$title}}</li>
      </ol>
    </div>
    {{-- @if ($menu == "dashboard")
      <div class="d-flex">
        @include('compontent.picklist')
        &nbsp;&nbsp;
        @include('compontent.datepicker')
        &nbsp;&nbsp;
        <button id="btn-filter" class="btn btn-sm btn-primary shadow-sm px-3"><span class="bi bi-funnel"></span></button>
      </div>
    @endif --}}
      @if (
        $menu != "dashboard" && $menu != 'collection-product' && $menu_header!="report" &&
        $menu !="customer" && $menu != "transaction-list" && $menu != "user-privileges" &&
        $menu != "leads" && $menu != "customer-service"
       )
      <div>
        <button class="shadow btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#{{$menu}}-modal"> Add {{$title}}</button>
      </div>
      @endif
  </nav>
</div>