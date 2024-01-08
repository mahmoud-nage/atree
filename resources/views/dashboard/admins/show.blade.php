@extends('dashboard.layouts.master')

@section('page_title')
    {{ trans('admins.show_admin_details') }}
@endsection

@section('page_header')
    <a href="{{ route('dashboard.admins.index') }}" class="breadcrumb-item"><i
            class="icon-users4  mr-2"></i> @lang('admins.admins')</a>
    <span class="breadcrumb-item active"> @lang('admins.show_admin_details') </span>

@endsection
@section('page_content')

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white header-elements-sm-inline">
                        <h5 class="card-title"> @lang('admins.show_admin_details') </h5>
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
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th> @lang('admins.created') </th>
                                <td> {{ $admin->created_at->diffForHumans() }} </td>
                            </tr>
                            <tr>
                                <th> @lang('admins.status') </th>
                                <td>
                                    @switch($admin->active)
                                        @case(1)
                                            <span class='badge badge-success'> @lang('admins.active') </span>
                                            @break
                                        @case(0)
                                            <span class='badge badge-danger'> @lang('admins.inactive') </span>
                                            @break
                                    @endswitch
                                </td>
                            </tr>
                            <tr>
                                <th> @lang('admins.name') </th>
                                <td> {{ $admin->name }} </td>
                            </tr>
                            <tr>
                                <th> @lang('admins.email') </th>
                                <td> {{ $admin->email }} </td>
                            </tr>
                            @if($admin->user_id)
                                <tr>
                                    <th> @lang('admins.added_by') </th>
                                    <td>
                                        <a href="{{ route('dashboard.admins.show' ,  $admin->user_id) }}"> {{ $admin->admin->name ?? '' }} </a>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th> @lang('admins.image') </th>
                                <td><img src="{{ Storage::url('admins/'.$admin->image) }}" alt=""></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection


