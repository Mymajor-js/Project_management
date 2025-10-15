<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arts & Science CPRU Activity</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/osmtogeojson"></script> <!-- ใช้แปลง OSM เป็น GeoJSON -->
    <script src="https://cdn.jsdelivr.net/npm/osmtogeojson@3.0.0/osmtogeojson.js"></script>
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/mapcssx.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loginshow.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('img/iconx2.png') }}" type="image/png">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>



    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .fade-section {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        display: none;
    }

    /* เมื่อ active */
    .fade-section.show {
        display: block;
        opacity: 1;
    }

    .fade-move {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease-in-out;
    }

    .fade-move.show {
        opacity: 1;
        transform: translateY(0);
    }

    .navbar-nav {

        background-color: #567086;
    }

    .weh_100 {
        margin-top: 15px;
        height: 300px;
    }

    .notification-item:hover {
        transform: scale(1.02);
        background-color: #ffe082 !important;
    }

    .notification-item.bg-light:hover {
        background-color: #f0f0f0 !important;
    }

    .notification-item .btn-outline-danger {
        opacity: 0.6;
    }

    .notification-item .btn-outline-danger:hover {
        opacity: 1;
    }

    @media (max-width: 576px) {
        #notification-panel {
            width: 95vw !important;
            right: 10px !important;
            bottom: 80px !important;
        }

        .position-fixed.bottom-0.end-0.m-4 {
            bottom: 20px !important;
            right: 20px !important;
        }
    }

    .badge {
        font-size: 0.7rem;
        padding: 0.3em 0.5em;
    }
    #notification-list {
    max-height: 420px; /* ปรับความสูงประมาณให้พอดี ~6-7 รายการ */
    overflow-y: auto;
    padding-right: 6px; /* เผื่อขอบ scrollbar */
}

#notification-list::-webkit-scrollbar {
    width: 6px;
}

#notification-list::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
}
    select.form-control {
        height: auto !important;
        min-height: 38px;
        padding-top: 8px;
        padding-bottom: 8px;
        line-height: 1.5;
        overflow: visible;
        white-space: normal;
    }

    select.form-control option {
        white-space: normal; /* ให้ข้อความพับบรรทัดถ้ายาว */
    }
    </style>
</head>

