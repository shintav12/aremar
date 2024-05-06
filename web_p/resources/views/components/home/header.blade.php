<div class="header-container-parent">
    <div class="p-0 px m-0 item w-100" style="position:relative;">
    <div class="header_image" style="width: 100%; height: auto;" alt>
      <img
        class="d-none d-sm-none d-md-none d-lg-block"
        style="width: 100%; height: auto;"
        src="{{config('app.IMAGE_URL').$vitrina->path}}"
      />
      <img
        class="d-none d-sm-none d-md-block d-lg-none"
        style="width: 100%; height: auto;"
        src="{{config('app.IMAGE_URL').$vitrina->path}}"
      />
      <img
        class="d-none d-sm-block d-md-none d-lg-none"
        style="width: 100%; height: auto;"
        src="{{config('app.IMAGE_URL').$vitrina->path}}"
      />
      <img
        class="d-block d-sm-none d-md-none d-lg-none"
        style="width: 100%; height: auto;"
        src="{{config('app.IMAGE_URL').$vitrina->path}}"
      />
    </div>
    <div class="content w-100" style="background-color: #0000006b;">
      <div class="container h-100">
        <div class style="height:100%">
          <div class="content_container h-100">
            <div class="title_container">
              <div class="centered-div">
                <h4 class="secondary_title my-2" style="font-weight: 500 !important;">{{$vitrina->subtitle}}</h4>
                <h1 class="primary_tile">{{$vitrina->title}}</h1>
                @if($vitrina->btn_text != '')
                <a class="btn btn-custom" target="_blank" href="{{$vitrina->btn_link}}">{{$vitrina->btn_text}}</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
