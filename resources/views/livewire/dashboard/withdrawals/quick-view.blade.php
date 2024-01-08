<div>
    <div id="quick_view" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> طلب السحب رقم :  {{ $withdrawal->number }} </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                   <table class="table table-bwithdrawaled table-hover">
                    <tbody>
                        <tr>
                            <th> @lang('categories.created_at') </th>
                            <td> {{ $withdrawal->created_at?->diffForHumans() }} -- {{ $withdrawal->created_at }} </td>
                        </tr>

                        <tr>
                            <th> رقم الطلب </th>
                            <td> {{ $withdrawal->number }} </td>
                        </tr>
                        <tr>
                            <th> المسوق  </th>
                            <td> {{ $withdrawal->user?->name }}  </td>
                        </tr>

                        <tr>
                            <th> طريقه لسخب  </th>
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
                        </tr>
                        <tr>
                            <th> حاله الطلب   </th>
                            <td> 
                                @switch($withdrawal->status)
                                @case(1)
                                <span class='badge badge-secondary' > قيد المراجعه </span>
                                @break
                                @case(2)
                                <span class='badge badge-warning' > قيد التنفيذ </span>
                                @break
                                @case(3)
                                <span class='badge badge-success' > تم الموافقه </span>
                                @break
                                @case(4)
                                <span class='badge badge-danger' > تم الرفض </span>
                                @break
                                @endswitch
                            </td>
                        </tr>
                        
                        <tr>
                            <th> المبلغ </th>
                            <td> {{ $withdrawal->amount }} <span class='text-muted' > جنيه </span> </td>
                        </tr>

                        @if ($withdrawal->payment_method == App\Models\Withdrawals::WALLET )
                        <tr>
                            <th> رقم المحفظه الالكترونيه </th>
                            <td> {{ $withdrawal->phone }} </td>
                        </tr>
                        @endif
                        @if ($withdrawal->payment_method == App\Models\Withdrawals::BANK_ACCOUNT )
                        <tr>
                            <th> البنك </th>
                            <td> {{ $withdrawal->bank_account?->bank_name }} </td>
                        </tr>
                        <tr>
                            <th> اسسم صاحب الحساب البنكى </th>
                            <td> {{ $withdrawal->bank_account?->name }} </td>
                        </tr>
                        <tr>
                            <th> رقم الحساب </th>
                            <td> {{ $withdrawal->bank_account?->account_number }} </td>
                        </tr>
                        <tr>
                            <th> رقم Iban </th>
                            <td> {{ $withdrawal->bank_account?->iban }} </td>
                        </tr>
                        @endif

                        <tr>
                            <th> ملحوظات  </th>
                            <td> {{ $withdrawal->system_notes }} </td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal"> اغلاق </button>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
<script>
    $(function() {

        Livewire.on('lanuchModal', () => {
            $('#quick_view').modal('show'); 
        })




    });
</script>
@endsection
