<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลหมุด</title>
    <link rel="stylesheet" href="../css/gb.css" />
    <link rel="stylesheet" href="../css/scroobar.css">
    <link rel="stylesheet" href="../css/addmarker.css" />
    <link rel="icon" href="{{ asset('img/iconx2.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
a {
    text-decoration: none;
}


.d-none{
    display:none;
}
.alert {
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
}
.alert-success {
    background-color:rgb(166, 110, 6);
    color:rgb(248, 248, 248);
    border: 1px solidrgb(177, 137, 8);
}
.buttonx {
    display: flex;
    width: 100%;
    gap: 10px;
}

.buttonx button {
    flex: 1;
    padding: 7px 0;
    font-size: 14px;
    width: 100%;
}

</style>

<body>
    @if(Auth::check() && Auth::user()->name)
    <div class="content">
        <h2>เพิ่มข้อมูล</h2><br>
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form action="{{ route('Sentsave') }}" method="POST">
            @csrf

            <label for="latitude">Latitude :</label>
            <input class="input"type="text"class="d-none" id="latitude" name="latitude" >

            <label for="longitude">Longitude :</label>
            <input class="input"type="text"class="d-none" id="longitude" name="longitude" >

            <label>1. ชื่อโครงการ :</label>
            <input class="input"type="text" name="Nactivity" placeholder="กรอกชื่อโครงการ" >

            <br>
            <div class="form-group full-width">
                <label>2. ผู้รับผิดชอบโครงการ</label>

                <div class="marginx">
                    <div id="personContainer"></div>
                </div>
            </div>
            <div class="buttonx">
                <button type="button" id="addPersonBtn" style="background-color:rgba(51, 100, 4, 0.94); display: none;" onclick="addPersonInputField()">เพิ่มผู้รับผิดชอบ</button>
                <button type="button" class="btncolor" onclick="sentPersonInputField()">เลือกผู้รับผิดชอบ</button>
            </div>

            <br>
            <div class="form-group full-width">
                <label>3. งบประมาณที่ได้รับ</label>
                <div class="marginx">
                    <label>งบประมาณที่ใช้ :</label>
                    <input class="input" type="number" name="batthai" placeholder="กรอกงบประมาณ" >

                    <label>ปีงบประมาณ :</label>
                    <input class="input"type="text" name="year_money" placeholder="กรอกปีงบประมาณ" >

                    <label>แหล่งงบประมาณ :</label>
                    <input class="input"type="text" name="arear_money" placeholder="กรอกแหล่งงบประมาณ" >
                </div>
            </div>
            <br>
            <div class="form-group full-width">
                <label>4. วัตถุประสงค์หลัก (O)</label>
                <div class="marginx">
                    <div id="targetContainer"></div>
                </div>
            </div>
            <button type="button" onclick="addInputField('targetContainer', 'วัตถุประสงค์หลัก ที่ ', ['กรอกวัตถุประสงค์หลัก'])">เพิ่มวัตถุประสงค์หลัก(O)</button>
            <br>
            <div class="form-group full-width">
                <label>5. ผลลัพธ์หลัก (KR)</label>
                <div class="marginx">
                    <div id="resultContainer"></div>
                </div>
            </div>
            <button type="button" onclick="addInputField('resultContainer', 'ผลลัพธ์หลัก ที่ ', ['กรอกผลลัพธ์ที่คาดหวัง'])">เพิ่มผลลัพธ์หลัก(KR)</button>
            <br>
            <div class="form-group full-width">
                <label>6. พื้นที่และกลุ่มเป้าหมาย </label>
                <div class="marginx topx">
                    <label>จังหวัด :</label>
                    <input class="input"type="text" name="province" placeholder="กรอกจังหวัด" >

                    <label>อำเภอ :</label>
                    <input class="input"type="text" name="district" placeholder="กรอกอำเภอ" >

                    <label>ตำบล :</label>
                    <input class="input"type="text" name="subdistrict" placeholder="กรอกตำบล" >

                    <label>ชื่อหมู่บ้าน :</label>
                    <input class="input"type="text" name="mauban" placeholder="กรอกหมู่บ้าน" >

                    <label>หมู่ที่ :</label>
                    <input class="input"type="text" name="mautee" placeholder="กรอกหมู่ที่" >
                </div>
            </div>
            <br>
            <div class="form-group full-width">
                <label>กลุ่มเป้าหมาย</label>
                <div class="date-group">
                    <div>
                        <label>กลุ่มเป้าหมายภายใน :</label>
                        <input class="input"type="text" name="number_target" placeholder="กรอกกลุ่มเป้าหมายภายใน" >
                    </div>
                    <div>
                        <label>กลุ่มเป้าหมายภายนอก :</label>
                        <input class="input"type="text" name="number_target_out" placeholder="กรอกกลุ่มเป้าหมายภายนอก" >
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group full-width">
                <label>ระยะเวลาในการทำโครงการ / กิจกรรม</label>
                <div class="date-group">
                    <div>
                        <label for="time_pj">วันที่เริ่มต้น</label>
                        <input class="input"type="date" id="time_pj" name="time_pj" >
                    </div>
                    <div>
                        <label for="time_pj_end">วันที่สิ้นสุด</label>
                        <input class="input"type="date" id="time_pj_end" name="time_pj_end" >
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group full-width">
                <label>7. สรุปผลการดำเนินงาน</label>
                <div class="marginx">
                    <label>7.1 สรุปผลการดำเนินงานในภาพรวม :</label>
                    <textarea class="textarea"name="performancex" placeholder="การจัดโครงการนี้..."></textarea>
                    <label>7.2 รายละเอียดผลการดำเนินงานรายกิจกรรม :</label>
                    <div id="activityContainer"></div>
                </div>
            </div>
            <button type="button" onclick="addActivityInputField()">เพิ่มกิจกรรม</button>

            <!-- ใส่ 7.3-->
            <table border="1"class="full-width">
                <thead>
                <tr>
                    <th class="cx"rowspan="2">ผลลัพธ์หลัก</th> 
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
                    <tr>
                    <td><textarea type="text"class="text_intable" name="result_main[]" ></textarea></td>
                    <td><input type="text"class="input_intable" name="goal_unit[]" ></td>
                        <td><input type="number"class="input_intable" name="goal_amount[]" ></td>
                        <td><input type="text"class="input_intable" name="performance_unit[]" ></td>
                        <td><input type="number"class="input_intable" name="performance_amount[]" ></td>
                    </tr>
                    
                </tbody>
            </table>
            <button type="button" onclick="addRow()">เพิ่มแถว</button>

            <br>
            <div class="form-group full-width">
                <label>8. ประโยชน์ที่ได้รับ/การประยุกต์ใช้กับหน่วยงาน</label>
                <div class="marginx">
                    <label>ประโยชน์ที่ได้รับ</label>
                    <div id="benefitContainer"></div>
                </div>
                <button type="button"onclick="addInputField('benefitContainer', 'ประโยชน์ที่ได้รับ ', ['กรอกประโยชน์ที่ได้รับ'])">เพิ่มประโยชน์ที่ได้รับ</button>
                <div class="marginx">

                    <label>การประยุกต์ใช้กับหน่วยงาน :</label>
                    <textarea class="textarea"name="applied" ></textarea>
                </div>

            </div>

            <label>9. ปัญหาและอุปสรรค</label>
            <textarea class="textarea"name="description" ></textarea>

            <label>10. ข้อเสนอแนะ</label>
            <textarea class="textarea"name="suggestions" ></textarea>

            <button type="submit">บันทึก</button>
        </form>

        <br>
        <a href="/map"><i class="fa-solid fa-arrow-left"></i> กลับไปยังแผนที่</a>
    </div>
    @else
    <div class="login-alert">
        <h2>กรุณาเข้าสู่ระบบ</h2>
        <a href="{{route('login')}}" class="btn btn-primary">Go To Login</a>
    </div>
    @endif

    <script>
    const userList = @json($usersent);
    document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll(".d-none"); // เลือกทุก input ที่ต้องป้องกัน

    inputs.forEach(input => {
        input.addEventListener("input", function() {
            input.value = input.defaultValue; // บังคับค่ากลับมาเป็นค่าเดิม
            });
        });
    });

    function addInputField(containerId, labelPrefix, placeholders) {
        const inputContainer = document.getElementById(containerId);
        const inputCount = inputContainer.children.length + 1; // นับจำนวน input ที่มีอยู่แล้ว

        // สร้าง div ครอบชุด input
        const newInput = document.createElement("div");
        newInput.classList.add("input-group");

        let inputHTML = `<label>${labelPrefix} ${inputCount} :</label>`;

        placeholders.forEach((placeholder, index) => {
            inputHTML += `<input class="input"type="text" name="${containerId}[]" placeholder="${placeholder}" required>`;
        });

        inputHTML += `<button type="button" class="remove-btn" onclick="removeInputField(this)">ลบ</button><br>`;

        newInput.innerHTML = inputHTML;
        inputContainer.appendChild(newInput);
    }

    function addActivityInputField() {
        const inputContainer = document.getElementById('activityContainer');
        const inputCount = inputContainer.children.length + 1; // นับจำนวน input ที่มีอยู่แล้ว

        // สร้าง div ครอบชุด input สำหรับ person
        const newInput = document.createElement("div");
        newInput.classList.add("input-group");

        let inputHTML = `<label>ชื่อ-สกุล ผู้รับผิดชอบ ${inputCount} :</label>`;

        inputHTML += `<input class="input" type="text" name="activityContainer[${inputCount}][]" placeholder="กรอกชื่อกิจกรรม" required>`;
        inputHTML += `<input class="input" type="text" name="activityContainer[${inputCount}][]" placeholder="กรอกชื่อผู้รับผิดชอบ" required>`;
        inputHTML += `<input class="input" type="text" name="activityContainer[${inputCount}][]" placeholder="ผลลัพธ์" required>`;

        inputHTML += `<button type="button" class="remove-btn" onclick="removeInputField(this)">ลบ</button>`;

        newInput.innerHTML = inputHTML;
        inputContainer.appendChild(newInput);
    }

    function sentPersonInputField() {
        const inputContainer = document.getElementById('personContainer');
        const inputCount = inputContainer.children.length + 1;

        const newInput = document.createElement("div");
        newInput.classList.add("input-group");

        // label + select สำหรับชื่อ
        let inputHTML = `<label>ผู้รับผิดชอบคนที่ ${inputCount} :</label>`;
        inputHTML += `<select class="name-select" name="personContainer[${inputCount}][]" onchange="updatePositionInput(this)" required>
                        <option value="">-- เลือกชื่อ --</option>`;
        userList.forEach(user => {
            inputHTML += `<option value="${user.my_name}">${user.my_name}</option>`;
        });
        inputHTML += `</select>`;

        // input สำหรับตำแหน่ง (แสดงอัตโนมัติ)
        inputHTML += `<input type="text" class="position-input input" name="personContainer[${inputCount}][]" placeholder="ตำแหน่ง" readonly >`;

        // ปุ่มลบ
        inputHTML += `<button type="button" class="remove-btn" onclick="removeInputField(this)">ลบ</button>`;

        newInput.innerHTML = inputHTML;
        inputContainer.appendChild(newInput);
    }

    function updatePositionInput(nameSelect) {
        const selectedName = nameSelect.value;
        const wrapper = nameSelect.closest('.input-group');
        const positionInput = wrapper.querySelector('.position-input');

        // ตั้งค่าตำแหน่ง
        const matchedUser = userList.find(user => user.my_name === selectedName);
        positionInput.value = matchedUser ? matchedUser.position : '';

        // ตรวจสอบว่า มี select ไหนถูกเลือกชื่ออยู่บ้างหรือไม่
        const allSelects = document.querySelectorAll('#personContainer .name-select');
        const hasSelectedName = Array.from(allSelects).some(select => select.value !== "");

        // แสดงหรือซ่อนปุ่มเพิ่มผู้รับผิดชอบ
        const addButton = document.getElementById('addPersonBtn');
        addButton.style.display = hasSelectedName ? 'inline-block' : 'none';
    }



    function addPersonInputField() {
        const inputContainer = document.getElementById('personContainer');
        const inputCount = inputContainer.children.length + 1; // นับจำนวน input ที่มีอยู่แล้ว

        // สร้าง div ครอบชุด input สำหรับ person
        const newInput = document.createElement("div");
        newInput.classList.add("input-group");

        let inputHTML = `<label>ชื่อ-สกุล ผู้รับผิดชอบ ${inputCount} :</label>`;

        inputHTML += `<input class="input" type="text" name="personContainer[${inputCount}][]" placeholder="กรอกชื่อ-สกุล" required>`;
        inputHTML += `<input class="input" type="text" name="personContainer[${inputCount}][]" placeholder="กรอกตำแหน่ง" required>`;

        inputHTML += `<button type="button" class="remove-btn" onclick="removeInputField(this)">ลบ</button>`;

        newInput.innerHTML = inputHTML;
        inputContainer.appendChild(newInput);
    }

    function removeInputField(button) {
        button.parentElement.remove();
    }
    function addRow() {
        let table = document.querySelector("table tbody");
        let newRow = `
            <tr>
                <td><textarea type="text"class="text_intable" name="result_main[]" required></textarea></td>
                <td><input class="input_intable"type="text" name="goal_unit[]" required></td>
                <td><input class="input_intable"type="number" name="goal_amount[]" required></td>
                <td><input class="input_intable"type="text" name="performance_unit[]" required></td>
                <td><input class="input_intable"type="number" name="performance_amount[]" required></td>
            </tr>
        `;
        table.insertAdjacentHTML("beforeend", newRow);
    }
    </script>
</body>

</html>