<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TacGia extends Model
{
    protected $table = 'tacgia';

    public function Sach(): HasMany
    {
        return $this->hasMany(Sach::class, 'tacgia_id', 'id');
    }
}
