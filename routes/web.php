<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoaiSachController;
use App\Http\Controllers\NhaXuatBanController;
use App\Http\Controllers\SachController;
use App\Http\Controllers\TinhTrangController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\ChuDeController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BinhLuanBaiVietController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\AdminController;


Auth::routes();

// Google OAuth
Route::get('/login/google', [HomeController::class, 'getGoogleLogin'])->name('google.login');
Route::get('/login/google/callback', [HomeController::class, 'getGoogleCallback'])->name('google.callback');



// Các trang dành cho khách chưa đăng nhập
Route::name('frontend.')->group(function() {
 // Trang chủ
	Route::get('/', [HomeController::class, 'getHome'])->name('home');
	Route::get('/home', [HomeController::class, 'getHome'])->name('home');

 // Trang sản phẩm
	Route::get('/san-pham', [HomeController::class, 'getSanPham'])->name('sach');
	Route::get('/san-pham/{tenloai_slug}', [HomeController::class, 'getSanPham'])->name('sach.phanloai');
	Route::get('/san-pham/{tenloai_slug}/{tensanpham_slug}', [HomeController::class, 'getSanPham_ChiTiet'])->name('sach.chitiet');

 // Tin tức
	Route::get('/bai-viet', [HomeController::class, 'getBaiViet'])->name('baiviet');
	Route::get('/bai-viet/{tenchude_slug}', [HomeController::class, 'getBaiViet'])->name('baiviet.chude');
	Route::get('/bai-viet/{tenchude_slug}/{tieude_slug}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('baiviet.chitiet');

 // Trang giỏ hàng
	Route::get('/gio-hang', [HomeController::class, 'getGioHang'])->name('giohang');
	Route::get('/gio-hang/them/{tensanpham_slug}', [HomeController::class, 'getGioHang_Them'])->name('giohang.them');
	Route::get('/gio-hang/xoa/{row_id}', [HomeController::class, 'getGioHang_Xoa'])->name('giohang.xoa');
	Route::get('/gio-hang/giam/{row_id}', [HomeController::class, 'getGioHang_Giam'])->name('giohang.giam');
	Route::get('/gio-hang/tang/{row_id}', [HomeController::class, 'getGioHang_Tang'])->name('giohang.tang');
	Route::post('/gio-hang/cap-nhat', [HomeController::class, 'postGioHang_CapNhat'])->name('giohang.capnhat');

 // Tuyển dụng
	Route::get('/tuyen-dung', [HomeController::class, 'getTuyenDung'])->name('tuyendung');

 // Liên hệ
	Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('lienhe');
});


// Trang khách hàng
Route::get('/khach-hang/dang-ky', [HomeController::class, 'getDangKy'])->name('NguoiDung.dangky');
Route::get('/khach-hang/dang-nhap', [HomeController::class, 'getDangNhap'])->name('user.dangnhap');

// Trang tài khoản khách hàng
Route::prefix('khach-hang')->name('user.')->middleware(['auth'], ['user'])->group(function() {
 // Trang chủ
	Route::get('/', [KhachHangController::class, 'getHome'])->name('home');
	Route::get('/home', [KhachHangController::class, 'getHome'])->name('home');

 // Đặt hàng
	Route::get('/dat-hang', [KhachHangController::class, 'getDatHang'])->name('dathang');
	Route::post('/dat-hang', [KhachHangController::class, 'postDatHang'])->name('dathang');
	Route::get('/dat-hang-thanh-cong', [KhachHangController::class, 'getDatHangThanhCong'])->name('dathangthanhcong');

 // Xem và cập nhật trạng thái đơn hàng
	Route::get('/don-hang', [KhachHangController::class, 'getDonHang'])->name('donhang');
	Route::get('/don-hang/{id}', [KhachHangController::class, 'getDonHang'])->name('donhang.chitiet');
	Route::post('/don-hang/{id}', [KhachHangController::class, 'postDonHang'])->name('donhang.chitiet');

 // Cập nhật thông tin tài khoản
	Route::get('/ho-so-ca-nhan', [KhachHangController::class, 'getHoSoCaNhan'])->name('hosocanhan');
	Route::post('/ho-so-ca-nhan', [KhachHangController::class, 'postHoSoCaNhan'])->name('hosocanhan');

 // Đăng xuất
	Route::post('/dang-xuat', [KhachHangController::class, 'postDangXuat'])->name('dangxuat');
});


// Trang chủ
Route::prefix('admin')->name('admin.')->middleware(['auth'], ['manager'])->group(function() {
	Route::get('/', [HomeController::class, 'getHome'])->name('home');
	Route::get('/home', [HomeController::class, 'getHome'])->name('home');

// Liên kết gởi email khi đặt hàng thành công
	Route::get('/dathangthanhcong', [HomeController::class, 'getDatHangThanhCong'])->name('frontend.dathangthanhcong');

// Quản lý Loại sản phẩm
	Route::get('/loaisach', [LoaiSachController::class, 'getDanhSach'])->name('loaisach');
	Route::get('/loaisach/them', [LoaiSachController::class, 'getThem'])->name('loaisach.them');
	Route::post('/loaisach/them', [LoaiSachController::class, 'postThem'])->name('loaisach.them');
	Route::get('/loaisach/sua/{id}', [LoaiSachController::class, 'getSua'])->name('loaisach.sua');
	Route::post('/loaisach/sua/{id}', [LoaiSachController::class, 'postSua'])->name('loaisach.sua');
	Route::get('/loaisach/xoa/{id}', [LoaiSachController::class, 'getXoa'])->name('loaisach.xoa');

// Quản lý Hãng sản xuất
	Route::get('/hangsanxuat', [NhaXuatBanController::class, 'getDanhSach'])->name('nhaxuatban');
	Route::get('/hangsanxuat/them', [NhaXuatBanController::class, 'getThem'])->name('nhaxuatban.them');
	Route::post('/hangsanxuat/them', [NhaXuatBanController::class, 'postThem'])->name('nhaxuatban.them');
	Route::get('/hangsanxuat/sua/{id}', [NhaXuatBanController::class, 'getSua'])->name('nhaxuatban.sua');
	Route::post('/hangsanxuat/sua/{id}', [NhaXuatBanController::class, 'postSua'])->name('nhaxuatban.sua');
	Route::get('/hangsanxuat/xoa/{id}', [NhaXuatBanController::class, 'getXoa'])->name('nhaxuatban.xoa');
	Route::post('/hangsanxuat/nhap', [NhaXuatBanController::class, 'postNhap'])->name('nhaxuatban.nhap');
	Route::get('/hangsanxuat/xuat', [NhaXuatBanController::class, 'getXuat'])->name('nhaxuatban.xuat');

// Quản lý Sản phẩm
	Route::get('/sanpham', [SachController::class, 'getDanhSach'])->name('sach');
	Route::get('/sanpham/them', [SachController::class, 'getThem'])->name('sach.them');
	Route::post('/sanpham/them', [SachController::class, 'postThem'])->name('sach.them');
	Route::get('/sanpham/sua/{id}', [SachController::class, 'getSua'])->name('sach.sua');
	Route::post('/sanpham/sua/{id}', [SachController::class, 'postSua'])->name('sach.sua');
	Route::get('/sanpham/xoa/{id}', [SachController::class, 'getXoa'])->name('sach.xoa');
	Route::post('/sanpham/nhap', [SachController::class, 'postNhap'])->name('sach.nhap');
	Route::get('/sanpham/xuat', [SachController::class, 'getXuat'])->name('sach.xuat');

// Quản lý Tình trạng
	Route::get('/tinhtrang', [TinhTrangController::class, 'getDanhSach'])->name('tinhtrang');
	Route::get('/tinhtrang/them', [TinhTrangController::class, 'getThem'])->name('tinhtrang.them');
	Route::post('/tinhtrang/them', [TinhTrangController::class, 'postThem'])->name('tinhtrang.them');
	Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'getSua'])->name('tinhtrang.sua');
	Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'postSua'])->name('tinhtrang.sua');
	Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'getXoa'])->name('tinhtrang.xoa');

