<div>

    <div class="card mx-auto">
      <article class="card-body">
        <header class="mb-4"><h4 class="card-title"> البحث داخل الطلبات </h4></header>
        <form>
            <div class="form-row">
                <div class="col form-group">
                    <label> بحث </label>
                    <input type="text" class="form-control" placeholder="قم بالحق عن طلب عن طريق رقم الموبيل ..رقم الطلب">
                </div>
            </div> 
            <div class="form-row">

                <div class="form-group col-md-3">
                    <label>  محافظه </label>
                    <select id="inputState" wire:model='governorate_id' class="form-control">
                        <option> </option>
                        @foreach ($this->governorates as $governorate)
                        <option value="{{ $governorate->id }}"> {{ $governorate->name }} </option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group col-md-3">
                    <label> مدنيه </label>
                    <select id="inputState" wire:model='city_id' class="form-control">
                        <option> </option>
                        @foreach ($this->cities as $city)
                        <option value="{{ $city->id }}"> {{ $city->name }} </option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group col-md-3">
                    <label> حاله الطلب </label>
                   <select wire:model='status' class="form-control form-control-select2" >
                    <option value=""> جميع الحالات </option>
                    @foreach ($shipping_statues as $shipping_status)
                    <option value="{{ $shipping_status->id }}"> {{ $shipping_status->name }} </option>
                    @endforeach
                </select>
                </div> 
            </div> 
            <div class="form-group">
                {{-- <button type="submit" class="btn btn-primary btn-block"> Register  </button> --}}
            </div>           
        </form>
    </article><!-- card-body.// -->
</div> <!-- card .// -->


<br>
<hr>


@foreach ($orders as $order)
<article class="card mb-4">
    <header class="card-header">
        @switch($order->shipping_statues_id)
        @case(1)
        @case(2)
        @case(3)
        @case(4)
        <a href='#' wire:click="cancelOrder({{ $order->id }})" class="btn btn-outline-danger float-right"> <i class="fa fa-trash"></i> الغاء الطلب </a>
        @break
        @case(5)
        <a href='{{ route('site.orders.returns.create' , $order ) }}'  class="btn btn-outline-danger float-right"> <i class="fa fa-back"></i> ارجاع الطلب </a>
        @break
        @endswitch
        <strong class="d-inline-block mr-3"> رقم الطلب : {{ $order->number }} </strong>
        <span>تاريخ الطلب : {{ $order->created_at->toDateString() }} </span> <br>
        <span class='d-inline-block mr-3 text-success'> {{ $order->status?->name }} </span>
    </header>
    <div class="card-body">
        <div class="row"> 
            <div class="col-md-8">
                <h6 class="text-muted"> التوصيل الى  </h6>
                <p> {{ $order->governorate?->name }} <br>  
                    {{ $order->city?->name }} <br> 
                    رقم الموبيل : {{ $order->order_phone }} <br>
                    {{ $order->address }}
                </p>
            </div>
            <div class="col-md-4">
                <h6 class="text-muted">طريقه الدفع</h6>
                <span class="text-success">
                    كاش عند الاستلام
                </span>
                <p>
                    المبلغ : {{ $order->total }} جنيه<br>
                    قيمه الشحن:  {{ $order->shipping_cost }} جنيه<br> 
                    <span class="b"> المبلغ الكلى :  {{ $order->total + $order->shipping_cost }} جنيه</span> <br>
                    <span class="b text-danger"> ارباحى من الطلب :  {{ $order->marketer_price() }} جنيه</span>
                </p>
            </div>
        </div> <!-- row.// -->
    </div> <!-- card-body .// -->
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                @foreach ($order->items as $item)
                <tr>
                    <td>
                        <img src="{{ Storage::url('products/'.$item->variation?->product?->image) }}" class="img-xs border">
                    </td>
                    <td> 
                        جنيه  {{ $item->price }}
                    </td>
                    <td>
                        <a href="#" class="title text-dark">{{ $item->variation?->product?->name }}</a>
                        @if ($item->variation->type != 'default' )
                        <p class="text-muted small"> @lang('site.'.$item->variation->type): {{ $item->variation->title }} , 
                            @if ($item->variation?->parent_id)
                            @lang('site.'.$item->variation?->parent?->type) : {{ $item->variation?->parent?->title }}
                            @endif
                            <br>
                        </p>
                        @endif
                    </td>
                    <td> {{ $item->quantity }} قطعه </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div> 
</article> 
@endforeach

<nav class="mb-4" aria-label="Page navigation sample">
    {{ $orders->links() }}
</nav>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> طلب ارجاع  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

      <div class="form-group">
        <label for="recipient-name" class="col-form-label">سبب الارجاع:</label>
        <select wire:model='return_reason' class='form-control' id="">
            <option value="المنتج به عيوب">المنتج به عيوب</option>
            <option value="المنتج تالف">المنتج تالف</option>
            <option value="المنتج غير مطابق للمواصفات">المنتج غير مطابق للمواصفات</option>
        </select>
    </div>
    <div class="form-group">
        <label for="message-text" class="col-form-label"> تعليق إضافى :</label>
        <textarea class="form-control"  wire:model='description' id="message-text"></textarea>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"> اغلاق </button>
    <button type="button" class="btn btn-primary" wire:click='saveReturnOrder({{ $order->id }})' > تقديم الطلب </button>
</div>
</div>
</div>
</div>

@section('scripts')

<script>
    jQuery(document).ready(function($) {
        Livewire.on('showReturnOrderModal', order_id => {
            $('#exampleModal').modal('show');
        })
    });
</script>
@endsection