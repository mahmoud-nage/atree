@extends('dashboard.layouts.master')

@section('page_title')
تعديل المصروفات
@endsection

@section('page_header')
<a href="{{ route('dashboard.expenses.index') }}" class="breadcrumb-item"><i class="icon-cash3  mr-2"></i> 
المصروفات
</a>
<span class="breadcrumb-item active"> تعديل المصروفات </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> تعديل المصروفات  </h5>
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
			<form action="{{ route('dashboard.expenses.update' , ['expense' => $expense->id ] ) }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				@method('PATCH')
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">بيانات المصروفات</legend>
						<div class="form-group row">
							
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> التصنيف </label>
									<select name="category_id" class='form-control' id="">
										@foreach ($categories as $category)
											<option value="{{ $category->id }}" {{ $expense->expenses_category_id == $category->id ? 'selected="selected"' : '' }} >{{ $category->name }}</option>
										@endforeach
									</select>
									@error('category_id')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> العنوان </label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $expense->name }}" >
									@error('name')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> الصوره </label>
									<input type="file" class="form-control @error('image') is-invalid @enderror" name="image"  >
									@error('image')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> التفاصيل </label>
									<input type="text" class="form-control @error('details') is-invalid @enderror" name="details" value="{{ $expense->details }}" >
									@error('details')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> المبلغ </label>
									<input type="text" class="form-control @error('money') is-invalid @enderror" name="money" value="{{ $expense->money }}" >
									@error('money')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> الصوره الحاليه </label> <br>
									<img class='img-thumbnail img-responsive' src="{{ Storage::url('expenses/'.$expense->image) }}" alt="">
								</div>
							</div>
							
							

						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.bank_accounts.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection