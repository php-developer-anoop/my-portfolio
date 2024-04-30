<script src="{{ asset('frontend/js/jquery-3.5.0.min.js')}}"></script>
<script src="{{ asset('frontend/js/preloader.min.js')}}"></script>
<script src="{{ asset('frontend/js/fm.revealator.jquery.min.js')}}"></script>
<script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('frontend/js/masonry.pkgd.min.js')}}"></script>
<script src="{{ asset('frontend/js/classie.js')}}"></script>
<script src="{{ asset('frontend/js/cbpGridGallery.js')}}"></script>
<script src="{{ asset('frontend/js/jquery.hoverdir.js')}}"></script>
<script src="{{ asset('frontend/js/popper.min.js')}}"></script>
<script src="{{ asset('frontend/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('frontend/js/custom.js')}}"></script>
<script src="{{ asset('assets/common.js')}}"></script>
<script>
    function getRandomCaptcha(){
    $.ajax({
       url: "<?=url('getRandomCaptcha')?>",
       cache: false,
       method: 'POST',
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
       success: function(html) {
           $('.csrf').val(html);
           $('.bgreprat').html(html);
           
       }
   });
  }
</script>