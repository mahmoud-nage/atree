<div>
    <div class="row" dir='ltr' >
        <div class="col-md-2">
            <a data-toggle="modal" data-target="#modal_form_vertical" class="btn btn-primary "><i class="icon-plus3 mr-2 "></i> ارفاق ملف مدفوعات </a>
        </div>
        @if (count($selected))
        <div class="col-md-2">
            <select wire:model='newStatus' class='form-control ' id="">
                <option value='' > تعديل حاله الطلب </option>
                <option value="1">قيد المراجعه</option>
                <option value="2">قيد التحويل</option>
                <option value="3">تم التحويل</option>
                <option value="4">تم الرفض</option>
            </select>
        </div>
        @endif
    </div>
    <hr>

    <div class="card">
        <div class="card-header bg-primary text-white header-elements-sm-inline" >
            <h5 class="card-title"> عرض كافه طلبات سحب الارباح </h5>
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
                <div class="col-md-2">
                    <div class="form-group-feedback form-group-feedback-right">
                        <input type="search" wire:model='search' class="form-control wmin-sm-200" placeholder=" @lang('dashboard.search') ...">
                        <div class="form-control-feedback">
                            <i class="icon-search4 font-size-base text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 " >
                    <select wire:model='status' class="form-control form-control-select2" >
                        <option value="all"> جميع الحالات </option>
                        <option value="1">قيد المراجعه </option>
                        <option value="2"> جارى ارسال الارباح </option>
                        <option value="3">  تم التحويل </option>
                        <option value="4">  تم الرفض </option>

                    </select>
                </div>
                <div class="col-md-2 " >
                    <select wire:model='payment_method' class="form-control form-control-select2" >
                        <option value="all"> جميل طرق التحويل </option>
                        <option value="1"> محفظه الكترونه </option>
                        <option value="2"> حساب بنكى </option>
                    </select>
                </div>
                <div class="col-md-2 " >
                    <input type="date" wire:model='start_date' class="form-control" >
                </div>
                <div class="col-md-2 " >
                    <input type="date" wire:model='end_date' class="form-control">
                </div>
                <div class="col-md-1" >
                    <button wire:click='excelReport()' class='btn btn-sm btn-primary'> <i class='icon-file-excel ' ></i> تقرير </button>
                </div>
            </div>

        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> رقم الطلب </th>
                        <th> المسوق </th>
                        <th> طريقه السحب </th>
                        <th> قيمه الطلب </th>
                        <th> حاله الطلب </th>
                        <th> تاريخ الاستلام </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp


                    @foreach ($withdrawals as $withdrawal)
                    <tr>
                        <td> 
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" value='{{ $withdrawal->id }}' class="custom-control-input" wire:model='selected' id="cc_ls_c{{ $withdrawal->id }}" >
                                <label class="custom-control-label" for="cc_ls_c{{ $withdrawal->id }}"></label>
                            </div>
                        </td>
                        <td> {{ $withdrawal->number }} </td>
                        <td> {{ $withdrawal->user?->name }} </td>
                        <td>    
                            @switch($withdrawal->payment_method)
                            @case(1)
                            <span class='badge badge-primary' > محفظه الكترونيه </span>
                            @break
                            @case(2)
                            <span class='badge badge-success' > حساب بنكى </span>
                            @break
                            @endswitch
                            
                        </td>
                        <td> {{ $withdrawal->amount }} جنيه </td>
                        <td> 
                            @switch($withdrawal->status)
                            @case(1)
                            <span class='badge badge-secondary' > قيد المراجعه </span>
                            @break
                            @case(3)
                            <span class='badge badge-success' > تم التحويل </span>
                            @break
                            @case(2)
                            <span class='badge badge-warning' > جارى ارسال الارباح </span>
                            @break
                            @case(4)
                            <span class='badge badge-danger' > تم الرفض </span>
                            @break
                            @endswitch
                        </td>
                        <td> {{ $withdrawal->created_at->diffForHumans() }} </td>
                        <td>
                             <a class="btn btn-success btn-icon" wire:click="$emit('quick-view' , {{ $withdrawal->id }})" ><i class="icon-popout  "></i></a>
                            <a href='{{ route('dashboard.withdrawals.show' , ['withdrawal' => $withdrawal->id ] ) }}' class="btn btn-primary btn-icon"><i class="icon-eye "></i></a>
                            <a class="btn btn-danger btn-icon delete_item"  data-item_id='{{ $withdrawal->id }}' ><i class="icon-trash "></i></a>
                        </td>
                        
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white  py-sm-2">
            <div class='pagination pagination-flat justify-content-around mt-3 mt-sm-0 float-right' >
                {{ $withdrawals->links() }}
            </div>
        </div>

    </div>


    <div id="modal_form_vertical" wire:ignore.self class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> تعديل حاله المدفوعات </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form wire:submit.prevent='UploadFile()' >
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label> الملف </label>
                                    <input type="file" wire:model='file' class="form-control">
                                    @error('file')
                                    <p class='text-danger' > {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-group">
                                        <div class="alert alert-warning alert-styled-left alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                            ملحوظه هامه يجب ان يتم ترتيب اعمده الملف كالاتى
                                            <ul>
                                                <li> الخانه الاولى هيا رقم الطلب </li>
                                                <li> الخانه الثانيه هيا حاله الطب ....(1) فى حاله قيد المراجعه , (3) عند اتمام التحويل ... (2) عند جارى ارسال الارباح (4) عند اتمام الارسال بنجاح  </li>
                                                <li> الخانه الثالثه هيا طريقه الدفع حاليا يتم وضع 1 للمحفظه الاكتورنيه  </li>
                                                <li> اى ملحوظات اضافيه مثل سبب الرفض او الكود المرجعى للتحويل </li>
                                            </ul> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal"> اغلاق </button>
                        <button type="submit" class="btn btn-primary"> ارسال </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@livewire('dashboard.withdrawals.quick-view')
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
                title: '@lang('branches.branch_deleted')'
            })
        })

        Livewire.on('withdrawalsUpdated', postId => {
            $('#modal_form_vertical').modal('hide');
            Toast.fire({
                icon: 'success',
                title: 'تم تعديل حالات طلبات السحب بنجاح'
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
    });

</script>

@endsection