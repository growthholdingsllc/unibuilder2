<!-- inner content wrapper -->
<div class="wrapper">
  <div class="row mb25">
    <div class="col-sm-6">
      <div class="demo-button">
        <div class="h5 mb10">Basic button options</div>
        <!-- Standard button -->
        <button class="btn btn-default">Default</button>
        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        <button type="button" class="btn btn-primary">Primary</button>
        <!-- Indicates a successful or positive action -->
        <button type="button" class="btn btn-success">Success</button>
        <!-- Contextual button for informational alert messages -->
        <button type="button" class="btn btn-info">Info</button>
        <!-- Indicates caution should be taken with this action -->
        <button type="button" class="btn btn-warning">Warning</button>
        <!-- Indicates a dangerous or potentially negative action -->
        <button type="button" class="btn btn-danger">Danger</button>
        <button type="button" class="btn btn-color">Palette button</button>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="demo-button">
        <div class="h5 mb10">Or have some rounded styles</div>
        <!-- Standard button --> 
        <a href="javascript:;" class="btn btn-default btn-rounded">Default</a> 
        <!-- Provides extra visual weight and identifies the primary action in a set of buttons --> 
        <a href="javascript:;" class="btn btn-primary btn-rounded">Primary</a> 
        <!-- Indicates a successful or positive action --> 
        <a href="javascript:;" class="btn btn-success btn-rounded">Success</a> 
        <!-- Contextual button for informational alert messages --> 
        <a href="javascript:;" class="btn btn-info btn-rounded">Info</a> 
        <!-- Indicates caution should be taken with this action --> 
        <a href="javascript:;" class="btn btn-warning btn-rounded">Warning</a> 
        <!-- Indicates a dangerous or potentially negative action --> 
        <a href="javascript:;" class="btn btn-danger btn-rounded">Danger</a> <a href="javascript:;" class="btn btn-color btn-rounded">Palette Button</a> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <section class="mb25">
        <div class="h5 mb10">Outline Button Styles</div>
        <div class="demo-button"> 
          <!-- Standard button -->
          <button class="btn btn-default btn-outline">Default</button>
          <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
          <button type="button" class="btn btn-primary btn-outline">Primary</button>
          <!-- Indicates a successful or positive action -->
          <button type="button" class="btn btn-success btn-outline">Success</button>
          <!-- Contextual button for informational alert messages -->
          <button type="button" class="btn btn-info btn-outline">Info</button>
          <!-- Indicates caution should be taken with this action -->
          <button type="button" class="btn btn-warning btn-outline btn-rounded">Warning</button>
          <!-- Indicates a dangerous or potentially negative action -->
          <button type="button" class="btn btn-danger btn-outline btn-rounded">Danger</button>
          <button type="button" class="btn btn-color btn-outline btn-rounded">Palette button</button>
        </div>
      </section>
      <section class="mb25">
        <div class="h5 mb10">Dropdowns and Dropups</div>
        <div class="btn-group">
          <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span> </button>
          <ul class="dropdown-menu" role="menu">
            <li> <a href="javascript:;">Action</a> </li>
            <li> <a href="javascript:;">Another action</a> </li>
            <li> <a href="javascript:;">Something else here</a> </li>
            <li class="divider"></li>
            <li> <a href="javascript:;">Separated link</a> </li>
          </ul>
        </div>
        
        <!-- btn-group -->
        <div class="btn-group dropup">
          <button type="button" class="btn btn-danger btn-sm">Dropup</button>
          <button type="button" class="btn btn-danger dropdown-toggle btn-sm" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <li> <a href="javascript:;">Action</a> </li>
            <li> <a href="javascript:;">Another action</a> </li>
            <li> <a href="javascript:;">Something else here</a> </li>
            <li class="divider"></li>
            <li> <a href="javascript:;">Separated link</a> </li>
          </ul>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span> </button>
          <ul class="dropdown-menu" role="menu">
            <li> <a href="javascript:;">Action</a> </li>
            <li> <a href="javascript:;">Another action</a> </li>
            <li> <a href="javascript:;">Something else here</a> </li>
            <li class="divider"></li>
            <li> <a href="javascript:;">Separated link</a> </li>
          </ul>
        </div>
      </section>
      <section class="mb25">
        <div class="h5 mb10">Block Level Buttons</div>
        <button type="button" class="btn btn-default btn-lg btn-block">Block level button</button>
        <button type="button" class="btn btn-default btn-block">Block level button</button>
        <button type="button" class="btn btn-default btn-sm btn-block">Block level button</button>
        <button type="button" class="btn btn-default btn-xs btn-block">Block level button</button>
      </section>
      <section class="mb25">
        <div class="h5 mb10">Icon Buttons</div>
        <div class="">
          <button type="button" class="btn btn-primary btn-sm loading-demo mr5" data-loading-text="Sending data ..."> <i class="ti-share mr5"></i>Submit</button>
          <button type="button" class="btn btn-success btn-sm mr5"> <i class="ti-reload"></i> </button>
          <button type="button" class="btn btn-danger btn-sm mr5"> Warning <i class="ti-alert mr5"></i> </button>
          <button type="button" class="btn btn-default btn-sm mr5"> Upload <i class="ti-upload ml5"></i> </button>
        </div>
        <div class="clearfix mt15"></div>
        <div class="btn-group mr5" data-toggle="buttons">
          <label class="btn btn-default btn-sm no-m">
            <input type="radio" name="options" id="option1">
            <i class="ti-thumb-up mr5"></i>Like </label>
          <label class="btn btn-default btn-sm">
            <input type="radio" name="options" id="option2">
            <i class="ti-thumb-down mr5"></i>Dislike </label>
        </div>
        <button data-toggle="button" class="btn btn-default btn-sm mr5"> <i class="ti-heart text-danger"></i> </button>
        <div class="btn-group" data-toggle="buttons">
          <label class="btn btn-default btn-sm no-m">
            <input type="checkbox">
            <i class="fa fa-align-left"></i> </label>
          <label class="btn btn-primary btn-sm no-m">
            <input type="checkbox">
            <i class="fa fa-align-center"></i> </label>
          <label class="btn btn-sm btn-default">
            <input type="checkbox">
            <i class="fa fa-align-right"></i> </label>
        </div>
        <section class="mt25">
          <p>Button Sizes</p>
          <div class="demo-button2">
            <p> <a href="javascript:;" class="btn btn-default btn-lg mr5">Large button</a> <a href="javascript:;" class="btn btn-primary mr5">Default button</a> <a href="javascript:;" class="btn btn-danger btn-sm mr5">Small button</a> <a href="javascript:;" class="btn btn-success btn-xs">Extra small button</a> </p>
          </div>
        </section>
      </section>
    </div>
    <div class="col-md-6">
      <section class="mb25">
        <div class="h5 mb10">Justified links</div>
        <div class="btn-group btn-group-justified"> <a class="btn btn-primary btn-rounded" role="button">Left</a> <a class="btn btn-success" role="button">Middle</a> <a class="btn btn-info btn-rounded" role="button">Right</a> </div>
      </section>
      <section class="mb25">
        <div class="h5 mb10">Button groups</div>
        <div class="btn-group">
          <button type="button" class="btn btn-default">Left</button>
          <button type="button" class="btn btn-default">Middle</button>
          <button type="button" class="btn btn-default">Right</button>
        </div>
        <h6>Button toolbar</h6>
        <div class="btn-toolbar" role="toolbar">
          <div class="btn-group">
            <button type="button" class="btn btn-success">1</button>
            <button type="button" class="btn btn-success">2</button>
            <button type="button" class="btn btn-success">3</button>
            <button type="button" class="btn btn-success">4</button>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-primary">5</button>
            <button type="button" class="btn btn-primary">6</button>
            <button type="button" class="btn btn-primary">7</button>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-warning">8</button>
          </div>
        </div>
        <h6>Button nesting</h6>
        <div class="btn-group">
          <button type="button" class="btn btn-default">1</button>
          <button type="button" class="btn btn-default">2</button>
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span> </button>
            <ul class="dropdown-menu">
              <li> <a href="javascript:;">Dropdown link</a> </li>
              <li> <a href="javascript:;">Dropdown link</a> </li>
            </ul>
          </div>
        </div>
        <h6>Vertical Group button</h6>
        <div class="btn-group-vertical">
          <button type="button" class="btn btn-default">Top</button>
          <button type="button" class="btn btn-default">Middle</button>
          <button type="button" class="btn btn-default">Bottom</button>
        </div>
      </section>
      <section class="panel">
        <header class="panel-heading no-b">
          <h5>Star <b>RATING</b></h5>
        </header>
        <div class="panel-body">
          <input type="number" name="your_awesome_parameter" id="some_id" class="rating" data-max="5" data-min="1" data-icon-lib="fa fa-2x mr5" data-active-icon="fa-star text-warning" data-inactive-icon="fa-star-o" data-clearable-icon="fa-trash-o" data-clearable="remove" />
        </div>
      </section>
      <section> <a class="btn btn-social btn-sm btn-facebook mr5"><i class="fa fa-facebook"></i> Facebook </a> <a class="btn btn-social btn-sm btn-twitter mr5"><i class="fa fa-twitter"></i> Twitter </a> <a class="btn btn-social btn-sm btn-github"><i class="fa fa-github"></i> GitHub </a> <a class="btn btn-social-icon btn-sm btn-soundcloud"><i class="fa fa-soundcloud"></i></a> <a class="btn btn-social-icon btn-sm btn-google-plus btn-rounded"><i class="fa fa-google-plus"></i></a> </section>
    </div>
  </div>
</div>
<!-- /inner content wrapper -->