<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Image;
use Str;
use Storage;
use Log;
class ResizeImageAndUploadToAwsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $imagePath;
    public $sizes;
    public $mainFolder;
    public $model;
    public $itemId;
    public $imagePropertyName;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imagePath , $sizes , $mainFolder , $model , $itemId , $imagePropertyName )
    {
        $this->imagePath = $imagePath;
        $this->sizes = $sizes;
        $this->mainFolder = $mainFolder;
        $this->model = $model;
        $this->itemId = $itemId;
        $this->imagePropertyName = $imagePropertyName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->sizes as $size) {
            $fileNewName = Str::uuid()->toString();
            $extension = $request->file('image')->extension();
            $fileNewName = $fileNewName.'.'.$extension;
            Storage::disk('public')->copy($imagePath, 'countries/'.$fileNewName);
            $image = Image::make( Storage::disk('public')->get('countries/'.$fileNewName))->resize($size[0],$size[1])->stream();
            $path = Storage::disk('public')->put('countries/'.$fileNewName, $image);
        }
    }
}
