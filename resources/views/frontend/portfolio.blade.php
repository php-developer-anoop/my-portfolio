<section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
  <h1>my <span>portfolio</span></h1>
  <span class="title-bg">works</span>
</section>
<section class="main-content text-center revealator-slideup revealator-once revealator-delay1">
  <div id="grid-gallery" class="container grid-gallery">
    <?php if(!empty($portfolio_list)){?>
    <section class="grid-wrap">
      <ul class="row grid">
        <?php foreach($portfolio_list as $plkey=>$plvalue){?>
        <li>
          <figure>
            <img src="{{asset('uploads/'.$plvalue['project_image'])}}" alt="{{$plvalue['project_category']}}" />
            <div><span>{{$plvalue['project_category']}}</span></div>
          </figure>
        </li>
        <?php } ?>
      </ul>
    </section>
    <?php } ?>
    <?php if(!empty($portfolio_list)){?>
    <section class="slideshow">
      <ul>
        <?php foreach($portfolio_list as $pkey=>$pvalue){?>
        <li>
          <figure>
            <figcaption>
              <h3>{{$pvalue['project_category']}}</h3>
              <div class="row open-sans-font">
                <div class="col-12 col-sm-6 mb-2">
                  <i class="fa fa-file-text-o pr-2"></i><span class="project-label">Project </span>: <span class="ft-wt-600 uppercase">{{$pvalue['project_name']}}</span>
                </div>
                <div class="col-12 col-sm-6 mb-2">
                  <i class="fa fa-external-link pr-2"></i><span class="project-label">Preview </span>: <span class="ft-wt-600 uppercase"><a href="{{$pvalue['project_url']}}" target="_blank" style="text-decoration:none;">Go To Website</a></span>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-2">
                  <i class="fa fa-info pr-2"></i><span class="project-label">Description </span>: <span class="ft-wt-600 uppercase">{{$pvalue['short_description']}}</span>
                </div>
              </div>
            </figcaption>
            <img src="{{asset('uploads/'.$pvalue['project_image'])}}" alt="{{$pvalue['project_category']}}" />
          </figure>
        </li>
        <?php } ?>
      </ul>
      <nav>
        <span class="icon nav-prev"><img src="{{asset('frontend/img/projects/navigation/left-arrow.png')}}" alt="previous"></span>
        <span class="icon nav-next"><img src="{{asset('frontend/img/projects/navigation/right-arrow.png')}}" alt="next"></span>
        <span class="nav-close"><img src="{{asset('frontend/img/projects/navigation/close-button.png')}}" alt="close"> </span>
      </nav>
    </section>
    <?php } ?>
  </div>
</section>