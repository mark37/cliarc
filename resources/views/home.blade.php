@extends('layouts.app')

@section('content')
<div class="container">

  <!-- Jumbotron Header -->
  <header>
    <div>
      &nbsp;
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="/images/cliarc-banner.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="/images/cliarc-banner-2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="/images/cliarc-banner-3.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!-- <img id="logo-main" class="mx-auto d-block" src="/images/cliarc-banner.jpg" alt="Logo Thing main logo">  -->
    <p class="lead"></p>
  </header>

  <!-- Page Features -->
  <div class="row text-center">

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card">
        <img class="card-img-top" src="/images/min-banner1.jpg" alt="banner 1">
        <div class="card-body">
          <h4 class="card-title">Seminars</h4>
          <p class="card-text">CLIARC Provides technical assistance by means of seminars, trainings, consultations and technology demonstration.</p>
        </div>
        <div class="card-footer">
          <a href="{{ url('/schedule') }}" class="btn btn-primary">View Schedules</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card">
        <img class="card-img-top" src="/images/min-banner2.jpg" alt="banner 2">
        <div class="card-body">
          <h4 class="card-title">Seeds</h4>
          <p class="card-text">Vegetable seeds and fruit bearing tress/seedlings are distributed to all vegetable associations/cooperatives/farmer’s organizations and household to the program and expansion areas which designed to eradicate incidence of hunger, nutrious, safe, affordable vegetable, fruits and ensure sufficiency of the supply of vegetable/ fruits in the region..</p>
        </div>
        <div class="card-footer">
          <a href="{{ url('/product_list') }}" class="btn btn-primary">Find Out More</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card">
        <img class="card-img-top" src="/images/min-banner3.jpg" alt="banner 3">
        <div class="card-body">
          <h4 class="card-title">Farm Equipments</h4>
          <p class="card-text">We serve as depository for farm machineries/equipments, rice/corn seeds and fertilizers in support to the Regional Banner Programs. </p>
        </div>
        <div class="card-footer">
          <a href="{{ url('/product_list') }}" class="btn btn-primary">Find Out More</a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card">
        <img class="card-img-top" src="/images/min-banner4.jpg" alt="banner 4">
        <div class="card-body">
          <h4 class="card-title">R & D</h4>
          <p class="card-text">Cooperate with other R&D institutions in the development, adaptation and commercialization of agri-based production and post-production technologies including the coordination of on-station and on-farm trainings..</p>
        </div>
        <div class="card-footer">
          <a href="/about" class="btn btn-primary">Find Out More</a>
        </div>
      </div>
    </div>
  </div>
</div>

    <footer class="py-5 bg-dark">
        <div class="container">
          <p class="m-0 text-center text-white">Copyright &copy; CLIARCMTDC 2018</p>
        </div>
    </footer>
@endsection