// Quản lý Đơn hàng
	Route::get('/donhang', [DonHangController::class, 'getDanhSach'])->name('donhang');
	Route::get('/donhang/them', [DonHangController::class, 'getThem'])->name('donhang.them');
	Route::post('/donhang/them', [DonHangController::class, 'postThem'])->name('donhang.them');
	Route::get('/donhang/sua/{id}', [DonHangController::class, 'getSua'])->name('donhang.sua');
	Route::post('/donhang/sua/{id}', [DonHangController::class, 'postSua'])->name('donhang.sua');
	Route::get('/donhang/xoa/{id}', [DonHangController::class, 'getXoa'])->name('donhang.xoa');

// Quản lý Tài khoản người dùng
	Route::get('/nguoidung', [NguoiDungController::class, 'getDanhSach'])->name('nguoidung');
	Route::get('/nguoidung/them', [NguoiDungController::class, 'getThem'])->name('nguoidung.them');
	Route::post('/nguoidung/them', [NguoiDungController::class, 'postThem'])->name('nguoidung.them');
	Route::get('/nguoidung/sua/{id}', [NguoiDungController::class, 'getSua'])->name('nguoidung.sua');
	Route::post('/nguoidung/sua/{id}', [NguoiDungController::class, 'postSua'])->name('nguoidung.sua');
	Route::get('/nguoidung/xoa/{id}', [NguoiDungController::class, 'getXoa'])->name('nguoidung.xoa');

    // Quản lý Chủ đề
    Route::get('/chude', [ChuDeController::class, 'getDanhSach'])->name('chude');
    Route::get('/chude/them', [ChuDeController::class, 'getThem'])->name('chude.them');
    Route::post('/chude/them', [ChuDeController::class, 'postThem'])->name('chude.them');
    Route::get('/chude/sua/{id}', [ChuDeController::class, 'getSua'])->name('chude.sua');
    Route::post('/chude/sua/{id}', [ChuDeController::class, 'postSua'])->name('chude.sua');
    Route::get('/chude/xoa/{id}', [ChuDeController::class, 'getXoa'])->name('chude.xoa');