<body id="reportsPage">

    @if(Auth::check() && Auth::user()->name)
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl fixed-top">
            <div class="container h-100">
                <a class="navbar-brand" href="{{route('dashboard')}}">
                    <img src="{{ asset('img/iconx2.png') }}" class="imageicon">
                    <div class="text">
                        <h2 class="tm-site-title mb-0">PMDS. Arts & Science</h2>
                        <p class="textparagraft">Project Management Database System</p>
                    </div>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  mx-auto h-100">
                        <li class="nav-item">
                            <button class="nav-link active btntop" id="activebtn_dashboard" onclick="o_dashboard()">
                                <i class="fa-solid fa-map"></i>
                                Home
                                <span class="sr-only">(current)</span>
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link btntop " id="activebtn_list" onclick="o_list()">
                                <i class="fa-regular fa-rectangle-list"></i>
                                Information List
                            </button>
                        </li>
                        @if (Auth::check() && Auth::user()->level === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" id="dropdownToggle" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-folder-open"></i>
                                <span>
                                    Admin Menu <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu-admin" id="dropdownMenu">
                                <button class="dropdown-item-admin" id="activebtn_createaccount"
                                    onclick="o_createaccount()"> Create Account</button>
                                <button class="dropdown-item-admin" id="activebtn_addpj" onclick="o_addpj()"> Add
                                    Project</button>
                                <button class="dropdown-item-admin" id="activebtn_assign" onclick="o_assig()"> Assign
                                    Project</button>
                                <button class="dropdown-item-admin" id="activebtn_assign" onclick="o_teachers()"> Add Teachers</button>
                            </div>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link btntop" id="chartfunction" onclick="o_chart()">
                                <i class="fa-solid fa-chart-pie"></i>
                                Chart
                            </button>
                        </li>
                        @endif
                        <li class="nav-item">
                            <button class="nav-link btntop" id="settingaccount" onclick="o_account()">
                                <i class="fa-solid fa-user"></i>
                                Account Settings
                            </button>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">

                            <form method="POST" action="{{ route('logout') }}" class="list-marker-btn">
                                @csrf

                                <button class="btns">Hello : {{ Auth::user()->name }} <br>
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        @if (Auth::check() && Auth::user()->level === 'admin')
        <div class="buttom-right">
            <!-- ปุ่มแจ้งเตือนลอย -->
            <button class="btn btn-warning rounded-circle position-fixed bottom-0 end-0 m-4 shadow position-relative"
                style="width: 60px; height: 60px; z-index: 1050;" onclick="toggleNotificationPanel()">

                <i class="fa-solid fa-bell fs-4"></i>

                @php
                $unreadCount = Auth::user()->unreadNotifications->count();
                @endphp

                @if($unreadCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle"
                    style="background: white; color: red; font-size: 0.75rem; padding: 4px 6px;">
                    {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                </span>
                @endif

            </button>


            <div id="notification-panel" class="position-fixed bottom-0 end-0 m-5 bg-white rounded shadow"
                style="width: 360px; max-height: 500px; overflow-y: auto; display: none;border:none; z-index: 1051;">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">🔔 Notifications</h5>
                    <div class="d-flex gap-2 align-items-center">
                        <form method="POST" action="{{ route('notifications.deleteRead') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                title="ลบที่อ่านแล้ว">🗑️</button>
                        </form><br>
                        <button type="button"stye="margin-left:2px;" class="btn p-0 border-0 bg-transparent"
                            style="box-shadow: 0 2px 5px rgba(0, 0, 0, 0);" onclick="toggleNotificationPanel()">
                            <i class="fa-solid fa-xmark fs-5"></i>
                        </button>
                    </div>
                </div>

                <div class="p-3" id="notification-list">
                    @foreach(Auth::user()->notifications as $note)
                    <div class="d-flex align-items-start mb-3 p-2 rounded 
                        {{ $note->read_at ? 'bg-light text-muted' : 'bg-white text-dark' }}"
                        onclick="markAsRead('{{ $note->id }}', this)"
                        style="cursor: pointer; transition: 0.2s; border-left: 4px solid {{ $note->read_at ? '#ccc' : '#ffc107' }}">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                            class="rounded-circle me-3" width="45" height="45">
                        <div style="flex: 1; margin-left:10px;">
                            <div class="fw-bold">{{ $note->data['title'] ?? 'แจ้งเตือน' }}</div>
                            <div class="small" title="{{ $note->data['message'] ?? '-' }}"
                                style="max-height: 4.5em; overflow: hidden;">
                                {{ Str::limit($note->data['message'], 100) }}
                            </div>
                            <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
                        </div>

                        @if($note->read_at)
                        <form method="POST" action="{{ route('notifications.delete', $note->id) }}" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                title="ลบแจ้งเตือนนี้">🗑️</button>
                        </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <div class="container" style="margin-top: 130px;">
            <div class="row">
                <div class="col">
                    <div style="text-align: center; margin-bottom: 20px;">
                        <button onclick="moveUp()" class="btn btn-success"><i class="fa-solid fa-download"></i> How To
                            Program</button>
                        @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>

            <div id="sectionContainer">
                <div id="mapSection" class="fade-move col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col fade-move">
                    <div class="tm-bg-primary-dark tm-blockx weh1"
                        style="padding: 20px; min-height: 610px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <h2 class="tm-block-title">Map Controller</h2>
                        <div class="contrllerbtn">
                            <a href="{{route('mesavex')}}" id="disableMarkerBtn" class="btn-addmark2">
                                <span>✒️</span>
                                <span>กรอกเพิ่มโครงการ</span>
                            </a>
                        </div><br>
                        <div id="map"></div>
                    </div>
                </div>
                <div id="infoSection" class="fade-move col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col fade-move">


                    <div class="tm-bg-primary-dark tm-block weh">
                        <h2 class="tm-block-title">Information Controller</h2>

                        <div class="search-form">
                            <input type="text" id="searchInput" name="query" placeholder="🔍 Search..."
                                value="{{ request()->input('query') }}" class="search-input">

                        </div><br>
                        <div id="tableViewContent">
                            @include('partials.homelist', ['markers' => $markers, 'images' => $images])
                        </div>

                    </div>
                </div>
                <div id="create-account"
                    class="fade-move col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col fade-move">
                    <div class="tm-bg-primary-dark tm-block weh">
                        <h2 class="tm-block-title">Create User Account</h2>

                        @include('partials.user-register')

                    </div>
                </div>

                <div id="add_activity" class="fade-move col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col fade-move">
                    <div class="tm-bg-primary-dark tm-block weh">
                        <h2 class="tm-block-title">เพิ่มโปรเจ็ค</h2>

                        @include('partials.add_activity', ['users' => $users])

                    </div>
                </div>

                <div id="sent_activity"
                    class="fade-move col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col fade-move">
                    <div class="tm-bg-primary-dark tm-block weh">
                        <h2 class="tm-block-title">เพิ่มโปรเจ็ค</h2>

                        @include('partials.sent-activity', ['users' => $users])

                    </div>
                </div>
                <div id="open_chart">
                    @include('partials.chart_active')
                </div>

                <div id="add_teachers"
                    class="fade-move col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col fade-move">
                    <div class="tm-bg-primary-dark tm-block weh">

                        @include('partials.create')

                    </div>
                </div>
            </div>


            <div id="setting_account" class="fade-move col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col fade-move">
                
                    @include('partials.update_user', ['userLoggedIn' => $userLoggedIn])

            </div>

        </div>

    </div>

    <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
            <p class="text-center text-white mb-0 px-4 small">
                Arts & Science CPRU Activity

                Make by: <a rel="nofollow noopener" href="https://www.facebook.com/nitithorn.687364/?locale=th_TH"
                    class="tm-footer-link">Nitithorn</a>
            </p>
        </div>
    </footer>
    </div>
    @endif
    <script>
    let map = null;
    let markersLayer = null;
    let canAddMarker = false;
    let isNotificationOpen = false;
    document.addEventListener('click', function (event) {
        const panel = document.getElementById('notification-panel');
        const button = event.target.closest('button');
        const isInsidePanel = panel.contains(event.target);
        const isBellButton = event.target.closest('.btn.btn-warning');

        if (!isInsidePanel && !isBellButton && isNotificationOpen) {
            toggleNotificationPanel(); // ปิด
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const sections = {
            dashboard: document.getElementById('mapSection'),
            list: document.getElementById('infoSection'),
            createaccount: document.getElementById('create-account'),
            addpj: document.getElementById('add_activity'),
            openchart: document.getElementById('open_chart'),
            saccount: document.getElementById('setting_account'),
            assign: document.getElementById('sent_activity'),
            teachers: document.getElementById('add_teachers')
        };

        function clearActiveStates() {
            const allButtons = document.querySelectorAll(
                '.btntop, .dropdown-item-admin, .nav-link.dropdown-toggle');
            allButtons.forEach(btn => btn.classList.remove('active'));
        }

        function showSection(sectionKey, activeBtnId) {
            clearActiveStates();

            const newSection = sections[sectionKey];
            if (!newSection) return;

            const activeBtn = document.getElementById(activeBtnId);
            if (activeBtn) activeBtn.classList.add('active');

            if (['createaccount', 'addpj', 'assign','teachers'].includes(sectionKey)) {
                const dropdownToggle = document.getElementById('dropdownToggle');
                if (dropdownToggle) dropdownToggle.classList.add('active');
            }

            Object.values(sections).forEach(section => {
                section.classList.remove('show');
                setTimeout(() => (section.style.display = 'none'), 300);
            });

            setTimeout(() => {
                newSection.style.display = 'block';
                setTimeout(() => {
                    newSection.classList.add('show');

                    if (sectionKey === 'dashboard') {
                        if (!map) {
                            map = L.map('map').setView([15.8106, 102.0285], 9);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap contributors'
                            }).addTo(map);
                            markersLayer = L.layerGroup().addTo(map);
                        }
                        setTimeout(() => map.invalidateSize(), 400);
                        loadMarkers();
                    }
                }, 10);
            }, 300);
        }

        // ปุ่มต่างๆ
        window.o_dashboard = () => showSection('dashboard', 'activebtn_dashboard');
        window.o_list = () => showSection('list', 'activebtn_list');
        window.o_createaccount = () => showSection('createaccount', 'activebtn_createaccount');
        window.o_addpj = () => showSection('addpj', 'activebtn_addpj');
        window.o_assig = () => showSection('assign', 'activebtn_assign');
        window.o_chart = () => showSection('openchart', 'chartfunction');
        window.o_account = () => showSection('saccount', 'settingaccount');
        window.o_teachers = () => showSection('teachers', 'activebtn_teachers');

        // ✅ ตรวจ section จาก URL แล้วเรียก function
        const urlParams = new URLSearchParams(window.location.search);
        const section = urlParams.get('section');

        switch (section) {
            case 'infoSection':
                o_list();
                break;
            case 'createaccount':
                o_createaccount();
                break;
            case 'addpj':
                o_addpj();
                break;
            case 'assign':
                o_assig();
                break;
            case 'openchart':
                o_chart();
                break;
            case 'saccount':
                o_account();
                break;
            default:
                o_dashboard();
                break;
        }
    });


    function loadMarkers(year = '') {
        if (!markersLayer) return;
        markersLayer.clearLayers();

        fetch('/get-markers?year=' + year)
            .then(response => response.json())
            .then(markersData => {
                Object.values(markersData).forEach(marker => {
                    const popupContent = `
                    <p>พิกัด: ${marker.latitude}, ${marker.longitude}</p>
                    <p>ชื่อโครงการ/กิจกรรม: ${marker.Nactivity}</p>
                    <p>ผู้รับผิดชอบ: ${marker.my_name}</p>
                    <p>ปีงบประมาณ: ${marker.year_money}</p>
                    ${marker.image ? `<img src="${marker.image}" alt="กิจกรรม" style="width: 100px;">` : '<p>ไม่มีรูปภาพ</p>'}
                    <br><br><button class="btnshow" onclick="viewMarkerInfo(${marker.latitude}, ${marker.longitude},'${marker.Nactivity}')">ดูข้อมูล</button>
                `;

                    const greenIcon = L.icon({
                        iconUrl: '../img/greenmark.png',
                        iconSize: [45, 45],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    L.marker([marker.latitude, marker.longitude], {
                            icon: greenIcon
                        })
                        .addTo(markersLayer)
                        .bindPopup(popupContent);
                });
            })
            .catch(error => console.error("เกิดข้อผิดพลาดในการดึงหมุด:", error));
    }

    function enableAddMarker() {
        canAddMarker = true;
        document.querySelector('.function-button').classList.add('black');
        document.querySelector('.function-button').classList.remove('before');
        document.getElementById('addMarkerBtn').style.display = 'none';
        document.getElementById('disableMarkerBtn').style.display = 'block';
    }

    function disableAddMarker() {
        canAddMarker = false;
        document.querySelector('.function-button').classList.add('before');
        document.querySelector('.function-button').classList.remove('black');
        document.getElementById('addMarkerBtn').style.display = 'block';
        document.getElementById('disableMarkerBtn').style.display = 'none';
    }

    function openForm(lat, lng, Nactivity, my_name) {
        window.location.href =
            `/add-marker-info?lat=${lat}&lng=${lng}&project=${encodeURIComponent(Nactivity)}&responsible=${encodeURIComponent(my_name)}`;
    }

    function viewMarkerInfo(latitude, longitude, Nactivity) {

        var url = 'show-data?lat=' + latitude + '&lng=' + longitude + '&Nac=' + Nactivity;
        window.location.href = url;
    }

    function enableAddMarker() {
        canAddMarker = true;
        document.querySelector('.function-button').classList.add('black');
        document.querySelector('.function-button').classList.remove('before');
        document.getElementById('addMarkerBtn').style.display = 'none';
        document.getElementById('disableMarkerBtn').style.display = 'block';
    }

    const toggle = document.getElementById('dropdownToggle');
    const menu = document.getElementById('dropdownMenu');

    toggle.addEventListener('click', function(event) {
        event.preventDefault();
        event.stopPropagation();

        // ปิดเมนูอื่นก่อนถ้ามี
        document.querySelectorAll('.dropdown-menu-admin').forEach(el => {
            if (el !== menu) el.style.display = 'none';
        });

        // toggle ตัวนี้
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    });

    // ปิดเมื่อคลิกข้างนอก
    document.addEventListener('click', function() {
        menu.style.display = 'none';
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof L !== 'undefined') {
            document.addEventListener('click', function(e) {
                if (!canAddMarker || !map) return;

                const latlng = map.mouseEventToLatLng(e);
                const lat = latlng.lat.toFixed(6);
                const lng = latlng.lng.toFixed(6);

                const marker = L.marker([lat, lng]).addTo(markersLayer)
                    .bindPopup("กำลังดึงข้อมูล...");

                fetch(
                        `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=10&addressdetails=1`
                    )
                    .then(response => response.json())
                    .then(data => {
                        const my_name = "{{ Auth::user()->my_name }}";
                        marker.setPopupContent(`
                        <p>พิกัด: ${lat}, ${lng}</p>
                        <p>ชื่อโครงการ/กิจกรรม: -</p>
                        <p>ผู้รับผิดชอบ: ${my_name}</p>
                        <button onclick="openForm(${lat}, ${lng}, '-', '${my_name}')">เพิ่มข้อมูล</button>
                    `);
                    })
                    .catch(() => {
                        marker.setPopupContent(
                            `<p>พิกัด: ${lat}, ${lng}</p><p>ไม่สามารถดึงข้อมูลที่อยู่ได้</p>`);
                    });
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function() {
            const query = this.value;

            fetch('/alldatalist?search=' + encodeURIComponent(query), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('tableViewContent').innerHTML = html;
                });
        });

        // จับ pagination ด้วย event delegation
        document.addEventListener('click', function(e) {
            const link = e.target.closest('.pagination a');

            if (link) {
                e.preventDefault();

                const url = link.getAttribute('href');

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('tableViewContent').innerHTML = html;
                        // 🧠 ไม่ต้องเรียก o_list() ซ้ำ ถ้าหน้าปัจจุบันคือ infoSection อยู่แล้ว
                    })
                    .catch(error => console.error("Pagination fetch error:", error));
            }
        });


    });

    function confirmDelete(nactivity) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณจะไม่สามารถกู้คืนกิจกรรมนี้ได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(`delete-form-${nactivity}`);
                if (form) {
                    form.submit();
                } else {
                    console.error('ไม่พบฟอร์มลบสำหรับ Nactivity: ', nactivity);
                }
            }
        });
    }

    document.addEventListener('click', function(e) {
        const deleteButton = e.target.closest('.delete-btn');
        if (deleteButton) {
            e.preventDefault();
            const nactivity = deleteButton.getAttribute('data-nactivity');
            confirmDelete(nactivity);
        }
    });


    function viewMarkerInfo(latitude, longitude, Nactivity) {
        console.log("Latitude: " + latitude); // ตรวจสอบค่าของ latitude
        console.log("Longitude: " + longitude); // ตรวจสอบค่าของ longitude
        console.log("Nactivity: " + Nactivity); // ตรวจสอบค่าของ Nactivity

        var url = 'show-data?lat=' + latitude + '&lng=' + longitude + '&Nac=' + Nactivity;
        window.location.href = url;
    }

    function toggleView() {
        let tableView = document.getElementById("tableView");
        let gridView = document.getElementById("gridView");
        let graphView = document.getElementById("graphView");

        if (tableView && gridView) {
            if (tableView.style.display === "none") {
                tableView.style.display = "block";
                gridView.style.display = "none";
                graphView.style.display = "none";
            } else {
                tableView.style.display = "none";
                gridView.style.display = "block";
                graphView.style.display = "none";
            }
        } else {
            console.error("❌ tableView หรือ gridView ไม่พบใน DOM");
        }
    }

    function toggleViewgraph() {
        let tableView = document.getElementById("tableView");
        let gridView = document.getElementById("gridView");
        let graphView = document.getElementById("graphView");
        graphView.style.display = "block"; // ทำให้แสดงกราฟ
        tableView.style.display = "none";
        gridView.style.display = "none";
    }

    function moveSection(section, target, callback) {
        section.classList.add('fade-leave');
        setTimeout(() => {
            target.after(section); // ย้ายตำแหน่ง
            section.classList.remove('fade-leave');
            section.classList.add('fade-enter');
            setTimeout(() => {
                section.classList.remove('fade-enter');
                if (typeof callback === 'function') callback(); // เรียก callback หลังจบ animation
            }, 500);
        }, 300);
    }

    function toggleNotificationPanel() {
        const panel = document.getElementById('notification-panel');
        if (panel.style.display === 'none' || panel.style.display === '') {
            panel.style.display = 'block';
            isNotificationOpen = true;
        } else {
            panel.style.display = 'none';
            isNotificationOpen = false;
        }
    }

    function markAsRead(id, el) {
        fetch('/notifications/read/' + id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(res => {
                if (res.ok) {
                    el.classList.remove('bg-white', 'text-dark');
                    el.classList.add('bg-light', 'text-muted');
                }
            });
    }
    </script>
</body>

</html>