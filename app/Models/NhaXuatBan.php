<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NhaXuatBan extends Model
{
	protected $table = 'nhaxuatban';

	protected $fillable = [
		'tennxb',
		'tennxb_slug',
		'hinhanh',
	];

	
	public function SanPham(): HasMany
	{
		return $this->hasMany(Sach::class, 'nhaxuatban_id', 'id');
	}
}