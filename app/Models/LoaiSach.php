<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoaiSach extends Model
{
	protected $table = 'loaisach';
	
	public function SanPham(): HasMany
	{
		return $this->hasMany(Sach::class, 'loaisach_id', 'id');
	}
}