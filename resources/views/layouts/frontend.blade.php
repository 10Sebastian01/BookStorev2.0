<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />

    <!-- SEO Meta Tags -->
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#ffffff" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', 'Trang chủ') - {{ config('app.name', 'Laravel') }}</title>

    <title>Trang chủ</title>

    <!-- Favicon and Touch Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/img/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/img/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/img/favicon-16x16.png') }}" />

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" media="screen" href="{{ asset('public/vendor/simplebar/simplebar.min.css') }}" />
    <link rel="stylesheet" media="screen" href="{{ asset('public/vendor/tiny-slider/tiny-slider.css') }}" />
    <link rel="stylesheet" media="screen" href="{{ asset('public/vendor/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" media="screen" href="{{ asset('public/vendor/drift-zoom/drift-basic.min.css') }}" />
    <link rel="stylesheet" media="screen"
        href="{{ asset('public/vendor/lightgallery/lightgallery-bundle.min.css') }}" />
    <link rel="stylesheet" media="screen" href="{{ asset('public/css/theme.min.css') }}" />

</head>

<body class="handheld-toolbar-enabled">
    <main class="page-wrapper">
        <header class="shadow-lg">
            <div class="navbar bg-light">
                <div class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <a class="navbar-brand d-none d-sm-block flex-shrink-0" href="{{ route('frontend.home') }}">
                            <img src="{{ asset('public/img/logo-screen.png') }}" width="142" />
                        </a>
                        <div class="input-group">
                            <a class="nav-link" href="{{ route('frontend.home') }}">
                                <i class="ci-home me-2"></i>Trang chủ
                            </a>
                        </div>
                        <div class="dropdown ps-lg-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Menu
                            </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                <li class="nav-item dropdown ps-lg-4">
                                    <a class="nav-link dropdown-toggle" href="{{ route('frontend.sach') }}"
                                        data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                        <i class="ci-gift me-2"></i>Sách
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach ($loaisach as $ls)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('frontend.sach.phanloai', ['tenloai_slug' => $ls->tenloai_slug]) }}">
                                                    {{ $ls->tenloai }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="dropdown-item">
                                <li class="nav-item ps-lg-4">
                                    <a class="nav-link" href="{{ route('frontend.baiviet') }}"><i
                                            class="ci-globe me-2"></i>Tin tức</a>
                                </li>
                                </li>
                                <li class="dropdown-item">
                                <li class="nav-item ps-lg-4">
                                    <a class="nav-link" href="{{ route('frontend.lienhe') }}"><i
                                            class="ci-support me-2"></i>Liên hệ</a>
                                </li>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="navbar navbar-expand-xl navbar-light">
                    <div class="input-group d-none d-lg-flex mx-4">
                        <input class="form-control rounded-end pe-5" type="text" placeholder="Tìm kiếm" />
                        <i
                            class="ci-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
                    </div>

                </div>

                <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
                    <div class="container">
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <!-- Login area -->
                            @guest
                                <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{ route('user.dangnhap') }}">
                                    <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                                    <div class="navbar-tool-text ms-n3"><small>Xin chào</small>Khách hàng</div>
                                </a>
                            @else
                                <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{ route('user.home') }}">
                                    <li class="nav-item dropdown" style="list-style-type: none">
                                        <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                                        <div class="navbar-tool-text ms-n3">
                                            <small>Xin chào</small>{{ Auth::user()->name }}
                                        </div>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                <i class="fa-solid fa-right-to-bracket"></i> Đăng xuất
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="post"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </a>
                            @endguest

                            <!-- Giỏ hàng -->
                            <div class="navbar-tool ms-3">
                                <a class="navbar-tool-icon-box bg-secondary" href="{{ route('frontend.giohang') }}">
                                    <span class="navbar-tool-label">{{ Cart::count() ?? 0 }}</span><i
                                        class="navbar-tool-icon ci-cart"></i>
                                </a>
                                <a class="navbar-tool-text" href="{{ route('frontend.giohang') }}"><small>Giỏ
                                        hàng</small>{{ Cart::priceTotal() ?? 0 }}đ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')
    </main>

    <footer class="footer bg-dark">
        <div class="pt-5 bg-darker">
            <div class="container">
                <div class="row pb-2">
                    <div class="col-md-6 text-center text-md-start mb-4">
                        <div class="text-nowrap mb-4">
                            <a class="d-inline-block align-middle mt-n1 me-3" href="#"><img class="d-block"
                                    src="{{ asset('public/img/logo-small.png') }}" width="70" /></a>
                        </div>
                        <div class="widget widget-links widget-light">
                            <ul class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start">
                                <li class="widget-list-item me-4"><a class="widget-list-link" href="#">Trang
                                        chủ</a></li>
                                <li class="widget-list-item me-4"><a class="widget-list-link" href="#">Sách</a>
                                </li>
                                <li class="widget-list-item me-4"><a class="widget-list-link" href="#">Tin
                                        tức</a></li>
                                <li class="widget-list-item me-4"><a class="widget-list-link" href="#">Danh
                                        mục</a></li>
                                <li class="widget-list-item me-4"><a class="widget-list-link" href="{{ route('frontend.lienhe') }}">Liên
                                        hệ</a></li>
                            </ul>
                        </div>
                        <div class="widget widget-links widget-light">
                            <h3 class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start text-light">About H&N</h3>
                            <p class ='text-light'>BookStore H&N là đề tài đồ án của môn Công Nghệ Web - PHP do Cao Văn Hóa và Hồ Phú Nghĩa thực
                                hiện. Đồ án được viết bằng ngôn ngữ php dựa trên framework laravel.</p>
                            <p><a href="{{ route('frontend.lienhe') }}" class="footer-link-more">Xem thêm</a></p>
                        </div>
                        
                    </div>
                    <div class="col-md-6 text-center text-md-end mb-4">
                        <div class="mb-3">
                            <a class="btn-social bs-light bs-twitter ms-2 mb-2" href="#"><i
                                    class="ci-twitter"></i></a>
                            <a class="btn-social bs-light bs-facebook ms-2 mb-2" href="#"><i
                                    class="ci-facebook"></i></a>
                            <a class="btn-social bs-light bs-instagram ms-2 mb-2" href="#"><i
                                    class="ci-instagram"></i></a>
                            <a class="btn-social bs-light bs-pinterest ms-2 mb-2" href="#"><i
                                    class="ci-pinterest"></i></a>
                            <a class="btn-social bs-light bs-youtube ms-2 mb-2" href="#"><i
                                    class="ci-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="pb-4 fs-xs text-light opacity-50 text-center text-md-start">Bản quyền © 2023 BookStore H&N
                </div>
            </div>
        </div>
    </footer>
    <a class="btn-scroll-top" href="#top" data-scroll>
        <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span>
        <i class="btn-scroll-top-icon ci-arrow-up"></i>
    </a>

    <script src="{{ asset('public/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/vendor/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/vendor/tiny-slider/tiny-slider.js') }}"></script>
    <script src="{{ asset('public/vendor/smooth-scroll/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ asset('public/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('public/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/vendor/shufflejs/shuffle.min.js') }}"></script>
    <script src="{{ asset('public/vendor/lightgallery/lightgallery.min.js') }}"></script>
    <script src="{{ asset('public/vendor/lightgallery/plugins/fullscreen/lg-fullscreen.min.js') }}"></script>
    <script src="{{ asset('public/vendor/lightgallery/plugins/zoom/lg-zoom.min.js') }}"></script>
    <script src="{{ asset('public/vendor/lightgallery/plugins/video/lg-video.min.js') }}"></script>
    <script src="{{ asset('public/vendor/drift-zoom/Drift.min.js') }}"></script>
    <script src="{{ asset('public/js/theme.min.js') }}"></script>

</body>

</html>
