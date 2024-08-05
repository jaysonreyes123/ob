<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
        <title>{{$title}}</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
       @include('layout.style')
      </head>
      <style>
        body{
            font-size: 16px;
            font-family:"Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif 
        }
        #main{
            min-height: calc(100vh - 130px);
        }
        .dt-layout-cell{
            overflow: auto !important;
        }
        input:focus,select:focus{
            outline: none;
            border: none;
            box-shadow: none !important;
            border:1px solid #ccc !important;
        }
        @media (min-width: 1400px) {
            .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl
            {
                max-width: 1700px !important;
            }
        }
      </style>
<body class="toggle-sidebar">

    @include('layout._header')
    <main id="main" class="main">
        @yield('content')
    </main>
    @include('layout.script')
    @include('layout._footer')
    
    @push('script')
    <script>
        var swal = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 2000,
		});
        $("input").attr('autocomplete','off')

        $(".select2").select2();
        $(".datetimepicker").datetimepicker();
    </script>
    @endpush
    
</body>
</html>
