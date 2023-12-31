<?php

namespace App\Http\Controllers;

use App\Models\LoaiSach;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoaiSachController extends Controller
{
	public function getDanhSach()
	{
		$loaisach = LoaiSach::all();
		return view('admin.loaisach.danhsach', compact('loaisach'));
	}
	
	public function getThem()
	{
		return view('admin.loaisach.them');
	}
	
	public function postThem(Request $request)
	{
		// Kiểm tra
		$request->validate([
			'tenloai' => ['required', 'string', 'max:191', 'unique:loaisach'],
		]);
		
		$orm = new LoaiSach();
		$orm->tenloai = $request->tenloai;
		$orm->tenloai_slug = Str::slug($request->tenloai, '-');
		$orm->save();
		
		// Sau khi thêm thành công thì tự động chuyển về trang danh sách
		return redirect()->route('admin.loaisach');
	}
	
	public function getSua($id)
	{
		$loaisach = LoaiSach::find($id);
		return view('admin.loaisach.sua', compact('loaisach'));
	}
	
	public function postSua(Request $request, $id)
	{
		// Kiểm tra
		$request->validate([
			'tenloai' => ['required', 'string', 'max:191', 'unique:loaisach,tenloai,' . $id],
		]);
		
		$orm = LoaiSach::find($id);
		$orm->tenloai = $request->tenloai;
		$orm->tenloai_slug = Str::slug($request->tenloai, '-');
		$orm->save();
		
		// Sau khi sửa thành công thì tự động chuyển về trang danh sách
		return redirect()->route('admin.loaisach');
	}
	
	public function getXoa($id)
	{
		$orm = LoaiSach::find($id);
		$orm->delete();
		
		// Sau khi xóa thành công thì tự động chuyển về trang danh sách
		return redirect()->route('admin.loaisach');
	}
}