<section class="container-fluid main-container container-home p-0 revealator-slideup revealator-once revealator-delay1">
  <div class="color-block d-none d-lg-block"></div>
  <div class="row home-details-container align-items-center">
    <div class="col-lg-4 bg position-fixed d-none d-lg-block" style="background-image: url('{{ asset("uploads/" . $company['profile_image']) }}');">
  </div>
  <div class="col-12 col-lg-8 offset-lg-4 home-details text-left text-sm-center text-lg-left">
    <div>
      <img src="http://via.placeholder.com/300x300.jpg" class="img-fluid main-img-mobile d-none d-sm-block d-lg-none" alt="my picture" />
      <h1 class="text-uppercase poppins-font">I'm {{$company['first_name'].' '.$company['last_name']}}.<span>{{$company['role']}}</span></h1>
      <p class="open-sans-font">{{$company['short_description']}}</p>
      <a class="button" href="{{url('about-me')}}">
      <span class="button-text">more about me</span>
      <span class="button-icon fa fa-arrow-right"></span>
      </a>
    </div>
  </div>
  </div>
</section>