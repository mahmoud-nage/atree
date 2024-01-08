<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Slide extends Model
{
    use HasFactory;




    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function add($data)
    {
        $this->is_active = isset($data['is_active']) ? 1 : 0;
        $this->user_id = Auth::id();
        $this->link = $data['link'];
        return $this->save();
    }
    public function edit($data)
    {
        $this->link = $data['link'];
        $this->is_active = isset($data['is_active']) ? 1 : 0;
        return $this->save();
    }

}
