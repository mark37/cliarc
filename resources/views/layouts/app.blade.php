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
  
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">

  <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
    html {
      height: 100%;
      box-sizing: border-box;
    }

    *,
    *:before,
    *:after {
      box-sizing: inherit;
    }

    footer {
      position: absolute;
      right: 0;
      bottom: 0;
      left: 0;
      padding: 1rem;
    }

    body {
      /* background:url({{ URL::asset('images/450.jpeg') }}) no-repeat !important; */
      background: url("/images/background.jpg");
      background-size:cover;
      background-attachment: fixed;
      min-height: 100%;
      position: relative;
      padding-bottom: 6rem;
    }

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

    .container{max-width:1170px; margin:auto;}
    img{ max-width:100%;}

    .inbox_people {
      background: #f8f8f8 none repeat scroll 0 0;
      float: left;
      overflow: hidden;
      width: 40%; border-right:1px solid #c4c4c4;
    }
    .inbox_msg {
      border: 1px solid #c4c4c4;
      clear: both;
      overflow: hidden;
    }
    .top_spac{ margin: 20px 0 0;}


    .recent_heading {float: left; width:40%;}
    .srch_bar {
      display: inline-block;
      text-align: right;
      width: 60%; padding:
    }
    .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

    .recent_heading h4 {
      color: #1c961f;
      font-size: 21px;
      margin: auto;
    }
    .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
    .srch_bar .input-group-addon button {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: medium none;
      padding: 0;
      color: #707070;
      font-size: 18px;
    }
    .srch_bar .input-group-addon { margin: 0 0 0 -27px;}

    .chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
    .chat_ib h5 span{ font-size:13px; float:right;}
    .chat_ib p{ font-size:14px; color:#989898; margin:auto}
    .chat_img {
      float: left;
      width: 11%;
    }
    .chat_ib {
      float: left;
      padding: 0 0 0 15px;
      width: 88%;
    }

    .chat_people{ overflow:hidden; clear:both;}
    .chat_list {
      border-bottom: 1px solid #c4c4c4;
      margin: 0;
      padding: 18px 16px 10px;
    }

    .chat_list:hover { cursor: pointer; background:#ebebeb; }
    /* .chat_people:hover{  } */

    .inbox_chat { height: 550px; overflow-y: scroll;}

    .active_chat{ background:#ebebeb;}

    .incoming_msg_img {
      display: inline-block;
      width: 6%;
    }
    .received_msg {
      display: inline-block;
      padding: 0 0 0 10px;
      vertical-align: top;
      width: 92%;
    }
    .received_withd_msg p {
      background: #ebebeb none repeat scroll 0 0;
      border-radius: 3px;
      color: #646464;
      font-size: 14px;
      margin: 0;
      padding: 5px 10px 5px 12px;
      width: 100%;
    }

    .time_date {
      color: #747474;
      display: block;
      font-size: 12px;
      margin: 8px 0 0;
    }
    .received_withd_msg { width: 57%;}
    .mesgs {
      float: left;
      padding: 30px 15px 0 25px;
      width: 60%;
    }

    .sent_msg p {
      background: #1c961f none repeat scroll 0 0;
      border-radius: 3px;
      font-size: 14px;
      margin: 0; color:#fff;
      padding: 5px 10px 5px 12px;
      width:100%;
    }
    .outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
    .sent_msg {
      float: right;
      width: 46%;
    }
    .input_msg_write input {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: medium none;
      color: #4c4c4c;
      font-size: 15px;
      min-height: 48px;
      width: 100%;
    }

    .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
    .msg_send_btn {
      background: #1c961f none repeat scroll 0 0;
      border: medium none;
      border-radius: 50%;
      color: #fff;
      cursor: pointer;
      font-size: 17px;
      height: 33px;
      position: absolute;
      right: 0;
      top: 11px;
      width: 33px;
    }

    .msg_attach_btn {
      background: #1c961f none repeat scroll 0 0;
      border: medium none;
      border-radius: 50%;
      color: #fff;
      font-size: 17px;
      height: 33px;
      position: absolute;
      right: 35px;
      top: 11px;
      width: 33px;
    }

    .msg_attach_btn input:hover {
      cursor: pointer;
    }

    .messaging { padding: 0 0 50px 0;}
    .msg_history {
      height: 516px;
      overflow-y: auto;
    }

    /* ABOUT US */
    .paddingTB60 {padding:60px 0px 60px 0px;}
    .gray-bg {background: #F1F1F1 !important;}
    .about-title {}
    .about-title h1 {color: #535353; font-size:45px;font-weight:600;}
    .about-title span {color: #14a743; font-size:45px;font-weight:700;}
    .about-title h3 {color: #535353; font-size:23px;margin-bottom:24px;}
    .about-title p {color: #7a7a7a;line-height: 1.8;margin: 0 0 15px;}
    .about-paddingB {padding-bottom: 12px;}
    .about-img {padding-left: 57px;}

    /* Social Icons */
    .about-icons {margin:48px 0px 48px 0px ;}
    .about-icons i{margin-right: 10px;padding: 0px; font-size:35px;color:#323232;box-shadow: 0 0 3px rgba(0, 0, 0, .2);}
    .about-icons li {margin:0px;padding:0;display:inline-block;}
    #social-fb:hover {color: #3B5998;transition:all .001s;}
    #social-tw:hover {color: #4099FF;transition:all .001s;}
    #social-gp:hover {color: #d34836;transition:all .001s;}
    #social-em:hover {color: #f39c12;transition:all .001s;}
    /* END ABOUT US */

    nav.navbar.navbar-expand-lg.navbar-dark.navbar-collapse.navbar-nav li.nav-item a.nav-link{
        color: blue;
    }
  </style>
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">Central Luzon Integrated Agricultural Research Center</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : ''}}" href="{{ url('/') }}">{{ __('Home') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ app('request')->input('product_type') == 'SD' ? 'active' : ''}}" href="{{ route('product_list',  ['product_type' => 'SD']) }}">{{ __('Products') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ app('request')->input('product_type') == 'EQ' ? 'active' : ''}}" href="{{ route('product_list',  ['product_type' => 'EQ']) }}">{{ __('Equipment') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteNamed('schedule') ? 'active' : ''}}" href="{{ url('/schedule') }}">{{ __('Schedules') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteNamed('about') ? 'active' : ''}}" href="{{ url('/about') }}">{{ __('About Us') }}</a>
            </li>

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
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{ Auth::user()->name }}, {{ Auth::user()->first_name }} 
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    @if(Auth::user()->account_type == 'CL')
                      <li><a class="dropdown-item" href="{{ route('product_list',  ['product_type' => 'SD']) }}">Product</a></li>
                      <li><a class="dropdown-item" href="{{ route('product_list',  ['product_type' => 'EQ']) }}">Equipment</a></li>
                    @else
                      <li><a class="dropdown-item" href="{{ url('/product_list') }}">Item Masterlist</a></li>
                    @endif
                    <li><a class="dropdown-item" href="{{ url('/chat') }}">Messages</a></li>

                    @if(Auth::user()->account_type != 'CL')
                      <li><a class="dropdown-item" href="{{ url('/product_item_out') }}">Requests</a></li>
                      <li><a class="dropdown-item" href="{{ url('/files_submitted') }}">File Submitted</a></li>
                    @endif
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
    <!-- <img id="logo-main" class="mx-auto d-block" src="/images/cliarc-banner.jpg" width="1140px" height="200px" alt="Logo Thing main logo"> -->
    
    
      <main class="my-5 wrap">
        <div class="my-5">
          @yield('content')
        </div>
      </main>
      
  </div>

  <!-- <script src="{{asset('js/app.js')}}"></script> -->
  @routes
  <script src="{{ asset('js/app.js') }}"></script>
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
        var filename = button.data('filename') 
        var modal = $(this)
        
        modal.find('.modal-body #product_id').val(productid);
        modal.find('.modal-body #product_name').val(productname);
        modal.find('.modal-body #product_desc').val(productdesc);
        modal.find('.modal-body #product_unit').val(productunit);
        modal.find('.modal-body #product_status').val(productunit);
        modal.find('.modal-body #productype').val(producttype);
        modal.find('.modal-body #filename').val(filename);
    });
    

   

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var productid = button.data('productid')
        var productname = button.data('productname') 
        var modal = $(this)
        
        modal.find('.modal-body #product_id').val(productid);
        modal.find('.modal-body #product_name').val(productname);

    });

    $('#requestModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var productid = button.data('productid')
        var productname = button.data('productname') 
        var userid= button.data('userid')
        var modal = $(this)
        
        modal.find('.modal-body #product_item_id').val(productid);
        modal.find('.modal-body #product_name').val(productname);
        modal.find('.modal-body #user_id').val(userid);
    });

    $('#processRequestModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var requestid = button.data('requestid')
        var productname = button.data('productname') 
        var userid = button.data('userid')
        var requestedby = button.data('requestedby')
        var requestnotes = button.data('requestnotes')
        var modal = $(this)

        modal.find('.modal-body #request_id').val(requestid);
        modal.find('.modal-body #product_name').val(productname);
        modal.find('.modal-body #user_id').val(userid);
        modal.find('.modal-body #requested_by').val(requestedby);
        modal.find('.modal-body #request_notes').val(requestnotes);
        modal.find('.modal-body #user_id').val(userid);
    });

    $('#editSched').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var scheduleid = button.data('scheduleid') 
        var schedulename = button.data('schedulename') 
        var scheduledesc = button.data('scheduledesc') 
        var schedulesdate = button.data('schedulesdate') 
        var scheduleedate = button.data('scheduleedate') 
        var schedulevenue = button.data('schedulevenue') 
        var modal = $(this)
        
        modal.find('.modal-body #schedule_id').val(scheduleid);
        modal.find('.modal-body #schedule_name').val(schedulename);
        modal.find('.modal-body #schedule_desc').val(scheduledesc);
        modal.find('.modal-body #schedule_start_date').val(schedulesdate);
        modal.find('.modal-body #schedule_end_date').val(scheduleedate);
        modal.find('.modal-body #schedule_venue').val(schedulevenue);
    });

    $('#deleteSched').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var scheduleid = button.data('scheduleid')  
        var modal = $(this)
        
        modal.find('.modal-body #schedule_id').val(scheduleid);
    });

    $('#account_type').change(function(){
      if($(this).val() == 'EM'){
        $('#id_number').prop("disabled", false);        
      }else{
        $('#id_number').prop("disabled", true);
      }
    });
  </script>
</body>

  <footer class="py-3 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; CLIARCLD 2018</p>
    </div>
  </footer>
</html>
