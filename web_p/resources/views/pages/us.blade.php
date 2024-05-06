@extends('template.intern')

@section('css')
@endsection
@section('js')
@endsection
@section('body')
<div>
    <div>
        @include('components.layout.header')
    </div>
    <div class="container">
      <div class="row my-5 py-5">
        <div class="col-xl-4">
          <div class="value-container">
            <div class="value-image">
              <img src="https://via.placeholder.com/350x250" alt class="image-fluid w-100" />
            </div>
            <div class="value-content">
              <div class="value-title">LOREM IPSUM DOLOR</div>
              <div class="value-description">
                Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod �ncidunt ut laoreet dolore magna
                aliquam erat volutpat
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="value-container">
            <div class="value-image">
              <img src="https://via.placeholder.com/350x250" alt class="image-fluid w-100" />
            </div>
            <div class="value-content">
              <div class="value-title">LOREM IPSUM DOLOR</div>
              <div class="value-description">
                Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod �ncidunt ut laoreet dolore magna
                aliquam erat volutpat
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="value-container">
            <div class="value-image">
              <img src="https://via.placeholder.com/350x250" alt class="image-fluid w-100" />
            </div>
            <div class="value-content">
              <div class="value-title">LOREM IPSUM DOLOR</div>
              <div class="value-description">
                Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod �ncidunt ut laoreet dolore magna
                aliquam erat volutpat
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="padding: 0px 10%">
       <div class="paralax-section my-5">
      <div class="image d-none d-md-block">
        <img src="{{asset('img/about-section.jpg')}}" alt class="image-fluid w-100" />
      </div>
      <div class="content-paralax-section">
        <div class="content-about">
          <div class="row">
            <div class="col-12">
              <div class="section-title">Lorem ipsum Dolor</div>
            </div>
            <div class="col-lg-6 col-md-3 col-12">
              <div class="benefit-container-us">
                <div class="image">
                    <img src="{{asset('icons/heart.svg')}}" alt class="img-fluid image-benefit" />
                </div>
                <div class="title">Lorem ipsum dolortu</div>
                <div class="description">Lorem ipsum dolor</div>
              </div>
            </div>
            <div class="col-lg-6 col-md-3 col-12">
              <div class="benefit-container-us">
                <div class="image">
                    <img src="{{asset('icons/heart.svg')}}" alt class="img-fluid image-benefit" />
                </div>
                <div class="title">Lorem ipsum dolortu</div>
                <div class="description">Lorem ipsum dolor</div>
              </div>
            </div>
            <div class="col-lg-6 col-md-3 col-12">
              <div class="benefit-container-us">
                <div class="image">
                    <img src="{{asset('icons/heart.svg')}}" alt class="img-fluid image-benefit" />
                </div>
                <div class="title">Lorem ipsum dolortu</div>
                <div class="description">Lorem ipsum dolor</div>
              </div>
            </div>
            <div class="col-lg-6 col-md-3 col-12">
              <div class="benefit-container-us">
                <div class="image">
                    <img src="{{asset('icons/heart.svg')}}" alt class="img-fluid image-benefit" />
                </div>
                <div class="title">Lorem ipsum dolortu</div>
                <div class="description">Lorem ipsum dolor</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

    <div class="container mb-5 pb-5">
      <div class="our-team-title">Nuestro Equipo</div>
          <div
            class="our-team-subtitle"
          >Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh</div>
      <div class="our-team-members">
        <div class="our-team-container">
          <div class="our-team-group">
            <div class="team-member-container">
              <div class="team-member-image">
                <img class="image-fluid w-100" src="https://via.placeholder.com/250x200" alt />
              </div>
              <div class="team-member-info">
                <div class="team-member-name">Nombre Apellido</div>
                <div class="team-member-position">Cargo Empresa</div>
              </div>
            </div>
          </div>
        </div>
        <div class="our-team-container">
          <div class="our-team-group">
            <div class="team-member-container">
              <div class="team-member-image">
                <img class="image-fluid w-100" src="https://via.placeholder.com/250x200" alt />
              </div>
              <div class="team-member-info">
                <div class="team-member-name">Nombre Apellido</div>
                <div class="team-member-position">Cargo Empresa</div>
              </div>
            </div>
          </div>
        </div>
        <div class="our-team-container">
          <div class="our-team-group">
            <div class="team-member-container">
              <div class="team-member-image">
                <img class="image-fluid w-100" src="https://via.placeholder.com/250x200" alt />
              </div>
              <div class="team-member-info">
                <div class="team-member-name">Nombre Apellido</div>
                <div class="team-member-position">Cargo Empresa</div>
              </div>
            </div>
          </div>
        </div>
        <div class="our-team-container">
          <div class="our-team-group">
            <div class="team-member-container">
              <div class="team-member-image">
                <img class="image-fluid w-100" src="https://via.placeholder.com/250x200" alt />
              </div>
              <div class="team-member-info">
                <div class="team-member-name">Nombre Apellido</div>
                <div class="team-member-position">Cargo Empresa</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
