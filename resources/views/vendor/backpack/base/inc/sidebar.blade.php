    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
      @if(Auth::check())
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image"/>
            </div><!--pull-left-->
            <div class="pull-left info">
              <p>{{ access()->user()->name }}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}
              </a>
            </div><!--pull-left-->
          </div><!--user-panel-->
      @endif()
      <!-- search form (Optional) -->
        <ul class="sidebar-menu">
        <li class="header">SEARCH</li>
        </ul>
        {{ Form::open(['url' => '/conceptprop/search', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
          <input type=search name="q" results=5 class="form-control" autosave=search_concepts required placeholder="Search Concepts...">
          <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
      {{ Form::close() }}
        {{ Form::open(['url' => '/schemaprop/search', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
          <input type=search name=q results=5 class="form-control" autosave=search_elements required placeholder="Search Elements...">
          <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
      {{ Form::close() }}
      <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">BROWSE</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{url('/projects')}}"><i class="fa fa-gears"></i> <span>Projects</span></a></li>
          <li><a href="{{url('/vocabularies')}}" ><i class="fa fa-gears"></i> <span>Vocabularies</span></a></li>
          <li><a href="{{url('/elementsets')}}" ><i class="fa fa-gears"></i> <span>Element Sets</span></a></li>
          <!-- ======================================= -->
          @if (auth::check())
          <li class="header">MY...</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          @endif
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
