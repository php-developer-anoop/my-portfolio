</head>
<body class="{{$body_class}}">
<?php $uri = request()->segment(1);?>
  <header class="header" id="navbar-collapse-toggle">
    <ul class="icon-menu d-none d-lg-block revealator-slideup revealator-once revealator-delay1">
      <li class="icon-box {{empty($uri)?'active':''}}">
        <i class="fa fa-home"></i>
        <a href="{{url('/')}}">
          <h2>Home</h2>
        </a>
      </li>
      <li class="icon-box {{!empty($uri) && ($uri == 'about-me')?'active':''}}">
        <i class="fa fa-user"></i>
        <a href="{{url('about-me')}}">
          <h2>About</h2>
        </a>
      </li>
      <li class="icon-box {{!empty($uri) && ($uri == 'portfolio')?'active':''}}">
        <i class="fa fa-briefcase"></i>
        <a href="{{url('portfolio')}}">
          <h2>Portfolio</h2>
        </a>
      </li>
      <li class="icon-box {{!empty($uri) && ($uri == 'contact-me')?'active':''}}">
        <i class="fa fa-envelope-open"></i>
        <a href="{{url('contact-me')}}">
          <h2>Contact</h2>
        </a>
      </li>
    </ul>
    <nav role="navigation" class="d-block d-lg-none">
      <div id="menuToggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
        <ul class="list-unstyled" id="menu">
          <li class="active"><a href="{{url('/')}}"><i class="fa fa-home"></i><span>Home</span></a></li>
          <li><a href="{{url('about-me')}}"><i class="fa fa-user"></i><span>About</span></a></li>
          <li><a href="{{url('portfolio')}}"><i class="fa fa-folder-open"></i><span>Portfolio</span></a></li>
          <li><a href="{{url('contact-me')}}"><i class="fa fa-envelope-open"></i><span>Contact</span></a></li>
        </ul>
      </div>
    </nav>
  </header>