<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <style>
    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: normal;
        src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: bold;
        src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: normal;
        src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: bold;
        src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
    }

    body {
        font-size: 16pt;
        font-family: "THSarabunNew";
        line-height: 0.2;

        padding: 0;
    }

    .herder .font18 {
        font-size: 18pt;
        font-family: "THSarabunNew";
        line-height: 1;
        /* ลดระยะห่างระหว่างบรรทัด */
        margin: 0;
        /* ลบ margin บน-ล่าง */
        padding: 0;
        /* ลบ padding ถ้ามี */
        text-align: center;
        /* ใช้แทน <center> */
    }

    .herder p {
        text-align: center;
    }

    .marginlem {
        margin-left: 1cm;
        padding: 0;
        margin-top: 0;
        margin-bottom: 0;

    }

    .no-margin {
        margin-bottom: 0;
    }

    .person-container {
        position: absolute;
        margin-top: -1.25cm;
    }

    .person-entry {
        font-family: "THSarabunNew";
        line-height: 0.9;
        margin-left: 5cm;
        padding: 0;
    }

    .wrap-text {
        display: inline-block;
        max-width: 100%;
        /* หรือกำหนดค่าที่ต้องการ */
        word-wrap: break-word;
        white-space: normal;
    }

    .font11 {
        font-size: 11pt;
    }
    .full-width {
            width: 100%;
            border-collapse: collapse; /* ทำให้เส้นขอบตารางเป็นเส้นเดียว */
        }

        .full-width th, .full-width td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center; /* จัดข้อความให้อยู่กลางแนวนอน */
            vertical-align: middle; /* จัดข้อความให้อยู่กลางแนวตั้ง */
        }

        /* การตั้งค่าการพิมพ์ให้เหมาะสมกับ PDF */
        @media print {
            table {
                width: 100%; /* ทำให้ตารางยืดตามขนาดกระดาษ */
                border-collapse: collapse; /* เส้นขอบเดียว */
            }

            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
                vertical-align: middle; /* จัดข้อความให้อยู่กลางในทุกทิศทาง */
            }

            /* ป้องกันไม่ให้แถวตัดออกจากหน้ากระดาษ */
            tbody tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <br>
    <div class="herder">
        <p class="font18"><strong>แบบรายงานผลการดำเนินงานความสำเร็จ Objective and Key Results (OKRs)</strong></p>
        <p class=""><strong>ระดับยุทธศาสตร์และแผนปฏิบัติราชการประจำปีงบประมาณ พ.ศ.
                {{ $marker->year_money ?? '-' }}</strong></p>
        <p class=""><strong>มหาวิทยาลัยราชภัฏชัยภูมิ</strong></p>
        <p class=""><strong>****************************</strong></p>
    </div>
    <div class="marginlem">
        <p class="wrap-text" style="margin-bottom: -0.5cm;line-height: 0.9; "><strong>1. ชื่อโครงการ
            </strong>{{ $marker->Nactivity ?? '-' }}</p>
        <p><strong>2. ผู้รับผิดชอบโครงการ</strong>
            @if ($marker->person && $marker->person->count())
            @foreach ($marker->person as $index => $p)
            @if ($index == 0)
            <!-- เงื่อนไขนี้ใช้สำหรับลูปแรก -->
            <span class="person-entry" style="margin-left: 1.1cm">
                <!-- กำหนด margin-left เฉพาะ loop แรก -->
                {{ $index + 1 }}. {{ $p->name_lastname }}
            </span><br>
            <span class="person-entry">ตำแหน่ง {{ $p->position }}</span><br>
            @else
            <span class="person-entry">
                {{ $index + 1 }}. {{ $p->name_lastname }}
            </span><br>
            <span class="person-entry">ตำแหน่ง {{ $p->position }}</span><br>
            @endif
            @endforeach
            @else
        <p>-</p>
        @endif
        </p>

        <p style="margin-bottom: -0.5cm;"><strong>3. งบประมาณที่ได้รับ..งบประมาณ............จำนวน</strong>
            @foreach($marker->number as $index => $number)
            {{ number_format($number->batthai) }} บาท
            @endforeach
        </p>

        <p style="line-height: 0.9; margin-bottom: 0; padding-bottom: 0;">
            <strong>4. วัตถุประสงค์หลัก (O)</strong>
        </p>
        @foreach($marker->target as $index => $target)
        <span class="wrap-text marginlem"
            style="line-height: 0.9; display: inline;">4.{{$index + 1}}&nbsp;{{ $target->target }}</span><br>
        @endforeach

        <p style="line-height: 0.9; margin-bottom: 0; padding-top: 0; margin-top: 0;">
            <strong>5. ผลลัพธ์หลัก (KR)</strong>
        </p>
        @foreach($marker->result as $index => $result)
        <span class="wrap-text marginlem"
            style="line-height: 0.9; display: inline;">5.{{$index + 1}}&nbsp;{{ $result->target }}</span><br>
        @endforeach

        <p style="line-height: 0.9; margin-bottom: 0; padding-top: 0; margin-top: 0;">
            <strong>6. พื้นที่/กลุ่มเป้าหมาย</strong>
        <p class="marginlem"style="line-height: 0.9; margin-bottom: 0; padding-top: 0; margin-top: 0;">6.1 พื้นที่เป้าหมาย</p>
        <span class="wrap-text marginlem" style="line-height: 0.9; display: inline;">
        @if(!empty($marker->mauban))ชื่อหมู่บ้าน {{ $marker->mauban }} @endif @if(!empty($marker->mautee))หมู่ที่ {{ $marker->mautee }}@endif
        ตำบล{{ $marker->subdistrict }} อำเภอ{{ $marker->district }} ตำบล{{ $marker->province }}
            </span><br>

            <!--<span class="wrap-text marginlem" style="line-height: 0.9; display: inline;">
            จังหวัด{{ $marker->province }} อำเภอ{{ $marker->district }} ตำบล{{ $marker->subdistrict }}
            @if(!empty($marker->mauban))ชื่อหมู่บ้าน{{ $marker->mauban }} @endif
            @if(!empty($marker->mautee))หมู่ที่{{ $marker->mautee }}@endif</span> -->

        <p class="marginlem"style="line-height: 0.9; margin-bottom: 0; padding-top: 0; margin-top: 0;">6.2 กลุ่มเป้าหมาย</p>
        @if(!empty($marker->number_target))
        <span class="wrap-text marginlem" style="line-height: 0.9;margin:left: 2cm; display: inline;">- กลุ่มเป้าหมายภายใน {{ $marker->number_target }}
        </span><br>
        @else
        
        @endif

        @if(!empty($marker->number_target_out))
        <span class="wrap-text marginlem" style="line-height: 0.9;margin:left: 2cm; display: inline;">- กลุ่มเป้าหมายภายนอก {{ $marker->number_target_out }}
        </span>
        @else
        <br>
        @endif
        </p>

        <p style="line-height: 0.9; margin-bottom: 0; padding-top: 0; margin-top: 0;">
            <strong>7. ผลการดำเนินงาน</strong>
        </p>

        <div class="marginlem" style="line-height: 0.9;">
            <strong>7.1 สรุปผลการดำเนินงานในภาพรวม</strong>
        </div>
        <div style="max-width: 100%; word-wrap: break-word; overflow-wrap: break-word;">
            <p style="line-height: 0.9; margin: 0;">
                <span class="wrap-text"
                    style="display: block; text-indent: 2.5em; max-width: 100%; overflow-wrap: break-word; word-wrap: break-word; white-space: normal; word-break: break-word; hyphens: auto;">
                    {{ $marker->performancex }}
                </span>
            </p>
        </div>

        <div class="marginlem" style="line-height: 0.9;">
            <strong>7.2 รายละเอียดผลการดำเนินงานรายกิจกรรม</strong>
        </div>
        <br>

        <!-- กำหนดให้ขึ้นหน้าใหม่ในกรณีที่ใกล้หมดหน้า -->
        <div class="page-break">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000; padding: 10px; text-align: center; width: 35%;">กิจกรรม</th>
                        <th style="border: 1px solid #000; padding: 10px; text-align: center; width: 65%;">ผลดำเนินงาน
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marker->activity as $index => $activity)
                    <tr>
                        <td style="border: 1px solid #000;padding:20px; vertical-align: top;line-height: 0.9;text-align: left">
                            {{$activity->name_activity}}</td>
                        <td style="border: 1px solid #000;padding:20px; vertical-align: top;line-height: 0.9;text-align: left">{{$activity->resultx}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>

        <p class="font11" style="margin-bottom: 0;"><strong>*หมายเหตุ</strong> เอกสารประกอบผลการดำเนินงาน</p>
        <p class="marginlem font11" style="line-height: 0.9;">1.บันทึกรายงานผลการดำเนินงานโครงการ</p>
        <p class="marginlem font11" style="line-height: 0.9;">2.จัดทำ One Page 1 ฉบับ </p>
        <p class="marginlem font11" style="line-height: 0.9;">3. กรณีเดินทางไปราชการ (อบรม/สัมมนา/นำเสนองานวิจัย ฯลฯ
            )ให้รายงานผลการเข้าร่วมกิจกรรมทุกครั้งหลังจากกลับเข้าปฏิบัติงานทุกครั้ง</p>
        <div class="marginlem" style="line-height: 0.9;">
            <p><strong>7.3 ผลการดำเนินงานตามเป้าหมาย</strong></p>
        </div>
        <table border="1" class="full-width">
            <thead>
                <tr>
                    <th class="cx" rowspan="2">ผลลัพธ์หลัก</th>
                    <th colspan="2">เป้าหมาย</th>
                    <th colspan="2">ผลการดำเนินงาน</th>
                </tr>
                <tr>
                    <th>หน่วยนับ</th>
                    <th>จำนวน</th>
                    <th>หน่วยนับ</th>
                    <th>จำนวน</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marker->maintarget as $index => $maintarget)
                <tr>
                    <td class="text-left" style="border: 1px solid #000;padding:20px; vertical-align: top;line-height: 0.9;text-align: left">
                        {{$maintarget->result_main}}</td>
                        <td style="border: 1px solid #000;padding:20px; vertical-align: top;line-height: 0.9;">{{$maintarget->goal_unit}}</td>
                        <td style="border: 1px solid #000;padding:20px; vertical-align: top;line-height: 0.9;">{{$maintarget->goal_amount}}</td>
                        <td style="border: 1px solid #000;padding:20px; vertical-align: top;line-height: 0.9;">{{$maintarget->performance_unit}}</td>
                        <td style="border: 1px solid #000;padding:20px; vertical-align: top;line-height: 0.9;">{{$maintarget->performance_amount}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br style="line-height: 0.5;">
            <strong style="line-height: 0.9;">8. ประโยชน์ที่ได้รับ/การประยุกต์ใช้กับหน่วยงาน</strong>
            <p class="marginlem"style="line-height: 0.9;">8.1 ประโยชน์ที่ได้รับ</p>
            @foreach($marker->benefit as $index => $benefit)
            <p class="marginlem "style="line-height: 0.9; margin-left: 3.5em;">8.1.{{$index + 1}} {{$benefit->benefit}}</p>
            @endforeach
            <p class="marginlem"style="line-height: 0.9;">8.2 การประยุกต์ใช้กับหน่วยงาน</p>
        <div style="max-width: 100%; word-wrap: break-word; overflow-wrap: break-word;">
            <p style="line-height: 0.9; margin: 0;">
                <span class="wrap-text marginlem"
                    style="display: block; text-indent: 2em; max-width: 100%; overflow-wrap: break-word; word-wrap: break-word; white-space: normal; word-break: break-word; hyphens: auto;">
                    {{ $marker->applied }}
                </span>
            </p>
        </div>
        <strong style="line-height: 0.9;">9. ปัญหา อุปสรรค และข้อเสนอแนะ</strong>
        <p class="marginlem"style="line-height: 0.9;">9.1 ปัญหาและอุปสรรค</p>

        <div style="max-width: 100%; word-wrap: break-word; overflow-wrap: break-word;">
            <p style="line-height: 0.9; margin: 0;">
                <span class="wrap-text"
                    style="display: block; text-indent: 2.5em; max-width: 100%; overflow-wrap: break-word; word-wrap: break-word; white-space: normal; word-break: break-word; hyphens: auto;">
                    {{ $marker->description }}
                </span>
            </p>
        </div>
        <p class="marginlem"style="line-height: 0.9;">9.2 ข้อเสนอแนะ</p>
        <div style="max-width: 100%; word-wrap: break-word; overflow-wrap: break-word;">
            <p style="line-height: 0.9; margin: 0;">
                <span class="wrap-text"
                    style="display: block; text-indent: 2.5em; max-width: 100%; overflow-wrap: break-word; word-wrap: break-word; white-space: normal; word-break: break-word; hyphens: auto;">
                    {{ $marker->suggestions }}
                </span>
            </p>
        </div>

        <strong style="line-height: 0.9;">10. รูปภาพกิจกรรม</strong>
        <table style="width: 100%; border-collapse: collapse;">
    @foreach(array_chunk($images, 2) as $row)
    <tr>
        @foreach($row as $image)
        <td style=" text-align: center; width: 50%;">
            @php
                $path = public_path('storage/images/' . $image);
                if (file_exists($path)) {
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                } else {
                    $base64 = null;
                }
            @endphp
            @if($base64)
                <img src="{{ $base64 }}" style="width: 100%; max-width: 250px; height: auto;">
            @else
                <p>ไม่พบรูป</p>
            @endif
        </td>
        @endforeach
        {{-- ถ้ามีแค่ 1 รูปในแถว ให้เติมคอลัมน์เปล่า --}}
        @if(count($row) == 1)
        <td style=" text-align: center; width: 50%;"></td>
        @endif
    </tr>
    @endforeach
</table>

        

    </div>


    <script>
    function checkPageBreak() {
        var contentHeight = document.getElementById("content").offsetHeight;
        var pageHeight = window.innerHeight; // ความสูงของหน้าจอที่สามารถแสดงได้ในหน้ากระดาษ

        // หารือประมาณการพื้นที่ที่เหลือบนหน้ากระดาษ
        var remainingSpace = pageHeight - contentHeight;

        // ถ้าพื้นที่เหลือเพียงพอสำหรับประมาณ 4 บรรทัด (หรือระยะห่างที่ต้องการ)
        if (remainingSpace < 100) { // ปรับค่า 100 ให้เป็นจำนวนที่เหมาะสม
            var pageBreakDiv = document.createElement("div");
            pageBreakDiv.classList.add("page-break");
            document.body.appendChild(pageBreakDiv); // สร้างหน้าใหม่
        }
    }

    // เรียกใช้ฟังก์ชั่นนี้เมื่อเริ่มโหลดเนื้อหา
    checkPageBreak();
    </script>

</body>

</html>