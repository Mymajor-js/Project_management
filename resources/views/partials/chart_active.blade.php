
<div class="row tm-content-row">
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
    <div class="tm-bg-primary-dark tm-block xweh">
        <h2 class="tm-block-title">กราฟแสดงจำนวนการโครงการแต่ละปี</h2>
        <center><canvas id="yearChart" style="display: block; box-sizing: border-box; height: 350px; width: 350px;"></canvas></center>
    </div>
</div>
<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
    <div class="tm-bg-primary-dark tm-block xweh">
        <h2 class="tm-block-title">กราฟแสดงจำนวนการโครงการแต่ละจังหวัด</h2>
        <canvas id="provinceChart"></canvas>
    <div class="heip"></div>

    </div>
</div>


<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col" >
    <div class="tm-bg-primary-dark tm-block"style="height: 500px; padding-bottom:15px;">
        <h2 class="tm-block-title">กราฟแสดงจำนวนการโครงการแต่ละอำเภอ</h2>
        <center><canvas id="districtChart" style="width: 100%; height: 350px;"></canvas></center>
    </div>
</div>

<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
    <div class="tm-bg-primary-dark tm-block">
        <h2 class="tm-block-title">กราฟแสดงจำนวนการโครงการแต่ละตำบล</h2>
        <canvas id="subdistrictChart"></canvas>
    </div>
</div>

<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
    <div class="tm-bg-primary-dark tm-block">
        <h2 class="tm-block-title">กราฟแสดงแหล่งงบประมาณ</h2>
        
        <canvas id="arear_moneyChart"></canvas>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
// ✅ ประกาศตัวแปรก่อนใช้งาน
const provinceData = @json($chartProvince);
const provinceLabels = provinceData.map(item => item.province || 'ไม่ระบุจังหวัด');
const provinceCounts = provinceData.map(item => item.total);
const provinceColors = provinceData.map(() => getRandomColor());

const yearData = @json($chartYear);
const yearLabels = yearData.map(item => item.year_money || 'ไม่ระบุปี');
const yearCounts = yearData.map(item => item.total);
const yearColors = yearData.map(() => getRandomColor());

const districtData = @json($chartDistrict);
const districttCounts = districtData.map(item => item.total);
const districtLabelsx = [
  'เมืองชัยภูมิ', 'ภูเขียว', 'จัตุรัส', 'แก้งคร้อ',
  'เกษตรสมบูรณ์', 'หนองบัวแดง', 'คอนสาร', 'บ้านเขว้า',
  'คอนสวรรค์', 'บำเหน็จณรงค์', 'เทพสถิต', 'บ้านแท่น',
  'หนองบัวระเหว', 'ภักดีชุมพล', 'เนินสง่า', 'ซับใหญ่', 'อื่นๆ'
];


const rawData = @json($chartArear_money).map(item => ({
    ...item,
    arear_money: item.arear_money ?? 'ยังไม่ระบุ'
}));

// แยกปีงบประมาณและแหล่งงบประมาณทั้งหมด
const years = Array.from(new Set(rawData.map(item => item.year_money)));
const sources = Array.from(new Set(rawData.map(item => item.arear_money)));

// เตรียม datasets โดยเอาเฉพาะที่มีค่าจริงเท่านั้น (ไม่สร้างแถบที่ไม่มีข้อมูล)
const datasets_arear = sources
    .filter(source => source !== 'ยังไม่ระบุ') // 🔴 กรองทิ้งตรงนี้
    .map(source => {
        const dataForSource = years.map(year => {
            const match = rawData.find(item => item.year_money === year && item.arear_money === source);
            return match ? match.total : null; // ❌ ไม่แสดง 0 เปล่าๆ
        });

        const hasData = dataForSource.some(v => v !== null);
        if (!hasData) return null;

        return {
            label: source,
            data: dataForSource,
            backgroundColor: getRandomColor(0.6),
            borderColor: 'white',
            borderWidth: 1,
            datalabels: {
                anchor: 'end',
                align: 'start',
                color: 'white',
                font: { weight: 'bold' }
            }
        };
    })
    .filter(Boolean); // ✅ ตัด null ออก


