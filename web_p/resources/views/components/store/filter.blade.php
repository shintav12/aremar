<div>
    <form id="filters">
        {{ csrf_field() }}
        <input type="text" name="section_slug" hidden value="{{$slug}}">
        <input type="text" id="order_id_input" name="order_id" hidden value="1">
        <div class="filter-section-container">
            <div class="filter-section">
              <div class="filter-title">Categorias</div>
              <div class="filter-content">
                <div class="input-container">
                  <input class="radio-filter" value="0" checked  name="category" type="radio" />
                  <label>Todas</label>
                </div>
                @foreach ($categories as $item)
                <div class="input-container">
                    <input class="radio-filter " value="{{$item->id}}" name="category" type="radio" />
                    <label>{{$item->name}}</label>
                </div>
                @endforeach
              </div>
            </div>
            <hr />
            <div class="filter-section">
              <div class="filter-title">Metal</div>
              <div class="filter-content">
                  <div class="input-container">
                      <input class="radio-filter" checked name="metals" value="0" type="radio" />
                      <label>Todos</label>
                  </div>
                @foreach ($metals as $item)
                <div class="input-container">
                  <input class="radio-filter" name="metals"  value="{{$item->id}}" type="radio" />
                  <label>{{$item->name}}</label>
                </div>
                @endforeach
              </div>
            </div>
            <hr />
            <div class="filter-section">
              <div class="filter-title">Colecci&oacute;n</div>
              <div class="filter-content">
                  <div class="input-container">
                      <input class="radio-filter"  checked name="collection" value="0" type="radio" />
                      <label>Todas</label>
                  </div>
                @foreach ($collections as $item)
                <div class="input-container">
                <input class="radio-filter"  name="collection" value="{{$item->id}}" type="radio" />
                  <label>{{$item->name}}</label>
                </div>
                @endforeach
              </div>
            </div>
            <div class="filter-action">
              <button type="submit" class="btn btn-custom">Buscar</button>
            </div>
          </div>
    </form>
</div>