// Quản lý Bài viết
    Route::get('/baiviet', [BaiVietController::class, 'getDanhSach'])->name('baiviet');
    Route::get('/baiviet/them', [BaiVietController::class, 'getThem'])->name('baiviet.them');
    Route::post('/baiviet/them', [BaiVietController::class, 'postThem'])->name('baiviet.them');
    Route::get('/baiviet/sua/{id}', [BaiVietController::class, 'getSua'])->name('baiviet.sua');
    Route::post('/baiviet/sua/{id}', [BaiVietController::class, 'postSua'])->name('baiviet.sua');
    Route::get('/baiviet/xoa/{id}', [BaiVietController::class, 'getXoa'])->name('baiviet.xoa');
    Route::get('/baiviet/kiemduyet/{id}', [BaiVietController::class, 'getKiemDuyet'])->name('baiviet.kiemduyet');
    Route::get('/baiviet/kichhoat/{id}', [BaiVietController::class, 'getKichHoat'])->name('baiviet.kichhoat');
// Quản lý Bình luận bài viết
    Route::get('/binhluanbaiviet', [BinhLuanBaiVietController::class, 'getDanhSach'])->name('binhluanbaiviet');
    Route::get('/binhluanbaiviet/them', [BinhLuanBaiVietController::class, 'getThem'])->name('binhluanbaiviet.them');
    Route::post('/binhluanbaiviet/them', [BinhLuanBaiVietController::class, 'postThem'])->name('binhluanbaiviet.them');
    Route::get('/binhluanbaiviet/sua/{id}', [BinhLuanBaiVietController::class, 'getSua'])->name('binhluanbaiviet.sua');
    Route::post('/binhluanbaiviet/sua/{id}', [BinhLuanBaiVietController::class, 'postSua'])->name('binhluanbaiviet.sua');
    Route::get('/binhluanbaiviet/xoa/{id}', [BinhLuanBaiVietController::class, 'getXoa'])->name('binhluanbaiviet.xoa');
    Route::get('/binhluanbaiviet/kiemduyet/{id}', [BinhLuanBaiVietController::class, 'getKiemDuyet'])->name('binhluanbaiviet.kiemduyet');
    Route::get('/binhluanbaiviet/kichhoat/{id}', [BinhLuanBaiVietController::class, 'getKichHoat'])->name('binhluanbaiviet.kichhoat');
});