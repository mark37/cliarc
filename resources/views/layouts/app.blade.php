<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'CLIARC') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
    .chat {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .chat li {
      margin-bottom: 10px;
      padding-bottom: 5px;
      border-bottom: 1px dotted #B3A9A9;
    }

    .chat li .chat-body p {
      margin: 0;
      color: #777777;
    }

    .panel-body {
      overflow-y: scroll;
      height: 350px;
    }

    ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      background-color: #F5F5F5;
    }

    ::-webkit-scrollbar {
      width: 12px;
      background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
      background-color: #555;
    }
  </style>
</head>
<body>
  <div id="app">
    x<example></example>
    <img id="logo-main" class="mx-auto d-block" src="/images/cliarc-banner.jpg" width="1140px" height="200px" alt="Logo Thing main logo">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark navbar-laravel">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-block" id="navbarSupportedContent" width="900px">
          <!-- Left Side Of Navbar -->  
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/home') }}">{{ __('Home') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/product_list') }}">{{ __('Products') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">{{ __('Schedules') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">{{ __('Organizations') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">{{ __('About Us') }}</a>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @else
            <li class="nav-item dropdown">
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{ Auth::user()->name }} 
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <!-- <li><a class="dropdown-item" href="{{ url('/users') }}">Users Accounts</a></li> -->
                  <li><a class="dropdown-item" href="{{ url('/product_list') }}">Item Masterlist</a></li>
                  <li><a class="dropdown-item" href="{{ url('/product_item_out') }}">Requests</a></li>
                  <!-- <li><a class="dropdown-item" href="{{ url('/locations') }}">Groups</a></li> -->
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </li>
                </ul>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-4">
      @yield('content')
    </main>
  </div>

  <!-- <script src="{{asset('js/app.js')}}"></script> -->

  <script>
    window.Laravel = <?php echo json_encode([
      'csrfToken' => csrf_token(),
    ]); ?>

    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var productid = button.data('productid') 
        var productname = button.data('productname') 
        var productdesc = button.data('productdesc') 
        var productunit = button.data('productunit') 
        var productstatus = button.data('productstatus') 
        var producttype = button.data('producttype') 
        var modal = $(this)
        
        modal.find('.modal-body #product_id').val(productid);
        modal.find('.modal-body #product_name').val(productname);
        modal.find('.modal-body #product_desc').val(productdesc);
        modal.find('.modal-body #product_unit').val(productunit);
        modal.find('.modal-body #product_status').val(productunit);
        modal.find('.modal-body #productype').val(producttype);
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var productid = button.data('productid')
        var productname = button.data('productname') 
        var modal = $(this)
        
        modal.find('.modal-body #product_id').val(productid);
        modal.find('.modal-body #product_name').val(productname);

    });

    $('#processRequestModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var requestid = button.data('requestid')
        var productname = button.data('productname') 
        var requestdate= button.data('requestdate')
        var requestnotes= button.data('requestnotes')
        var requestedby= button.data('requestedby')
        var modal = $(this)
        
        modal.find('.modal-body #request_id').val(requestid);
        modal.find('.modal-body #product_name').val(productname);
        modal.find('.modal-body #request_date').val(requestdate);
        modal.find('.modal-body #request_notes').val(requestnotes);
        modal.find('.modal-body #requested_by').val(requestedby);
    });
  </script>
</body>
</html>
