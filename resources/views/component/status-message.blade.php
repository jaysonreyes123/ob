@if (Session::has('error-message'))
    @php
      $message = Session::get('error-message');
    @endphp
    @push('script')
    <script>
        var message = @json($message);
        Swal.fire({
        title: message,
        icon: "error"
        });
   </script>
   @endpush
@elseif (Session::has('success-message'))
    @php
        $message = Session::get('success-message');
    @endphp
    @push('script')
    <script>
        var message = @json($message);
        Swal.fire({
        title: message,
        icon: "success"
        }).then(function(){
            clearform()
        });
    </script>
    @endpush
@endif
