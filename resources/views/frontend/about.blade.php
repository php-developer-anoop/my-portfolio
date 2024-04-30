<section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
  <h1>ABOUT <span>ME</span></h1>
  <span class="title-bg">Resume</span>
</section>
<section class="main-content revealator-slideup revealator-once revealator-delay1">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-5 col-xl-6">
        <div class="row">
          <div class="col-12">
            <h3 class="text-uppercase custom-title mb-0 ft-wt-600">personal infos</h3>
          </div>
          <div class="col-12 d-block d-sm-none">
            <img src="http://via.placeholder.com/300x300.jpg" class="img-fluid main-img-mobile" alt="my picture" />
          </div>
          <div class="col-5">
            <ul class="about-list list-unstyled open-sans-font">
              <li> <span class="title">first name :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">{{!empty($company['first_name'])?$company['first_name']:''}}</span> </li>
              <li> <span class="title">last name :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">{{!empty($company['last_name'])?$company['last_name']:''}}</span> </li>
              <li> <span class="title">Age :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">{{!empty($company['age'])?$company['age']:''}} Years</span> </li>
              <li> <span class="title">Nationality :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">Indian</span> </li>

            </ul>
          </div>
          <div class="col-7">
            <ul class="about-list list-unstyled open-sans-font">
              <li> <span class="title">Address :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">{{!empty($company['address'])?$company['address']:''}}</span> </li>
              <li> <span class="title">phone :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">{{!empty($company['mobile_number'])?'+91'.$company['mobile_number']:''}}</span> </li>
              <li> <span class="title">Email :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">{{!empty($company['email'])?$company['email']:''}}</span> </li>
              <li> <span class="title">languages :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">Hindi, English</span> </li>
            </ul>
          </div>
          <div class="col-12 mt-3">
            <a class="button" href="{{ asset("uploads/" . $company['resume']) }}" download>
            <span class="button-text">Download CV</span>
            <span class="button-icon fa fa-download"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-7 col-xl-6 mt-5 mt-lg-0">
        <div class="row">
          <div class="col-6">
            <div class="box-stats with-margin">
              <h3 class="poppins-font position-relative">2</h3>
              <p class="open-sans-font m-0 position-relative text-uppercase">years of <span class="d-block">experience</span></p>
            </div>
          </div>
          <div class="col-6">
            <div class="box-stats with-margin">
              <h3 class="poppins-font position-relative">10</h3>
              <p class="open-sans-font m-0 position-relative text-uppercase">completed <span class="d-block">projects</span></p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <?php if(!empty($skills_list)){?>
    <hr class="separator">
    <div class="row">
      <div class="col-12">
        <h3 class="text-uppercase pb-4 pb-sm-5 mb-3 mb-sm-0 text-left text-sm-center custom-title ft-wt-600">My Skills</h3>
      </div>
      <?php foreach($skills_list as $skey=>$svalue){?>
      <div class="col-6 col-md-3 mb-3 mb-sm-5">
        <div class="c100 p{{$svalue['percentage']}}">
          <span>{{$svalue['percentage']}}%</span>
          <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
          </div>
        </div>
        <h6 class="text-uppercase open-sans-font text-center mt-2 mt-sm-4">{{$svalue['skill_name']}}</h6>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
    <hr class="separator mt-1">
    <div class="row">
      <div class="col-12">
        <h3 class="text-uppercase pb-5 mb-0 text-left text-sm-center custom-title ft-wt-600">Experience <span>&</span> Education</h3>
      </div>
      <?php if(!empty($experience_list)){?>
      <div class="col-lg-6 m-15px-tb">
        <div class="">
          <ul>
            <?php foreach($experience_list as $exkey=>$exvalue){?>
            <li class="mb-2">
              <div class="icon">
                <i class="fa fa-briefcase"></i>
              
              <span class="time open-sans-font text-uppercase px-2">{{$exvalue['from_year']}} - {{$exvalue['to_year']}}</span>
              </div>
              <h5 class="poppins-font text-uppercase">{{$exvalue['position']}} <span class="place open-sans-font">{{$exvalue['company']}}</span></h5>
              <div class="exp_desc">{!! $exvalue['description'] !!}</div>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <?php } ?>
      <?php if(!empty($education_list)){?>
      <div class="col-lg-6 m-15px-tb">
        <div class="resume-box">
          <ul>
          <?php foreach($education_list as $edkey=>$edvalue){?>
            <li>
              <div class="icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <span class="time open-sans-font text-uppercase">{{$edvalue['pass_year']}}</span>
              <h5 class="poppins-font text-uppercase">{{$edvalue['title']}}<span class="place open-sans-font">{{$edvalue['institution']}}</span></h5>
              <p class="open-sans-font">{{$edvalue['institution_place']}}</p>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>