 <!-- ======= Sidebar ======= -->


  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav"> 


      @if (Auth::user()->role == 4 || Auth::user()->role == 5)
      <li class="nav-item">
        <a class="nav-link {{$menu == "webform" ? "" : "collapsed"}}" href="{{env('AGENT_URL')}}webform">
          <i class="bi bi-grid" style="margin-top: -4px"></i>
          <span>Web Form</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{$menu == "transaction-list" ? "" : "collapsed"}}" href="{{env('AGENT_URL')}}transaction-list">
          <i class="bi bi-grid" style="margin-top: -4px"></i>
          <span>Transaction List</span>
        </a>
      </li>
      @else
      

      <li class="nav-item {{Auth::user()->user_privileges_->dashboard == 0 ? 'd-none' : ''}} ">
        <a class="nav-link {{$menu == "dashboard" ? "" : "collapsed"}}" href="{{env('APP_URL')}}admin/dashboard">
          <i class="bi bi-grid" style="margin-top: -4px"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{$menu == "transaction-list" ? "" : "collapsed"}}" href="{{env('APP_URL')}}admin/transaction-list">
          <i class="bi bi-card-text" style="margin-top: -4px"></i>
          <span>Transaction List</span>
        </a>
      </li>

      <li class="nav-item {{Auth::user()->user_privileges_->customer_information == 0 ? 'd-none' : ''}} ">
        <a class="nav-link {{$menu == "customer" ? "" : "collapsed"}}" href="{{env('APP_URL')}}admin/customer">
          <i class="bi bi-people" style="margin-top: -4px"></i>
          <span>Customer Information</span>
        </a>
      </li>

      <li class="nav-item {{Auth::user()->user_privileges_->customer_service == 0 ? 'd-none' : ''}} ">
        <a class="nav-link {{$menu == "customer-service" ? "" : "collapsed"}}" href="{{env('APP_URL')}}admin/customer-service">
          <i class="bi bi-people" style="margin-top: -4px"></i>
          <span>Customer Service</span>
        </a>
      </li>

      <li class="nav-item {{Auth::user()->user_privileges_->leads == 0 ? 'd-none' : ''}}  ">
        <a class="nav-link {{$menu == "leads" ? "" : "collapsed"}}" href="{{env('APP_URL')}}admin/leads">
          <i class="bi bi-people" style="margin-top: -4px"></i>
          <span>Leads</span>
        </a>
      </li>

      <li class="nav-item {{Auth::user()->user_privileges_->user == 0 ? 'd-none' : ''}} ">
        <a class="nav-link {{$menu == "user" ? "" : "collapsed"}}" href="{{env('APP_URL')}}admin/user">
          <i class="bi bi-people" style="margin-top: -4px"></i>
          <span>User</span>
        </a>
      </li>

      <li class="nav-item {{Auth::user()->user_privileges_->user_privileges == 0 ? 'd-none' : ''}} ">
        <a class="nav-link {{$menu == "user-privileges" ? "" : "collapsed"}}" href="{{env('APP_URL')}}admin/user-privileges">
          <i class="bi bi-people" style="margin-top: -4px"></i>
          <span>User Privileges</span>
        </a>
      </li>
      

      <li class="nav-item {{Auth::user()->user_privileges_->product == 0 ? 'd-none' : ''}} ">
        <a class="nav-link  {{$menu_header == "product" ? "" : "collapsed" }}" data-bs-target="#product" data-bs-toggle="collapse" href="#">
          <i class="bi bi-grid-1x2" style="margin-top: -4px"></i>
          <span>Product</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product" class="nav-content {{$menu_header == "product" ? "" : "collapse" }}" data-bs-parent="#sidebar-nav">
          <li class="nav-item">
            <a class=" {{$menu == "ob-product" ? "nav-link active" : ""}}" href="{{env('APP_URL')}}admin/ob-product">
              <i class="bi bi-circle"></i>
              <span>Ob Product</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="{{$menu == "collection-product" ? "nav-link  active" : ""}}" href="{{env('APP_URL')}}admin/collection-product">
              <i class="bi bi-circle"></i>
              <span>Collection Product</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item {{Auth::user()->user_privileges_->report == 0 ? 'd-none' : ''}} ">
        <a class="nav-link  {{$menu_header == "report" ? "" : "collapsed" }}" data-bs-target="#report" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-text" style="margin-top: -4px"></i>
          <span>Report</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="report" class="nav-content {{$menu_header == "report" ? "" : "collapse" }}" data-bs-parent="#sidebar-nav">
          <li class="nav-item">
            <a class="{{$menu == "sales-report" ? "nav-link  active" : ""}}" href="{{env('APP_URL')}}admin/sales-report">
              <i class="bi bi-circle"></i>
              <span>Sales Report</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="{{$menu == "customer-information" ? "nav-link  active" : ""}}" href="{{env('APP_URL')}}admin/customer-information">
              <i class="bi bi-circle"></i>
              <span>Customer Information</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="{{$menu == "agent-sales" ? "nav-link  active" : ""}}" href="{{env('APP_URL')}}admin/agent-sales">
              <i class="bi bi-circle"></i>
              <span>Agent Sales</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="{{$menu == "product-list" ? "nav-link  active" : ""}}" href="{{env('APP_URL')}}admin/product-list">
              <i class="bi bi-circle"></i>
              <span>Product List</span>
            </a>
          </li>
        </ul>
      </li>
      @endif


    </ul>


  </aside><!-- End Sidebar-->