const arearCountMap = rawData.reduce((acc, item) => {
    const key = item.arear_money ?? 'ยังไม่ระบุ';
    acc[key] = (acc[key] || 0) + 1;
    return acc;
}, {});
const filteredCounts = Object.entries(arearCountMap)
    .filter(([key]) => key !== 'ยังไม่ระบุ')
    .map(([, count]) => count);

// หาค่า count ที่มากที่สุด และ + 2
const suggestedMax1 = Math.max(...Object.values(arearCountMap), 0) + 1;



function getColorByDistrict(district) {
    const colors = {
        'เมืองชัยภูมิ': 'rgba(255, 99, 132, 0.7)',
        'ภูเขียว': 'rgba(54, 162, 235, 0.7)',
        'จัตุรัส': 'rgba(255, 206, 86, 0.7)',
        'แก้งคร้อ': 'rgba(75, 192, 192, 0.7)',
        'เกษตรสมบูรณ์': 'rgba(153, 102, 255, 0.7)',
        'หนองบัวแดง': 'rgba(255, 159, 64, 0.7)',
        'คอนสาร': 'rgba(199, 199, 199, 0.7)',
        'บ้านเขว้า': 'rgba(255, 99, 255, 0.7)',
        'คอนสวรรค์': 'rgba(100, 255, 218, 0.7)',
        'บำเหน็จณรงค์': 'rgba(160, 100, 255, 0.7)',
        'เทพสถิต': 'rgba(255, 205, 86, 0.7)',
        'บ้านแท่น': 'rgba(54, 162, 100, 0.7)',
        'หนองบัวระเหว': 'rgba(255, 99, 71, 0.7)',
        'ภักดีชุมพล': 'rgba(135, 206, 250, 0.7)',
        'เนินสง่า': 'rgba(210, 180, 140, 0.7)',
        'ซับใหญ่': 'rgba(0, 191, 255, 0.7)',
        'อื่นๆ': 'rgba(169, 169, 169, 0.7)'
    };
    return colors[district] || 'rgba(200, 200, 200, 0.7)';
}

let scatterPoints = [];
districtData.forEach(item => {
    const count = item.total || 0;
    const label = item.district || 'อื่นๆ';
    const color = getColorByDistrict(label);

    for (let i = 0; i < count; i++) {
        scatterPoints.push({
            x: label,
            y: Math.random() * 10, // ✅ สุ่มค่า y ระหว่าง 0–10 (กระจายแบบไม่มีแพทเทิร์น)
            backgroundColor: color
        });
    }
});

const subdistrictData = @json($chartSubdistrict);
const subdistrictLabels = subdistrictData.map(item => item.subdistrict || 'ยังไม่ระบุตำบล');
const subdistrictCounts = subdistrictData.map(item => item.total);
const subdistrictColors = subdistrictData.map(() => getRandomColor());

// ✅ ฟังก์ชันสุ่มสี
function getRandomColor(opacity = 0.6) {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    return `rgba(${r}, ${g}, ${b}, ${opacity})`;
}
// ✅ กราฟจังหวัด
const datasets = provinceLabels.map((province, i) => ({
    label: province,
    data: [provinceCounts[i]], // ✅ ใส่ข้อมูลใน array เดียวเพราะแต่ละ dataset = 1 จังหวัด
    backgroundColor: provinceColors[i],
    borderColor: 'rgba(255, 255, 255, 0.8)',
    borderWidth: 1
}));

const subdatasetsdistrict = subdistrictLabels.map((subdistrict, i) => ({
    label: subdistrict,
    data: [subdistrictCounts[i]],
    backgroundColor: subdistrictColors[i],
    borderColor: 'rgba(255, 255, 255, 0.8)',
    borderWidth: 1
}));

new Chart(document.getElementById('districtChart'), {
    type: 'scatter',
    data: {
        datasets: [{
            label: 'โครงการในแต่ละอำเภอ', // ✅ แก้ undefined
            data: scatterPoints,
            parsing: false,
            pointBackgroundColor: scatterPoints.map(p => p.backgroundColor),
            pointBorderColor: 'white',
            pointRadius: 5,
            showLine: false
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: { color: 'white' }
            },
        },
        scales: {
            x: {
                type: 'category',
                labels: districtLabelsx,
                title: {
                    display: true,
                    text: 'อำเภอ',
                    color: 'white'
                },
                ticks: {
                    color: 'white',
                    autoSkip: false,
                    maxRotation: 90,
                    minRotation: 45
                },
                grid: {
                    color: 'rgba(255,255,255,0.5)'
                }
            },
            y: {
                beginAtZero: true,
                suggestedMax: Math.max(...scatterPoints.map(p => p.y)) + 1,
                title: {
                    display: true,
                    text: 'จำนวน (ระดับการกระจุก)',
                    color: 'white'
                },
                ticks: {
                    color: 'white'
                },
                grid: {
                    color: 'rgba(255,255,255,0.5)'
                }
            }
        }
    }
});

