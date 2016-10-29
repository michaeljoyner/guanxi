@if(session()->has('flash_message'))
    <script>
        swal({
            type: "{{ session('flash_message.type')  }}",
            title: "{{ session('flash_message.title') }}",
            text: "{{ session('flash_message.text') }}",
            timer: 1500,
            showConfirmButton: false
        });
    </script>
@endif