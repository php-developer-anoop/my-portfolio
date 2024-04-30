<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?=url(ADMINPATH.'dashboard')?>" class="brand-link">
  <img src="{{$profile_image}}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light">{{$profile_name}}</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php //$uri = service('uri');
          // if (getUri(2)) {
          //    $url = getUri(2);
          // } else {
          //    $url = 'dashboard';
          // }
          $url='';
          ?>
        <li class="nav-item">
          <a href="<?=url(ADMINPATH.'dashboard')?>" class="nav-link <?=!empty($url)&& ($url=="dashboard")?"active":""?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Masters
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="fa fa-bars nav-icon"></i>
                <p>
                  CMS Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'add-cms')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add CMS</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'cms-list')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>CMS List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="fa fa-bars nav-icon"></i>
                <p>
                  Skill Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'add-skill')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Skill</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'skill-list')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Skill List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="fa fa-bars nav-icon"></i>
                <p>
                  Experience Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'add-experience')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Experience</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'experience-list')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Experience List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="fa fa-bars nav-icon"></i>
                <p>
                  Education Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'add-education')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Education</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'education-list')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Education List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="fa fa-bars nav-icon"></i>
                <p>
                  Portfolio Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'add-portfolio')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Portfolio</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=url(ADMINPATH.'portfolio-list')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Portfolio List</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?=url(ADMINPATH.'query-list')?>" class="nav-link <?=!empty($url)&& ($url=="query-list")?"active":""?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Query List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=url(ADMINPATH.'websetting')?>" class="nav-link <?=!empty($url)&& ($url=="websetting")?"active":""?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Web Setting</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>