new Chart(document.getElementById('subdistrictChart'), {
    type: 'pie',
    data: {
        labels: subdistrictLabels, // ชื่อตำบล
        datasets: [{
            label: 'จำนวนโครงการ',
            data: subdistrictCounts, // จำนวนโครงการในแต่ละตำบล
            backgroundColor: subdistrictColors,
            borderColor: 'white',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    color: 'white'
                }
            },
            title: {
                display: true,
                text: 'สัดส่วนโครงการแต่ละตำบล',
                color: 'white'
            },
            datalabels: {
                color: 'white',
                font: {
                    weight: 'bold',
                    size: 12
                },
                formatter: (value, context) => {
                    const label = context.chart.data.labels[context.dataIndex];
                    return `${label}: ${value}`;
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

new Chart(document.getElementById('arear_moneyChart'), {
    type: 'bar',
    data: {
        labels: years,
        datasets: datasets_arear
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: 'white'
                }
            },
            title: {
                display: true,
                text: 'จำนวนโครงการแยกตามปีและแหล่งงบประมาณ',
                color: 'white'
            },
            datalabels: {
                // default config if not overridden
                color: 'white',
                anchor: 'end',
                align: 'top',
                font: { weight: 'bold' }
            }
        },
        scales: {
            x: {
                ticks: { color: 'white' },
                grid: { color: 'rgba(255,255,255,0.1)' }
            },
            y: {
                suggestedMax: suggestedMax1,
                beginAtZero: true,
                ticks: {
                    color: 'white',
                    stepSize: 1
                },
                grid: { color: 'rgba(255,255,255,0.1)' },
                title: {
                    display: true,
                    text: 'จำนวนโครงการ',
                    color: 'white'
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

new Chart(document.getElementById('provinceChart'), {
    type: 'bar',
    data: {
        labels: ['จำนวนโครงการ'], // ✅ ช่องเดียวในแกน X
        datasets: datasets // ✅ แต่ละจังหวัดเป็น dataset
    },
    options: {
        responsive: true,
        plugins: {
            datalabels: {
                color: 'white',
                anchor: 'center',
                align: 'center',
                font: {
                    weight: 'bold',
                    size: 10
                },
                formatter: (value, context) => {
                    return context.dataset.label; // ✅ ชื่อจังหวัด
                }
            },
            legend: {
                labels: {
                    color: 'white'
                },
                position: 'top'
            },
            title: {
            }
        },
        scales: {
            x: {
                ticks: {
                    color: 'white'
                },
                grid: {
                    color: 'rgba(255,255,255,0.1)'
                }
            },
            y: {
                beginAtZero: true,
                suggestedMax: Math.max(...provinceCounts) + 1,
                ticks: {
                    color: 'white'
                },
                grid: {
                    color: 'rgba(255,255,255,0.1)'
                }
            }
        }
    },
    plugins: [ChartDataLabels] // ✅ ใส่ plugin ตรงนี้ด้วย
});

new Chart(document.getElementById('yearChart'), {
    type: 'doughnut',
    data: {
        labels: yearLabels,
        datasets: [{
            label: 'โครงการ',
            data: yearCounts,
            backgroundColor: yearColors
        }]
    },
    options: {
        cutout: '40%',
        responsive: false,
        plugins: {
            legend: {
                labels: {
                    color: 'white'
                },
                position: 'top'
            },
            title: {
                display: true,
            },
            datalabels: {
                color: 'white',
                formatter: (value, context) => {
                    const label = context.chart.data.labels[context.dataIndex];
                    return `ปี ${label}\n(${value})`; // แสดงชื่อ + ค่า
                },
                font: {
                    weight: 'bold',
                    size: 12
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});
</script>