<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แผนภูมิ</title>
    <link rel="stylesheet" href="../css/chart.css" />
    <link rel="stylesheet" href="{{ asset('css/loginshow.css') }}">
    <link rel="stylesheet" href="../css/scroobar.css">

    <!-- เพิ่มการโหลด jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Import Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" href="{{ asset('img/iconx2.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <style>

    </style>

</head>

<body>
    @if(Auth::check() && Auth::user()->name)
    @if (Auth::check() && Auth::user()->level === 'admin')

    <div class="center">
        <div class="container mt-4">
            <div class="gb">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <h2 class="text-center fixed-header">แผนภูมิ</h2>

                <div class="text-end mb-3 fixed-button">
                    <button class="btn btn-primary" onclick="toggleView()">ปรับมุมมอง</button>
                    <a href="{{ route('alldata')}}" class="btn btn-success">ย้อนกลับ</a>
                    <a href="../map" class="btn btn-info">กลับไปยังแผนที่</a>
                </div>

                <form id="searchForm" class="search-form text-center">
                    <input type="text" id="searchInput" class="search-input form-control d-inline-block w-25"
                        placeholder="🔍 พิมพ์ จังหวัด, อำเภอ หรือ อื่นๆ">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </form>

                <div id="graphView" class="graph-container">
                    <div class="conx">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="conx">
                        <canvas id="myCharttow"></canvas>
                    </div>
                    <div class="conx" style="display: none;">
                        <!-- ซ่อนไว้ก่อน -->
                        <canvas id="myChartview"></canvas> <!-- กราฟที่จะแสดงหลังค้นหา -->
                    </div>

                </div>
            </div>
        </div>

        @else
        <div class="login-alert">
            <h2>กรุณาเข้าสู่ระบบ</h2>
            <a href="{{route('login')}}" class="btn btn-primary">Go To Login</a>
        </div>
        @endif
        @endif
    </div>
    <script>
    const markers = @json($markers);

    if (markers && markers.length > 0) {
        let yearCount = {};

        markers.forEach(marker => {
            let year = marker.year_money; // ตรวจสอบว่า year_money ถูกต้อง
            if (year) {
                yearCount[year] = (yearCount[year] || 0) + 1;
            }
        });

        let labels = Object.keys(yearCount);
        let data = Object.values(yearCount);
        const maxValue = Math.max(...data, 5); // กำหนดค่ามากสุด +2 เพื่อให้กราฟไม่ขาด

        if (labels.length > 0) {
            const ctx = document.getElementById('myChart').getContext('2d');

            // ตรวจสอบว่า ctx ไม่เป็น null
            if (ctx) {
                new Chart(ctx, {
                    type: 'line', // ใช้กราฟแบบ line
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'จำนวนข้อมูลในแต่ละปี',
                            data: data,
                            backgroundColor: 'rgba(255, 255, 255, 0)', // สีพื้นหลังกราฟ
                            borderColor: '#ffc82a', // สีเส้นกราฟ
                            borderWidth: 2,
                            fill: true
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                min: 0,
                                max: maxValue + 2 // ตั้งค่ามากสุด
                            }
                        }
                    }
                });
            } else {
                console.error("Canvas context not found");
            }
        } else {
            console.warn("No valid data for chart.");
        }

        if (labels.length > 0) {
            const ctx = document.getElementById('myCharttow').getContext('2d');

            function getRandomColor() {
                return `hsl(${Math.floor(Math.random() * 360)}, 70%, 50%)`;
            }

            // กำหนดสีสุ่มให้แต่ละปี
            const originalLabels = [...labels]; // เก็บ labels เดิม
            const originalData = [...data]; // เก็บ data เดิม
            const backgroundColorSet = originalLabels.map(() => getRandomColor());

            // สร้างตัวแปรสำหรับเก็บสถานะปีที่ถูกซ่อน
            let hiddenYears = new Set();
            let myChart; // กำหนด myChart ไว้ภายนอก

            function updateChart() {
                if (!myChart) return; // เช็คว่า myChart ถูกสร้างแล้วหรือยัง

                let filteredLabels = [];
                let filteredData = [];
                let filteredColors = [];

                originalLabels.forEach((year, index) => {
                    if (!hiddenYears.has(year)) { // ถ้าปียังไม่ถูกซ่อน
                        filteredLabels.push(year);
                        filteredData.push(originalData[index]);
                        filteredColors.push(backgroundColorSet[index]);
                    }
                });

                myChart.data.labels = filteredLabels;
                myChart.data.datasets[0].data = filteredData;
                myChart.data.datasets[0].backgroundColor = filteredColors;
                myChart.update();
            }

            if (ctx) {
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: originalLabels,
                        datasets: [{
                            label: 'จำนวนข้อมูลในแต่ละปี',
                            data: originalData,
                            backgroundColor: backgroundColorSet,
                            borderWidth: 0 // ไม่มีขอบ
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                min: 0,
                                max: Math.max(...originalData) + 2
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    generateLabels: function(chart) {
                                        return originalLabels.map((label, i) => ({
                                            text: `ปี ${label}`,
                                            fillStyle: backgroundColorSet[i],
                                            hidden: hiddenYears.has(label),
                                            index: i
                                        }));
                                    }
                                },
                                onClick: function(e, legendItem) {
                                    const year = originalLabels[legendItem.index];

                                    if (hiddenYears.has(year)) {
                                        hiddenYears.delete(year); // แสดงปีที่ถูกซ่อน
                                    } else {
                                        hiddenYears.add(year); // ซ่อนปีนั้น
                                    }

                                    updateChart(); // อัปเดตกราฟ
                                }
                            }
                        }
                    }
                });
            } else {
                console.error("Canvas context not found");
            }
        }


    } else {
        console.error("Markers data is empty or undefined");
    }

    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // ป้องกันหน้าโหลดใหม่

        let searchQuery = document.getElementById('searchInput').value.trim();
        if (!searchQuery) return; // ถ้าค่าว่าง ไม่ต้องค้นหา

        let searchField = null;
        if (searchQuery.includes("จังหวัด")) {
            searchField = "province";
        } else if (searchQuery.includes("อำเภอ")) {
            searchField = "district";
        } else if (searchQuery.includes("ตำบล")) {
            searchField = "subdistrict";
        } else if (searchQuery.includes("โครงการ")) {
            searchField = "Nactivity";
        } else if (searchQuery.includes("หมู่บ้าน")) {
            searchField = "mauban";
        } else if (searchQuery.includes("แหล่งงบประมาณ")) {
            searchField = "arear_money";
        } else if (searchQuery.includes("ปีงบประมาณ")) {
            searchField = "year_money";
        } else if (searchQuery.includes("ผู้ดูแลโครงการ")) {
            searchField = "my_name";
        } else if (searchQuery.includes("status")) {
            searchField = "status";
        }

        if (!searchField) {
            alert("กรุณาพิมพ์ จังหวัด, อำเภอ หรือ ตำบล เท่านั้น");
            return;
        }

        let filteredData = {};
        markers.forEach(marker => {
            let key = marker[searchField];
            if (key) {
                filteredData[key] = (filteredData[key] || 0) + 1;
            }
        });

        let labels = Object.keys(filteredData);
        let data = Object.values(filteredData);

        if (labels.length === 0) {
            alert("ไม่พบข้อมูลที่ค้นหา");
            return;
        }

        // 🔥 ซ่อน myChart และแสดง myChartview
        document.getElementById('myChartview').parentElement.style.display = 'block';

        // 🔥 ลบกราฟเก่าถ้ามี
        if (window.myChartview instanceof Chart) {
            window.myChartview.destroy();
        }


        // 🟢 จัดกลุ่มข้อมูล
        const groupedData = {};
        const yearsSet = new Set();
        markers.forEach(({ province, year_money }) => {
            if (province && year_money) { // ✅ กรองค่าที่เป็น null หรือ "" ออก
                if (!groupedData[province]) {
                    groupedData[province] = {};
                }
                groupedData[province][year_money] = (groupedData[province][year_money] || 0) + 1;
                yearsSet.add(year_money);
            }
        });

        // 🟢 เปลี่ยนชื่อ labels -> provinceLabels
        const provinceLabels = Object.keys(groupedData); // รายชื่อจังหวัด
        const years = [...yearsSet].sort(); // ปีที่มีข้อมูล
        const datasets = years.map((year, index) => {
            return {
                label: `ปี ${year}`,
                data: provinceLabels.map(province => groupedData[province][year] || 0),
                backgroundColor: `hsl(${index * 100}, 70%, 50%)`, // ใช้สีแตกต่างกัน
                borderColor: 'rgba(0, 0, 0, 0.1)',
                borderWidth: 1
            };
        });

        // 🔥 วาดกราฟใหม่
        const ctx = document.getElementById('myChartview').getContext('2d');
        window.myChartview = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: provinceLabels, // รายชื่อจังหวัด
                datasets: datasets // ข้อมูลที่แยกตามปี
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: `จำนวนกิจกรรมแยกตามจังหวัดและปี`
                    },
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        stacked: false // แสดงผลเป็นกลุ่ม
                    },
                    y: {
                        beginAtZero: true,
                        stacked: false, // แสดงผลเป็นกลุ่ม
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

    });


    </script>

</body>

</html>