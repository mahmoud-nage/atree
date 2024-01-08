<div>
    <div class="card">
        <div class="card-header bg-primary text-white header-elements-sm-inline" >
            <h5 class="card-title"> عرض كافه الاقتراحات و الشكاوى </h5>
            <div class="header-elements">
                <div class="d-flex justify-content-between">
                    <div class="list-icons ml-3">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-1" wire:ignore>
                    <select name="select" wire:model='rows' class="form-control form-control-select2" >
                        <option value="10"> @lang('dashboard.rows') </option>
                        <option value="20">20 </option>
                        <option value="30">30 </option>
                        <option value="50">50 </option>
                        <option value="100">100 </option>
                    </select>
                </div>
                <div class="col-md-3" wire:ignore>
                    <select  wire:model='type' class="form-control form-control-select2" >
                        <option value="all"> الجميع </option>
                        <option value="شكوى"> شكوى </option>
                        <option value="مقترح"> مقترح </option>
                    </select>
                </div>
                <div class="col-md-3" wire:ignore>
                    <select  wire:model='seen' class="form-control form-control-select2" >
                        <option value="all"> الجميع </option>
                        <option value="0"> الجديد </option>
                        <option value="1"> تم المشاهده </option>
                    </select>
                </div>
                <div class="col-md-3" wire:ignore>
                    <select  wire:model='category' class="form-control form-control-select2" >
                        <option value="all"> الجميع </option>
                        <option value="مستوى الخدمة"> مستوى الخدمة </option>
                        <option value="مستوى خدمة الشحن"> مستوى خدمة الشحن </option>
                        <option value="المنتجات">المنتجات  </option>
                        <option value="خدمات و امكانيات الموق"> خدمات و امكانيات الموق </option>
                        <option value="خدمة العملاء"> خدمة العملاء </option>
                        <option value="صفحة المحفظة"> صفحة المحفظة </option>
                        <option value="صفحة الطلبات"> صفحة الطلبات </option>
                        <option value="خدمة اللايف شات"> خدمة اللايف شات </option>
                        <option value="اخرى"> اخرى </option>
                    </select>
                </div>

            </div>

        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> النوع </th>
                        <th> التصنيف </th>
                        <th> هل تم المشاهه ؟ </th>
                        <th> وقت الاستلام </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp


                    @foreach ($complains as $complain)
                    <tr>
                        <td> {{ $i++ }} </td>
                        <td> {{ $complain->type }} </td>
                        <td> {{ $complain->category }} </td>
                        <td>
                            @switch($complain->seen)
                            @case(1)
                            <span  class='badge badge-success'> تم المشاهده </span>
                            @break
                            @case(0)
                            <span  class='badge badge-danger'> جديد </span>
                            @break
                            @endswitch
                        </td>
                        <td> {{ $complain->created_at->diffForHumans() }} </td>
                        <td>
                            <a href='{{ route('dashboard.complains.show' , ['complain' => $complain->id ] ) }}' class="btn btn-primary btn-icon"><i class="icon-eye "></i></a>

                            <a class="btn btn-danger btn-icon delete_item"  data-item_id='{{ $complain->id }}' ><i class="icon-trash "></i></a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white  py-sm-2">
            <div class='pagination pagination-flat justify-content-around mt-3 mt-sm-0 float-right' >
                {{ $complains->links() }}
            </div>
        </div>

    </div>
</div>


@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {

        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

        Livewire.on('itemDeleted', postId => {
            Toast.fire({
                icon: 'success',
                title: '@lang('categories.category_deleted')'
            })
        })



        $(document).on('click', 'a.delete_item', function(event) {
            event.preventDefault();
            var id = $(this).attr('data-item_id');
            Swal.fire({
                title: '@lang('dashboard.are_you_sure_to_delete')',
                text: "@lang('dashboard.delete_notice')",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '@lang('dashboard.yes')',
                cancelButtonText: '@lang('dashboard.cancel')'
            }).then((result) => {
                if (result.isConfirmed) {
                 Livewire.emit('deleteItem' , id )
             }
         })
        });
        // $('.form-control-select2').select2();
        $('.form-control-select2').on('change', function (e) {
            var data = $('.form-control-select2').select2("val");
            @this.set('form-control-select2', data);
        });
    });

</script>

@endsection