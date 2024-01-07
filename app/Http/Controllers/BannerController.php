<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    // Hiển thị danh sách các banner
    public function getDanhSach()
    {
        $banners = Banner::orderBy('create at', 'desc')->get();
        return view('admin.banner.danhsach', compact('banner'));
    }

    // Hiển thị form để tạo banner mới
    public function getThem()
    {
        return view('admin.banner.them');
    }
    public function postThem(Request $request)
    {
        // Kiểm tra
        $request->validate([
            'banner' => ['required', 'string'],
            'link' => ['required', 'string'],
            'status' => ['required', 'boolean'],
        ]);
        $orm = new Banner();
        $orm->banner = $request->banner;
        $orm->link = $request->link;
        $orm->status = $request->status;
        $orm->save();
        // Sau khi thêm thành công thì tự động chuyển về trang danh sách
        return redirect()->route('admin.banner');
    }
    public function getSua($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.sua', compact('banner'));
    }

    public function postSua(Request $request, $id)
    {  
       // Kiểm tra
       $request->validate([
        'banner' => ['required', 'string'],
        'link' => ['required', 'string'],
        'status' => ['required', 'boolean'],
    ]);

        $orm = Banner::find($id);
        $orm->banner = $request->banner;
        $orm->link = $request->link;
        $orm->status = $request->status;
        $orm->save();

        // Sau khi sửa thành công thì tự động chuyển về trang danh sách
        return redirect()->route('admin.banner');
    }

    // Xóa một banner khỏi cơ sở dữ liệu
    public function getXoa($id)
    {
        $orm = Banner::find($id);
		$orm->delete();

        return redirect()->route('admin.banner');
    }
}
