   <div class="row">
    <main class="col-md-9">
      <div class="card">
        <table class="table table-borderless table-shopping-cart">
          <thead class="text-muted">
            <tr class="small text-uppercase">
              <th scope="col">المنتج</th>
              <th scope="col" width="150">السعر المنتج الاصلى </th>
              <th scope="col" width="150">سعر البيع للعميل</th>
              <th scope="col" width="120">الكميه</th>
              <th scope="col" width="120">ربحك</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
            <tr>
              <td>
                <figure class="itemside">
                  <div class="aside">
                    <a href="{{ $item->variation?->product?->url() }}"> <img src="{{ Storage::url('products/'.$item->variation?->product?->image) }}" class="img-sm"> </a>
                  </div>
                  <figcaption class="info">
                    <a href="{{ $item->variation?->product?->url() }}" class="title text-dark">{{ $item->variation?->product?->name }}</a>
                    @if ($item->variation->type != 'default' )
                    <p class="text-muted small"> @lang('site.'.$item->variation->type): {{ $item->variation->title }} , 
                      @if ($item->variation?->parent_id)
                      @lang('site.'.$item->variation?->parent?->type) : {{ $item->variation?->parent?->title }}
                      @endif
                      <br>
                    </p>
                    @endif
                  </figcaption>
                </figure>
              </td>
              <td>
                {{ $item->variation?->product?->getPrice() }} <span class="text-muted"> جنيه </span>
              </td>
              <td> 
                <div class="price-wrap"> 
                  {{ $item->price }} <span class="text-muted"> جنيه </span>
                </div> 
              </td>
              <td> 
               {{ $item->quantity }} <span class="text-muted"> قطعه </span>
              </td>

              <td> 
                <div class="price-wrap"> 
                 {{ ( $item->variation?->product->marketer_price * $item->quantity ) + ( ($item->price - $item->variation?->product->getPrice())) * $item->quantity }} <span class="text-muted"> جنيه </span>
               </div> 
             </td>

           </tr>
           @endforeach
         </tbody>
       </table>

     </div> 



   </main> 
   <aside class="col-md-3">

    <div class="card">
      <div class="card-body">
        <dl class="dlist-align">
          <dt style="width:143px !important;"> المجموع الفرعى </dt>
          <dd class="text-right">{{ $this->sub_total }}  <span class="text-muted"> جنيه </span> </dd>
        </dl>
        <dl class="dlist-align">
          <dt style="width:143px !important;">سعر الشحن:</dt>
          <dd class="text-right">
            @if (!$this->shipping_price)
              <span class="text-muted"> لم يتم حسابه بعد </span>
            @else
             {{ $this->shipping_price }}  <span class="text-muted"> جنيه </span>
            @endif
          </dd>
        </dl>
        <dl class="dlist-align">
          <dt style="width:143px !important;">المبلغ الكلى :</dt>
          <dd class="text-right  h5"><strong>{{ $this->total }} </strong> <span class="text-muted"> جنيه </span> </dd>
        </dl>

        <dl class="dlist-align">
          <dt style="width:143px !important;"> صافى الربح  :</dt>
          <dd class="text-right  h5"><strong>{{ $this->marketer_bounse }} </strong> <span class="text-muted"> جنيه </span> </dd>
        </dl>
        <hr>
        <form action="{{ route('checkout.save') }}" method="POST" >
          @csrf
          <div class="col-md-12">
           <div class="form-row">
            <div class="form-group col-md-12">
              <label> المحافظه </label>
              <select id="inputState" wire:model='governorate_id' name="governorate_id" class="form-control">
                <option value=""></option>
                @foreach ($this->governorates as $governorate)
                <option value="{{ $governorate->id }}"> {{ $governorate->name }} </option>
                @endforeach
              </select>
              @error('governorate_id')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> <!-- form-group end.// -->

            <div class="form-group col-md-12">
              <label> المدينه </label>
              <select id="inputState" wire:model='city_id' name="city" class="form-control">
                <option value=""></option>
                @foreach ($this->cities as $city)
                <option value="{{ $city->id }}"> {{ $city->name }} </option>
                @endforeach
              </select>
              @error('city')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> <!-- form-group end.// -->

          </div> <!-- form-row.// -->

          <div class="form-row">
            <div class=" form-group col-md-12">
              <label> العنوان بالتفصيل </label>
              <input type="text" class="form-control" name="address" value=" ">
              @error('address')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> <!-- form-group end.// -->

          </div> <!-- form-row.// -->


          <div class="form-row">
            <div class="form-group col-md-12">
              <label>اسم العميل </label>
              <input type="text" class="form-control" name='client_name' value="">
              @error('client_name')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> <!-- form-group end.// -->
          </div> <!-- form-row.// -->


          <div class="form-row">
            <div class="form-group col-md-12">
              <label> رقم موبيل العميل </label>
              <input type="text" class="form-control" name='phone' value="">
              @error('phone')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> 
          </div> 

          <button class="btn btn-primary btn-block">اتمام الطلب</button> 
          <br>
        </div>
      </form>


    </div> <!-- card-body.// -->
  </div>  <!-- card .// -->
</aside> <!-- col.// -->
</div>
