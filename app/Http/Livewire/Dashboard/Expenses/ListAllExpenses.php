<?php

namespace App\Http\Livewire\Dashboard\Expenses;

use Livewire\Component;
use App\Models\ExpensesCategory;
use App\Models\Expenses;
use Livewire\WithPagination;
use App\Jobs\DeleteImagesFromAWSJob;
use Carbon\Carbon;
use Excel;
use App\Exports\ExpensesExport;
class ListAllExpenses extends Component
{
    use WithPagination;
    public $rows = 10;
    public $search = '';
    public $start_date;
    public $end_date;
    public $category = 'all' ;
    protected $listeners = ['deleteItem'];



    public function deleteItem($item_id)
    {
        $expenses = Expenses::find($item_id);
        if ($expenses) {
            $image = 'expenses/'.$expenses->image;
            $expenses->delete();
            DeleteImagesFromAWSJob::dispatch($image);
        }
        $this->emit('itemDeleted');
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedRows()
    {
        $this->resetPage();
    }


    public function moun() {
        $this->category = 'all';
    }


    public function exportToExcel()
    {
        $expenses = Expenses::query()->with(['user' , 'category'])

        ->when($this->search , function($query){
            $query->where('name' , 'LIKE' , '%'.$this->search.'%' );
        })->when($this->category != 'all' , function($query){
            $query->where('expenses_category_id'  , $this->category );
        })->when($this->start_date , function($query){
            $query->whereDate('created_at' , '>=' , $this->start_date );
        })
        ->when($this->end_date , function($query){
            $query->whereDate('created_at' , '<=' , $this->end_date );
        });

        $expenses = $expenses->latest()->get();
        return Excel::download(new ExpensesExport($expenses), 'expenses.xlsx');
    }

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $expenses = Expenses::query()->with(['user' , 'category'])

        ->when($this->search , function($query){
            $query->where('name' , 'LIKE' , '%'.$this->search.'%' );
        })->when($this->category != 'all' , function($query){
            $query->where('expenses_category_id'  , $this->category );
        })->when($this->start_date , function($query){
            $query->whereDate('created_at' , '>=' , $this->start_date );
        })
        ->when($this->end_date , function($query){
            $query->whereDate('created_at' , '<=' , $this->end_date );
        });


        $expenses = $expenses->latest()->paginate($this->rows);

        $categories = ExpensesCategory::all();
        return view('livewire.dashboard.expenses.list-all-expenses' , compact('expenses' , 'categories'));
    }
}
