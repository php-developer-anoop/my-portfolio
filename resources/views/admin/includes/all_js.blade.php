
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/common.js')}}"></script>
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

@if (session()->has('success'))
    <script>
        setTimeout(function () {
            toastr.success('{{ session()->get('success') }}');
        }, 1000);
    </script>
@endif

@if (session()->has('failed'))
    <script>
        setTimeout(function () {
            toastr.error('{{ session()->get('failed') }}');
        }, 1000);
    </script>
@endif

<script>
    CKEDITOR.replace('description');
    $(document).ready(function() {
        const $element = $('#pushmenu');

        if ($element.length > 0) {
            $element.click();
        }
    });

    function change_status(id, table) {
    $.ajax({
      url: '{{url(ADMINPATH.'changeStatus')}}',
      type: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
      data: { 'id': id, 'table': table },
      cache: false,
      success: function (response) {
          $('#label_id'+id).html(response);
      }
    });
  }

  function getSlug(val){
        $.ajax({
      url: '{{url(ADMINPATH.'getSlug')}}',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
      data: {
        'keyword': val
      },
      cache: false,
      success: function (response) {
       $('#page_slug').val(response);
       $('#menu_slug').val(response);
      }
    });
    }
    
</script>

</body>

</html>