<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Product Page - Admin HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/updateinform.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/mapcssx.css') }}" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="{{ asset('css/templatemo-style.css') }}">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    #hoverx{
        transition: 0.7s;
    }
    #hoverx:hover{
        color: rgb(0, 0, 0);
    }
</style>

<body id="reportsPage">
    @if(Auth::check() && Auth::user()->name)
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
                    <li class="nav-item" style="width: 100px;">
                        <a class="nav-link active btntop" href="{{route('dashboard')}}" id="activebtn_dashboard">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back
                            <span class="sr-only">(current)</span>
                        </a>
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
    <div class="container mt-5">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row tm-content-row">
            <div id="mapSection" class="fade-move col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col fade-move">
                <div class="tm-bg-primary-dark tm-blockx weh1"
                    style="padding: 20px;margin-top:100px; min-height: 610px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <form action="{{ route('update', $marker->id) }}" method="POST">
                        @csrf

                        <input type="hidden" class="d-none" name="my_name" value="{{ $marker->my_name }}" readonly>
                        <input type="hidden" class="d-none" name="Nactivity" value="{{ $marker->Nactivity }}" readonly>

                        @if(empty($marker->latitude) || empty($marker->longitude))
                        <label for="latitude">Latitude :</label>
                        <input class="input" type="text" id="latitude" name="latitude" oninput="validateDecimal(this)"
                            placeholder="กรอก Latitude เช่น 14.12345">
                        <label for="longitude">Longitude :</label>
                        <input class="input" type="text" id="longitude" name="longitude" oninput="validateDecimal(this)"
                            placeholder="กรอก Longitude เช่น 100.12345">
                        @endif
                        <label>1. ชื่อโครงการ :</label>
                        <label>{{ $marker->Nactivity }}</label>
                        <br>
                        <div class="form-group full-width">
                            <label class="colob">2. ผู้รับผิดชอบโครงการ</label>
                            <div class="marginx">
                                @foreach($marker->person as $personindex => $person)
                                <label class="colob">ผู้รับผิดชอบคนที่ {{ $personindex + 1 }} :</label>
                                <input type="hidden" class="d-none" name="person_id[]" value="{{ $person->id }}"
                                    required>

                                @if(Auth::user()->level === 'admin')
                                <input class="input" type="text" name="name_lastname[]"
                                    value="{{ $person->name_lastname }}">
                                <input class="input" type="text" name="person[]" value="{{ $person->position }}">
                                <a href="#"id="hoverx" class="rbtn" style="text-decoration: none; display: inline-block; width: 150px; text-align: center;"
                                    onclick="deleteperson({{ $person->id }})">ลบ</a>
                                @else
                                <p><strong>ชื่อ:</strong> {{ $person->name_lastname }}</p>
                                <p><strong>ตำแหน่ง:</strong> {{ $person->position }}</p>
                                <input class="d-non" type="hidden" name="name_lastname[]"
                                    value="{{ $person->name_lastname }}">
                                <input class="d-non" type="hidden" name="person[]" value="{{ $person->position }}">
                                @endif
                                @endforeach
                                <div id="personContainer"></div>
                            </div>
                        </div>

                        <button type="button" class="btn-normal"
                            onclick="addPersonInputField()">เพิ่มผู้รับผิดชอบ</button>
                        <br>

                        <!-- ส่วนสำหรับข้อมูลงบประมาณ -->
                        <div class="form-group full-width">
                            <label class="colob">3. งบประมาณที่ได้รับ</label>
                            <div class="marginx">
                                <label class="colob">งบประมาณที่ใช้ :</label>

                                @if(!empty($marker->number) && $marker->number->count() > 0)
                                @foreach($marker->number as $index => $number)
                                <input type="hidden" class="d-none" name="number_id[]" value="{{ $number->id }}"
                                    required>
                                @if(Auth::user()->level === 'admin' || empty($number->batthai))
                                <input class="input" type="number" name="batthai[]" value="{{ $number->batthai }}"
                                    placeholder="กรอกงบประมาณ">
                                @else
                                <input class="input" type="text" name="batthai[]" value="{{ $number->batthai }}"
                                    placeholder="กรอกงบประมาณ">
                                @endif
                                @endforeach
                                @else
                                <input class="input" type="number" name="batthai_two" placeholder="กรอกงบประมาณ">
                                @endif

                                <label class="colob">ปีงบประมาณ :</label>
                                <input class="input" type="text" name="year_money" value="{{ $marker->year_money }}"
                                    placeholder="กรอกปีงบประมาณ">
                            </div>
                        </div>
                        <br>
                        <!-- วัตถุประสงค์หลัก -->
                        <div class="form-group full-width">
                            <label class="colob">4. วัตถุประสงค์หลัก (O)</label>
                            <div class="marginx">
                                @foreach($marker->target as $index => $target)
                                <label class="colob">วัตถุประสงค์ที่ {{ $index + 1 }} :</label>
                                <input type="hidden" class="d-none" name="target_id[]" value="{{ $target->id }}"
                                    required>

                                <input class="input" type="text" name="target[]" value="{{ $target->target }}">
                                <a href="#"id="hoverx" class="rbtn" style="text-decoration: none; display: inline-block; width: 150px; text-align: center;"
                                    onclick="deletetarget({{ $target->id }})">ลบ</a>
                                @endforeach
                                <div id="targetContainer">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-normal"
                            onclick="addInputField('targetContainer', 'วัตถุประสงค์หลัก ที่ ', ['กรอกวัตถุประสงค์หลัก'])">เพิ่มวัตถุประสงค์หลัก(O)</button>
                        <!-- ผลลัพธ์หลัก -->
                        <div class="form-group full-width">
                            <br>
                            <label class="colob">5. ผลลัพธ์หลัก (KR)</label>
                            <div class="marginx">
                                @foreach($marker->result as $index => $result)
                                <label class="colob">ผลลัพธ์ที่ {{ $index + 1 }} :</label>
                                <input type="hidden" class="d-none" name="result_id[]" value="{{ $result->id }}"
                                    required>

                                <input class="input" type="text" name="target_two[]" value="{{ $result->target }}">
                                <a href="#" class="rbtn"id="hoverx" style="text-decoration: none; display: inline-block; width: 150px; text-align: center;"
                                    onclick="deleteresult({{ $result->id }})">ลบ</a>
                                @endforeach
                                <div id="resultContainer">

                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-normal"
                            onclick="addInputField('resultContainer', 'ผลลัพธ์หลัก ที่ ', ['กรอกผลลัพธ์ที่คาดหวัง'])">เพิ่มผลลัพธ์หลัก(KR)</button>
                        <br>

                        <!-- ฟิลด์สำหรับข้อมูลเพิ่มเติม เช่น จังหวัด อำเภอ และกลุ่มเป้าหมาย -->
                        <div class="form-group full-width">
                            <label class="colob">6. พื้นที่และกลุ่มเป้าหมาย </label>
                            <div class="marginx topx">
                                <label class="colob">จังหวัด :</label>

                                <input class="input" type="text" name="province" value="{{$marker->province }}"
                                    placeholder="กรอกจังหวัด">

                                <label class="colob">อำเภอ :</label>

                                <input class="input" type="text" name="district" value="{{$marker->district }}"
                                    placeholder="กรอกอำเภอ">

                                <label class="colob">ตำบล :</label>
                                <input class="input" type="text" name="subdistrict" value="{{$marker->subdistrict }}"
                                    placeholder="กรอกตำบล">
                                <label class="colob">หมู่บ้าน :</label>
                                <input class="input" type="text" name="mauban" value="{{$marker->mauban }}"
                                    placeholder="กรอกหมู่บ้าน">

                                <label class="colob">หมู่ที่ :</label>
                                <input class="input" type="text" name="mautee" value="{{$marker->mautee }}"
                                    placeholder="กรอกหมู่ที่">

                            </div>
                        </div>
                        <br>

                        <!-- ส่วนอื่นๆ เช่น กลุ่มเป้าหมาย ระยะเวลา -->
                        <div class="form-group full-width">
                            <label class="colob">กลุ่มเป้าหมาย</label>
                            <div class="date-group">
                                <div>
                                    <label class="colob">กลุ่มเป้าหมายภายใน :</label>
                                    <input class="input" type="text" name="number_target"
                                        value="{{$marker->number_target }}" placeholder="กรอกกลุ่มเป้าหมายภายใน">

                                </div>
                                <div>
                                    <label class="colob">กลุ่มเป้าหมายภายนอก :</label>
                                    <input class="input" type="text" name="number_target_out"
                                        value="{{$marker->number_target_out }}" placeholder="กรอกกลุ่มเป้าหมายภายนอก">

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group full-width">
                            <label class="colob">ระยะเวลาในการทำโครงการ / กิจกรรม</label>
                            <div class="date-group">
                                <div>
                                    <label for="time_pj" class="colob">วันที่เริ่มต้น</label>
                                    <input class="input" type="date" id="time_pj" value="{{$marker->time_pj}}"
                                        name="time_pj">

                                </div>
                                <div>
                                    <label for="time_pj_end" class="colob">วันที่สิ้นสุด</label>
                                    <input class="input" type="date" id="time_pj_end" value="{{$marker->time_pj_end}}"
                                        name="time_pj_end">

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group full-width">
                            <label class="colob">7. สรุปผลการดำเนินงาน</label>
                            <div class="marginx">
                                <label class="colob">7.1 สรุปผลการดำเนินงานในภาพรวม :</label>
                                <textarea class="textarea" name="performancex"
                                    placeholder="การจัดโครงการนี้...">{{$marker->performancex}}</textarea>

                                <label class="colob">7.2 รายละเอียดผลการดำเนินงานรายกิจกรรม :</label>
                                @foreach($marker->activity as $index => $activity)

                                <label class="colob">ชื่อกิจกรรมที่ {{ $index + 1 }} :</label>
                                <input class="d-none" type="hidden" name="activity_id[]" value="{{ $activity->id }}"
                                    required>

                                <input class="input" type="text" name="name_activity[]"
                                    value="{{ $activity->name_activity }}" required>

                                <label class="colob">ผู้รับผิดชอบกิจกรรมที่ {{ $index + 1 }} :</label>
                                <input class="input" type="text" name="person_pj[]" value="{{ $activity->person_pj }}">

                                <label class="colob">ผลลัพธ์ที่ {{ $index + 1 }} :</label>
                                <input class="input" type="text" name="resultx[]" value="{{ $activity->resultx }}">
                                <a href="#" class="rbtn"id="hoverx" style="text-decoration: none; display: inline-block; width: 150px; text-align: center;"
                                    onclick="deleteactivity({{ $activity->id }})">ลบ</a>

                                @endforeach
                                <div id="activityContainer"></div>
                            </div>
                        </div>
                        <button type="button" class="btn-normal" onclick="addActivityInputField()">เพิ่มกิจกรรม</button>

                        <!-- ใส่ 7.3-->
                        <table border="1" class="full-width">
                            <thead>
                                <tr>
                                    <th class="cx" style="text-align: center; vertical-align: middle; width:300px;"
                                        rowspan="2">ผลลัพธ์หลัก</th>
                                    <th colspan="2">เป้าหมาย</th>
                                    <th colspan="2">ผลการดำเนินงาน</th>
                                    <th class="cx" style="text-align: center; vertical-align: middle;" rowspan="2">
                                        จัดการ</th>
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
                                <input type="hidden" class="d-none" name="main_target_id[]" value="{{$maintarget->id}}">
                                <tr>
                                    <td><textarea type="text" class="text_intable"
                                            name="result_main[]">{{$maintarget->result_main}}</textarea></td>
                                    <td><input type="text" class="input_intable" name="goal_unit[]"
                                            value="{{$maintarget->goal_unit}}"></td>
                                    <td><input type="number" class="input_intable" name="goal_amount[]"
                                            value="{{$maintarget->goal_amount}}"></td>
                                    <td><input type="text" class="input_intable" name="performance_unit[]"
                                            value="{{$maintarget->performance_unit}}"></td>
                                    <td><input type="number" class="input_intable" name="performance_amount[]"
                                            value="{{$maintarget->performance_amount}}"></td>

                                    <td>
                                        <a href="#"id="hoverx" style="text-decoration: none; display: inline-block; width: 150px; text-align: center;" class="rbtn"
                                            onclick="deleteRow({{ $maintarget->id }})">ลบ</a>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                            <div id="maintargetContainer">
                                <!-- รายการใหม่จะถูกเพิ่มที่นี่ -->
                            </div>
                        </table>
                        <button type="button" class="btn-normal" onclick="addRow()">เพิ่มแถว</button>
                        <br>
                        <div class="form-group full-width">
                            <label class="colob">8. ประโยชน์ที่ได้รับ/การประยุกต์ใช้กับหน่วยงาน</label>
                            <div class="marginx">
                                @foreach($marker->benefit as $index => $benefit)
                                <label class="colob">ประโยชน์ที่ได้รับที่ {{ $index + 1 }} :</label>

                                <input type="hidden" class="d-none" name="benefit_id[]" value="{{ $benefit->id }}"
                                    required>
                                <input class="input" type="text" name="benefit[]" value="{{ $benefit->benefit }}">
                                <a href="#"id="hoverx" style="text-decoration: none; display: inline-block; width: 150px; text-align: center;" class="rbtn"
                                    onclick="deletebenefit({{ $benefit->id }})">ลบ</a>

                                @endforeach
                                <div id="benefitContainer"></div>
                            </div>
                            <button type="button" class="btn-normal"
                                onclick="addInputField('benefitContainer', 'ประโยชน์ที่ได้รับ ', ['กรอกประโยชน์ที่ได้รับ'])">เพิ่มประโยชน์ที่ได้รับ</button>
                            <div class="marginx">

                                <label class="colob">การประยุกต์ใช้กับหน่วยงาน :</label>
                                <textarea class="textarea" name="applied">{{$marker->applied}}</textarea>

                            </div>

                        </div>
                        <!-- ปัญหาและข้อเสนอแนะ -->
                        <label class="colob">9. ปัญหาและอุปสรรค</label>
                        <textarea class="textarea" name="description">{{ $marker->description }}</textarea>

                        <label class="colob">10. ข้อเสนอแนะ</label>
                        <textarea class="textarea" name="suggestions">{{$marker->suggestions }}</textarea>

                        <div class="form-group full-width">
                            <button type="submit" class="btnsss">บันทึก</button>
                            <a href="{{route('dashboard')}}"id="hoverx" style="text-decoration: none;" class="mybtn"><i
                                    class="fa-solid fa-arrow-left"></i>ย้อนกลับ</a>
                        </div>
                    </form>
                    <form id="delete-form" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

    </div>
    @else
    <div class="login-alert">
        <h2>กรุณาเข้าสู่ระบบ</h2>
        <a href="{{route('login')}}"id="hoverx" style="text-decoration: none;" class="btn btn-primary">Go To Login</a>
    </div>
    @endif
    <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
            <p class="text-center text-white mb-0 px-4 small">
                Copyright &copy; <b>2018</b> All rights reserved.

                Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
            </p>
        </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll(".d-none"); // เลือกทุก input ที่ต้องป้องกัน

        inputs.forEach(input => {
            input.addEventListener("input", function() {
                input.value = input.defaultValue; // บังคับค่ากลับมาเป็นค่าเดิม
            });
        });
    });

    function validateDecimal(input) {
        const regex = /^-?\d+(\.\d{0,})?$/;
        if (!regex.test(input.value)) {
            input.setCustomValidity('กรุณากรอกข้อมูลให้ถูกต้อง');
        } else if (input.value.includes('.')) {
            const decimalPlaces = input.value.split('.')[1]?.length || 0;
            if (decimalPlaces < 5) {
                input.setCustomValidity('ต้องกรอกทศนิยมอย่างน้อย 5 ตำแหน่ง');
            } else {
                input.setCustomValidity('');
            }
        } else {
            input.setCustomValidity('ต้องมีจุดทศนิยม');
        }
    }

    function addInputField(containerId, labelPrefix, placeholders) {
        const inputContainer = document.getElementById(containerId);
        if (!inputContainer) {
            console.error("ไม่พบ container:", containerId);
            return;
        }

        const inputCount = inputContainer.children.length + 1;

        const newInput = document.createElement("div");
        newInput.classList.add("input-group");

        let inputHTML = `<br><label class="colob">${labelPrefix} ใหม่ ${inputCount} :</label>`;
        placeholders.forEach(placeholder => {
            inputHTML +=
                `<input class="input" type="text" name="${containerId}[]" placeholder="${placeholder}" required>`;
        });

        inputHTML +=
            `<button type="button"id="hoverx" class="rbtn"style="text-decoration: none;" onclick="removeInputField(this)">ลบ</button>`;
        newInput.innerHTML = inputHTML;
        inputContainer.appendChild(newInput);
    }


    function addActivityInputField() {
        const inputContainer = document.getElementById('activityContainer');
        const inputCount = inputContainer.children.length + 1; // นับจำนวน input ที่มีอยู่แล้ว

        const newInput = document.createElement("div");
        newInput.classList.add("input-group");

        let inputHTML = `<label class="colob">ผู้รับผิดชอบกิจกรรมคนใหม่ ${inputCount} :</label>`;

        inputHTML +=
            `<input class="input" type="text" name="activityContainer[${inputCount}][]" placeholder="กรอกชื่อกิจกรรม" required>`;
        inputHTML +=
            `<input class="input" type="text" name="activityContainer[${inputCount}][]" placeholder="กรอกชื่อผู้รับผิดชอบ" required>`;
        inputHTML +=
            `<input class="input" type="text" name="activityContainer[${inputCount}][]" placeholder="ผลลัพธ์" required>`;


        inputHTML +=
            `<button type="button"id="hoverx" class="rbtn"style="text-decoration: none;" onclick="removeInputField(this)">ลบ</button>`;

        newInput.innerHTML = inputHTML;
        inputContainer.appendChild(newInput);
    }



    function addPersonInputField() {
        const inputContainer = document.getElementById('personContainer');
        const inputCount = inputContainer.children.length + 1;

        const newInput = document.createElement("div");
        newInput.classList.add("input-group");

        let inputHTML = `
            <label class="colob">ผู้รับผิดชอบเพิ่มใหม่คนที่ ${inputCount} :</label>
            <input class="input" type="text" name="personContainer[${inputCount}][name]" placeholder="กรอกชื่อ-สกุล" required>
            <input class="input" type="text" name="personContainer[${inputCount}][position]" placeholder="กรอกตำแหน่ง" required>
            <button type="button"id="hoverx" class="rbtn"style="text-decoration: none;" onclick="removeInputField(this)">ลบ</button>
        `;

        newInput.innerHTML = inputHTML;
        inputContainer.appendChild(newInput);
    }


    function removeInputField(button) {
        button.parentElement.remove();
    }

    function addRow() {
        let table = document.querySelector("table tbody");
        let newRow = document.createElement("tr");

        newRow.innerHTML = `
            <td><textarea type="text" class="text_intable" name="result_main_new[]" required></textarea></td>
            <td><input class="input_intable" type="text" name="goal_unit_new[]" required></td>
            <td><input class="input_intable" type="number" name="goal_amount_new[]" required></td>
            <td><input class="input_intable" type="text" name="performance_unit_new[]" required></td>
            <td><input class="input_intable" type="number" name="performance_amount_new[]" required></td>
            <td>  <button type="button"id="hoverx" class="btn btn-danger" style="color: rgb(255,255,255); background-color: rgb(176, 7, 7); padding: 10px;"onclick="removeRow(this)">ลบ</button></td>
        `;

        table.appendChild(newRow);
    }

    function removeRow(button) {
        let row = button.closest("tr"); // หาแถวที่ปุ่มนั้นอยู่
        if (row) {
            row.remove();
        }
    }

    function deleteRow(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'ข้อมูลนี้จะถูกลบและไม่สามารถกู้คืนได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('delete-form');
                form.action = `/delrow/${id}`; // เปลี่ยนค่า action
                form.submit();
            }
        });
    }

    function deleteperson(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'ข้อมูลนี้จะถูกลบและไม่สามารถกู้คืนได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('delete-form');
                form.action = `/deleteperson/${id}`; // เปลี่ยนค่า action
                form.submit();
            }
        });
    }

    function deletenumber(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'ข้อมูลนี้จะถูกลบและไม่สามารถกู้คืนได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('delete-form');
                form.action = `/deletenumber/${id}`; // เปลี่ยนค่า action
                form.submit();
            }
        });
    }

    function deletetarget(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'ข้อมูลนี้จะถูกลบและไม่สามารถกู้คืนได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('delete-form');
                form.action = `/deletetarget/${id}`; // เปลี่ยนค่า action
                form.submit();
            }
        });
    }

    function deleteresult(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'ข้อมูลนี้จะถูกลบและไม่สามารถกู้คืนได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('delete-form');
                form.action = `/deleteresult/${id}`; // เปลี่ยนค่า action
                form.submit();
            }
        });
    }

    function deleteactivity(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'ข้อมูลนี้จะถูกลบและไม่สามารถกู้คืนได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('delete-form');
                form.action = `/deleteactivity/${id}`; // เปลี่ยนค่า action
                form.submit();
            }
        });
    }

    function deletebenefit(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'ข้อมูลนี้จะถูกลบและไม่สามารถกู้คืนได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('delete-form');
                form.action = `/deletebenefit/${id}`; // เปลี่ยนค่า action
                form.submit();
            }
        });
    }
    </script>
</body>

</html>