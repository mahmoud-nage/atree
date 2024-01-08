<?php

namespace App\Http\Livewire\Board\Products;

use Livewire\Component;
use App\Jobs\DeleteImagesFromAWSJob;
use App\Models\ProductImage;
class Images extends Component
{
    public $product;
    protected $listeners = ['deleteItem'];
 

    public function deleteItem($item_id)
    {
        $ProductImage = ProductImage::find($item_id);
        $image = 'products/'.$ProductImage->image;
        $ProductImage->delete();
        DeleteImagesFromAWSJob::dispatch($image);
        $this->emit('itemDeleted');
    }

    public function getImagesProperty()
    {
        return ProductImage::where('product_id' , $this->product->id )->get();
    }

    public function render()
    {
        return view('livewire.board.products.images');
    }
}
