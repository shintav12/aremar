<form id="form" class="cardt-content">
<div class="header-container-parent">
    <div class="w-100 mt-5" style="position:relative;">
       <div class="header_image" style="width: 100%; height: auto;" alt>
       <img class="d-none d-sm-none d-md-none d-lg-block" style="width: 100%; height: auto;" src="{{url('img/home/newsletter.jpg')}}" />
         <img class="d-none d-sm-none d-md-block d-lg-none" style="width: 100%; height: auto;" src="https://via.placeholder.com/623x312">
         <img class="d-none d-sm-block d-md-none d-lg-none" style="width: 100%; height: auto;" src="https://via.placeholder.com/376">
         <img class="d-block d-sm-none d-md-none d-lg-none" style="width: 100%; height: auto;" src="https://via.placeholder.com/425">
       </div>
       <div class="content w-100" style="background-color: #0000006b;">
        <div class style="height:100%">
          <div class="content_container h-100">
            <div class="title_container">
              <div class="centered-div-newsletter">
                  <div class="cardt">
                      <div class="cardt-title">
                          Suscribete a nuestro Newsletter
                      </div>
                      <div class="cardt-subtitle">
                          Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed di
                      </div>
                      <div class="cardt-content">
                            {{ csrf_field() }}
                            <input name="email" class="form-control mx-md-2 in" placeholder="Escribe tu correo">
                            <button type="submit" class="btn btn-primary mx-md-2">Suscribirse</button>

                      </div>
                      <div class="cardt-footer">
                          Lorem ipsum dolor sit amet, consectetuer adipiscing
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
</form>
