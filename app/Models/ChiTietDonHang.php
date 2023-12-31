<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class _ChiTietDonHang extends Model
{
	protected $table = 'donhang_chitiet';

	protected $fillable = [
        'donhang_id', 'sach_id', 'soluong', 'thanhtien',
    ];
	
	public function DonHang(): BelongsTo
	{
		return $this->belongsTo(DonHang::class, 'donhang_id', 'id');
	}
	
	public function SanPham(): BelongsTo
	{
		return $this->belongsTo(Sach::class, 'sanpham_id', 'id');
	}
}