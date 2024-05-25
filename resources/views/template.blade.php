<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Toko Sepatu')</title>
    <link rel="Shortcut icon" href = "{{ asset('images/toko_sepatu.png') }}"alt="">
    <link rel="stylesheet" crossorigin href="{{ asset('compiled/css/app.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('compiled/css/app-dark.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('compiled/css/table-datatable.css') }}">
</head>

<body>
    <script src="{{ asset('static/js/initTheme.js') }}"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="{{ url('dashboard') }}"><img src="{{ asset('images/toko_sepatu.png') }}"
                                    alt="Logo Perusahaan" style="width: 80px; height: auto;">

                            </a>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item">
                            <a href="{{ url('dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @if (Auth::user()->ROLE == 'admin')
                            <li class="sidebar-item  ">
                                <a href="{{ url('pengguna') }}" class='sidebar-link'>
                                    <i class="bi bi-person-fill"></i>
                                    <span>Pengguna</span>
                                </a>
                            </li>
                            <li class="sidebar-item  ">
                                <a href="{{ url('suplier') }}" class='sidebar-link'>
                                    <i class="bi bi-person-check-fill"></i>
                                    <span>Suplier</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item  ">
                            <a href="{{ url('barang') }}" class='sidebar-link'>
                                <i class="bi bi-box2-fill"></i>
                                <span>Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ url('pembeli') }}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Pembeli</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ url('transaksi') }}" class='sidebar-link'>
                                <i class="bi bi-bag-fill"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ url('pembayaran') }}" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Pembayaran</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main" class="layout-navbar navbar-fixed">
            <header>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">

                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">
                                                {{ Auth::user()->NAMA }}
                                            </h6>
                                            <p class="mb-0 text-sm text-gray-600" style="text-transform: capitalize">
                                                {{ Auth::user()->ROLE }}
                                            </p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{ asset('compiled/jpg/2.jpg') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                                    style="min-width: 11rem">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ Auth::user()->NAMA }}!</h6>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">
                @yield('content')
            </div>
        </div>

    </div>

    <script src="{{ asset('extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('compiled/js/app.js') }}"></script>

    @include('sweetalert::alert')

    <!-- Need: Apexcharts -->
    <script src="{{ asset('extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/transaksi-data')
                .then(response => response.json())
                .then(data => {
                    const maxValue = Math.max(...data);
                    var optionsProfileVisit = {
                        annotations: {
                            position: "back",
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        chart: {
                            type: "bar",
                            height: 300,
                        },
                        fill: {
                            opacity: 1,
                        },
                        plotOptions: {},
                        series: [{
                            name: "Transaksi",
                            data: data,
                        }, ],
                        colors: "#435ebe",
                        xaxis: {
                            categories: [
                                "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                            ],
                        },
                        yaxis: {
                            tickAmount: maxValue,
                            forceNiceScale: true,
                            labels: {
                                formatter: function(val) {
                                    return parseInt(val);
                                }
                            }
                        }
                    };

                    var chartProfileVisit = new ApexCharts(
                        document.querySelector("#chart-transaksi"),
                        optionsProfileVisit
                    );

                    chartProfileVisit.render();
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>

    {{-- <script src="{{ asset('static/js/pages/dashboard.js') }}"></script> --}}

    <script src="{{ asset('extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('static/js/pages/simple-datatables.js') }}"></script>
    <script src="{{ asset('static/js/components/dark.js') }}"></script>

    <script script src="https://cdn.tiny.cloud/1/1n3f7wnxsqlud0ga3vqsndjt3zhzvf7skeun894b43byqkwk/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentUrl = window.location.href;
            var sidebarItems = document.querySelectorAll('.sidebar-item a');
            sidebarItems.forEach(function(item) {
                var href = item.getAttribute('href');
                if (currentUrl.includes(href)) {
                    item.closest('.sidebar-item').classList.add('active');
                    var parentSubmenu = item.closest('.has-sub');
                    if (parentSubmenu) {
                        parentSubmenu.classList.add('active');
                    }
                }
            });
        });
    </script>


</body>

</html>
