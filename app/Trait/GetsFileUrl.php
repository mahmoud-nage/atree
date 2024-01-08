<?php

namespace App\Trait;

use Illuminate\Support\Facades\Storage;

trait GetsFileUrl
{
    /**
     * Get file url
     *
     * @param string|null $path
     * @return string|null
     */
    public function makeFileUrl(?string $path): ?string
    {
        if (is_null($path)) {
            return null;
        }
        return asset('storage/'.$path);
    }

    public function makeReportFileUrl($path)
    {
        if (is_null($path)) {
            return null;
        }
        $full_path = Storage::disk($disk = config('filesystems.tenants_public'))->url($path);
        return   route('tenants.assets', ['path' => ltrim($path, '/'), 'tenant' => tenant()->id]);
    }
}
