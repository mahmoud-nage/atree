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
            <th scope="col" class="text-right" width="200"> </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($items as $item)
          @livewire('site.cart-item' , ['item' => $item ] ,  $item->id )
          @endforeach
        </tbody>
      </table>

      <div class="card-body border-top">
{{--          {{ route('checkout.index') }}--}}
        <a href="{{ route('checkout') }}" class="btn btn-primary float-md-right"> اتمام الطلب <i class="fa fa-chevron-left"></i> </a>
        <a href="{{ url('/') }}" class="btn btn-light"> <i class="fa fa-chevron-right"></i> اكمل التسوق </a>
      </div>
    </div> <!-- card.// -->


  </main> <!-- col.// -->
  <aside class="col-md-3">
    <div class="card mb-3">
      <div class="card-body">
        <form>
          <div class="form-group">
            <label> هل تمتلك كود خصم </label>
            <div class="input-group">
              <input type="text" class="form-control" wire:model='coupon' placeholder="كود الخصم">
              <span class="input-group-append">
                <button class="btn btn-primary" wire:click='chackCoupon()' > تفعيل </button>
              </span>
            </div>
          </div>
        </form>
      </div> <!-- card-body.// -->
    </div>  <!-- card .// -->
    <div class="card">
      <div class="card-body">
        <dl class="dlist-align">
          <dt style="width:143px !important;" > السعر الكلى للمنتجات </dt>
          <dd class="text-right">{{ $this->total }} <span class='text-muted'> جنيه</span> </dd>
        </dl>

        <dl class="dlist-align">
          <dt style="width:143px !important;" >صافى الربح </dt>
          <dd class="text-right">{{ $this->marketer_bounse }} <span class='text-muted'> جنيه</span> </dd>
        </dl>

        <dl class="dlist-align">
          <dt style="width:143px !important;" >الشحن:</dt>
          <dd class="text-right text-muted"> لم يتم حسابه بعد </dd>
        </dl>
        <dl class="dlist-align">
          <dt style="width:143px !important;" >الخصم:</dt>
          <dd class="text-right text-muted"> 0  </dd>
        </dl>

        <dl class="dlist-align">
          <dt style="width:143px !important;" > المستحق للدفع :</dt>
          <dd class="text-right h5"><strong>{{ $this->total }} </strong> <span class='text-muted'> جنيه </span> </dd>
        </dl>
        <hr>


      </div> <!-- card-body.// -->
    </div>  <!-- card .// -->
  </aside> <!-- col.// -->
</div>
