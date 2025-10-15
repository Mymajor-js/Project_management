<style>
    #addPersonBtn:hover{
        
    }
/* Container & Title */
.sent-activity {
    max-width: 100%;
    padding: 20px;
    border-radius: 8px;
}

.sent-activity h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #333;
    position: relative;
}

.sent-activity h2::after {
    content: "";
    width: 60px;
    height: 4px;
    background: #3f51b5;
    position: absolute;
    bottom: -8px;
    left: 0;
    border-radius: 2px;
}

/* Form labels and inputs */
.sent-activity label {
    display: block;
    margin: 14px 0 6px;
    font-weight: 600;
    color: rgb(255, 255, 255);
}

.sent-activity input.input,
.sent-activity textarea.textarea,
.sent-activity select {
    width: 100%;
    padding: 12px 16px;
    font-size: 1rem;
    border: 1px solid #ccd0d5;
    border-radius: 6px;
    background: #f9f9fb;
    transition: all .3s ease;
    box-sizing: border-box;
}

.sent-activity input.input:focus,
.sent-activity textarea.textarea:focus,
.sent-activity select:focus {
    outline: none;
    border-color: #3f51b5;
    background: #fff;
}

/* Flex & grouping */
.sent-activity .form-group.full-width {
    margin-top: 20px;
}

.sent-activity .date-group {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.sent-activity .date-group>div {
    flex: 1;
}

/* Buttons */
.sent-activity .btncolor {
    display: inline-block;
    padding: 10px 20px;
    font-size: 0.95rem;
    font-weight: 600;
    color: #fff;
    background: #3f51b5;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background .3s ease;
}

.sent-activity .btncolor:hover {
    background: #2c387e;
}


.sent-activity .btncolor:hover {
    background: #2c387e;
}

/* Table styling */
.sent-activity table.full-width {
    width: 100%;
    border-collapse: collapse;
    margin-top: 24px;
}

.sent-activity table.full-width th,
.sent-activity table.full-width td {
    padding: 10px;
    text-align: center;
    border: 1px solid #e0e0e0;
}

.sent-activity table.full-width th {
    background: #f5f5f5;
    font-weight: 600;
}

/* Input inside table */
.sent-activity .input_intable,
.sent-activity .text_intable {
    width: 100%;
    padding: 6px;
    font-size: 0.9rem;
    border: 1px solid rgb(46, 64, 81);
    border-radius: 4px;
    box-sizing: border-box;
}

/* Utility */
.marginx {
    margin-top: 16px;
}

.topx {
    margin-top: 24px;
}

.table-container {
    overflow-x: auto;
    margin-top: 20px;
    border-radius: 6px;
    background: #fff;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
}

.responsive-table {
    width: 100%;
    min-width: 800px;
    border-collapse: collapse;
}

.responsive-table th,
.responsive-table td {
    border: 1px solid rgb(46, 64, 81);
    padding: 10px;
    text-align: center;
}

.responsive-table th {
    background-color: #567086;
    font-weight: bold;
}

.input_intable,
.text_intable {
    width: 100%;
    padding: 6px;
    box-sizing: border-box;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

.text_intable {
    height: 60px;
}

.add-row-btn {
    margin-top: 15px;
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: bold;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.add-row-btn:hover {
    background-color: #0056b3;
}
.remove-row-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 4px;
    cursor: pointer;
}
.remove-row-btn:hover {
    background-color: #c82333;
}
</style>

<div class="sent-activity">
    <h2 class="colorw" style="color: rgb(255, 255, 255);">เพิ่มข้อมูล</h2>
    

    <form action="{{ route('Sentsave') }}" method="POST">
        @csrf

        <label for="latitude">Latitude :</label>
        <input class="input form-control" type="text" id="latitude" name="latitude">

        <label for="longitude">Longitude :</label>
        <input class="input form-control" type="text" id="longitude" name="longitude">

        <label>1. ชื่อโครงการ :</label>
        <input class="input" type="text" name="Nactivity" placeholder="กรอกชื่อโครงการ" required>

        <div class="form-group full-width">
            <label>2. ผู้รับผิดชอบโครงการ</label>

            <div class="marginx">
                <div id="personContainer"></div>
            </div>
        </div>
        <div class="buttonx">
            <button type="button" id="addPersonBtn" style="background-color: rgb(12, 5, 87); display: none;"
                onclick="addPersonInputField()">เพิ่มผู้รับผิดชอบ</button>
            <button type="button" class="btncolor" onclick="sentPersonInputField()">เลือกผู้รับผิดชอบ</button>
        </div>

        <div class="form-group full-width">
            <label>3. งบประมาณที่ได้รับ</label>
            <div class="marginx">
                <label>งบประมาณที่ใช้ :</label>
                <input class="input form-control" type="number" name="batthai" placeholder="กรอกงบประมาณ">

                <label>ปีงบประมาณ :</label>
                <input class="input form-control" type="text" name="year_money" placeholder="กรอกปีงบประมาณ">

                <label>แหล่งงบประมาณ :</label>
                <input class="input form-control" type="text" name="arear_money" placeholder="กรอกแหล่งงบประมาณ">
            </div>
        </div>
        <div class="form-group full-width">
            <label>4. วัตถุประสงค์หลัก (O)</label>
            <div class="marginx">
                <div id="targetContainer"></div>
            </div>
        </div>
        <button type="button" class="btncolor"
            onclick="addInputField('targetContainer', 'วัตถุประสงค์หลัก ที่ ', ['กรอกวัตถุประสงค์หลัก'])">เพิ่มวัตถุประสงค์หลัก(O)</button>
        <br>
        <div class="form-group full-width">
            <label>5. ผลลัพธ์หลัก (KR)</label>
            <div class="marginx">
                <div id="resultContainer"></div>
            </div>
        </div>
        <button type="button" class="btncolor"
            onclick="addInputField('resultContainer', 'ผลลัพธ์หลัก ที่ ', ['กรอกผลลัพธ์ที่คาดหวัง'])">เพิ่มผลลัพธ์หลัก(KR)</button>
        <div class="form-group full-width">
            <label>6. พื้นที่และกลุ่มเป้าหมาย </label>
            <div class="marginx topx">
                <label>จังหวัด :</label>
                <input class="input form-control" type="text" name="province" placeholder="กรอกจังหวัด">

                <label>อำเภอ :</label>
                <input class="input form-control" type="text" name="district" placeholder="กรอกอำเภอ">

                <label>ตำบล :</label>
                <input class="input form-control" type="text" name="subdistrict" placeholder="กรอกตำบล">

                <label>ชื่อหมู่บ้าน :</label>
                <input class="input form-control" type="text" name="mauban" placeholder="กรอกหมู่บ้าน">

                <label>หมู่ที่ :</label>
                <input class="input form-control" type="text" name="mautee" placeholder="กรอกหมู่ที่">
            </div>
        </div>
        <div class="form-group full-width">
            <label>กลุ่มเป้าหมาย</label>
            <div class="date-group">
                <div>
                    <label>กลุ่มเป้าหมายภายใน :</label>
                    <input class="input form-control" type="text" name="number_target"
                        placeholder="กรอกกลุ่มเป้าหมายภายใน">
                </div>
                <div>
                    <label>กลุ่มเป้าหมายภายนอก :</label>
                    <input class="input form-control" type="text" name="number_target_out"
                        placeholder="กรอกกลุ่มเป้าหมายภายนอก">
                </div>
            </div>
        </div>
        <div class="form-group full-width">
            <label>ระยะเวลาในการทำโครงการ / กิจกรรม</label>
            <div class="date-group">
                <div>
                    <label for="time_pj">วันที่เริ่มต้น</label>
                    <input class="input form-control" type="date" id="time_pj" name="time_pj">
                </div>
                <div>
                    <label for="time_pj_end">วันที่สิ้นสุด</label>
                    <input class="input form-control" type="date" id="time_pj_end" name="time_pj_end">
                </div>
            </div>
        </div>
        <div class="form-group full-width">
            <label>7. สรุปผลการดำเนินงาน</label>
            <div class="marginx">
                <label>7.1 สรุปผลการดำเนินงานในภาพรวม :</label>
                <textarea class="textarea form-control" name="performancex"
                    placeholder="การจัดโครงการนี้..."></textarea>
                <label>7.2 รายละเอียดผลการดำเนินงานรายกิจกรรม :</label>
                <div id="activityContainer"></div>
            </div>
        </div>
        <button type="button" class="btncolor" onclick="addActivityInputField()">เพิ่มกิจกรรม</button>

        <!-- ใส่ 7.3-->
        <div class="table-container">
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th rowspan="2">ผลลัพธ์หลัก</th>
                        <th colspan="2">เป้าหมาย</th>
                        <th colspan="2">ผลการดำเนินงาน</th>
                        <th rowspan="2">ลบ</th> 
                    </tr>
                    <tr>
                        <th>หน่วยนับ</th>
                        <th>จำนวน</th>
                        <th>หน่วยนับ</th>
                        <th>จำนวน</th>
                    </tr>
                </thead>
                <tbody id="resultTableBody">
                    <tr>
                        <td><textarea class="text_intable" name="result_main[]"></textarea></td>
                        <td><input class="input_intable " type="text" name="goal_unit[]"></td>
                        <td><input class="input_intable " type="number" name="goal_amount[]"></td>
                        <td><input class="input_intable " type="text" name="performance_unit[]"></td>
                        <td><input class="input_intable " type="number" name="performance_amount[]"></td>
                        <td><button type="button" class="remove-row-btn" onclick="removeRow(this)">ลบ</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button type="button" class="add-row-btn" onclick="addRow()">เพิ่มแถว</button>

        <div class="form-group full-width">
            <label>8. ประโยชน์ที่ได้รับ/การประยุกต์ใช้กับหน่วยงาน</label>
            <div class="marginx">
                <label>ประโยชน์ที่ได้รับ</label>
                <div id="benefitContainer"></div>
            </div>
            <button type="button" class="btncolor"
                onclick="addInputField('benefitContainer', 'ประโยชน์ที่ได้รับ ', ['กรอกประโยชน์ที่ได้รับ'])">เพิ่มประโยชน์ที่ได้รับ</button>
            <div class="marginx">

                <label>การประยุกต์ใช้กับหน่วยงาน :</label>
                <textarea class="textarea" name="applied"></textarea>
            </div>

        </div>

        <label>9. ปัญหาและอุปสรรค</label>
        <textarea class="textarea form-control" name="description"></textarea>

        <label>10. ข้อเสนอแนะ</label>
        <textarea class="textarea form-control" name="suggestions"></textarea>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-check"></i> บันทึก
            </button>

        </div>
    </form>
</div>

<script>
const userList = @json($users->map(fn($u) => ['my_name' => $u->my_name, 'position' => $u->position])->values());
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
        inputHTML +=
            `<input class="input form-control"type="text" name="${containerId}[]" placeholder="${placeholder}" required>`;
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

    inputHTML +=
        `<input class="input form-control" type="text" name="activityContainer[${inputCount}][]" placeholder="กรอกชื่อกิจกรรม" required>`;
    inputHTML +=
        `<input class="input form-control" type="text" name="activityContainer[${inputCount}][]" placeholder="กรอกชื่อผู้รับผิดชอบ" required>`;
    inputHTML +=
        `<input class="input form-control" type="text" name="activityContainer[${inputCount}][]" placeholder="ผลลัพธ์" required>`;

    inputHTML += `<button type="button" class="remove-btn" onclick="removeInputField(this)">ลบ</button>`;

    newInput.innerHTML = inputHTML;
    inputContainer.appendChild(newInput);
}

function sentPersonInputField() {
        const inputContainer = document.getElementById('personContainer');
        const inputCount = inputContainer.children.length + 1;

        const newInput = document.createElement("div");
        newInput.classList.add("input-group");
        newInput.style.marginBottom = "15px"; // เพิ่ม gap สวยๆ

        // select + input
        let inputHTML = `
            <label>ผู้รับผิดชอบคนที่ ${inputCount} :</label>
            <select class="name-select" name="personContainer[${inputCount}][]" onchange="updatePositionInput(this)" required>
                <option value="">-- เลือกชื่อ --</option>`;

        userList.forEach(user => {
            inputHTML += `<option value="${user.my_name}">${user.my_name}</option>`;
        });

        inputHTML += `</select>
            <input type="text" class="position-input input form-control" name="personContainer[${inputCount}][]" placeholder="ตำแหน่ง" readonly>
            <button type="button" class="remove-btn" onclick="removeInputField(this)">ลบ</button>
        `;

        newInput.innerHTML = inputHTML;
        inputContainer.appendChild(newInput);
    }

    function updatePositionInput(selectElement) {
        const selectedName = selectElement.value;
        const user = userList.find(u => u.my_name === selectedName);

        const container = selectElement.closest('.input-group');
        const positionInput = container.querySelector('.position-input');

        if (user && positionInput) {
            positionInput.value = user.position || '';
        } else {
            positionInput.value = '';
        }
            const addPersonBtn = document.getElementById("addPersonBtn");
    if (addPersonBtn) {
        addPersonBtn.style.display = "inline-block"; // หรือ "block" ตามต้องการ
    }

    }

function addPersonInputField() {
    const inputContainer = document.getElementById('personContainer');
    const inputCount = inputContainer.children.length + 1; // นับจำนวน input ที่มีอยู่แล้ว

    // สร้าง div ครอบชุด input สำหรับ person
    const newInput = document.createElement("div");
    newInput.classList.add("input-group");

    let inputHTML = `<label>ชื่อ-สกุล ผู้รับผิดชอบ ${inputCount} :</label>`;

    inputHTML +=
        `<input class="input form-control" type="text" name="personContainer[${inputCount}][]" placeholder="กรอกชื่อ-สกุล" required>`;
    inputHTML +=
        `<input class="input form-control" type="text" name="personContainer[${inputCount}][]" placeholder="กรอกตำแหน่ง" required>`;

    inputHTML += `<button type="button" class="remove-btn" onclick="removeInputField(this)">ลบ</button>`;

    newInput.innerHTML = inputHTML;
    inputContainer.appendChild(newInput);
}

function removeInputField(button) {
    button.parentElement.remove();
}

function addRow() {
    let tableBody = document.getElementById("resultTableBody");
    let newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td><textarea class="text_intable" name="result_main[]"></textarea></td>
        <td><input class="input_intable" type="text" name="goal_unit[]"></td>
        <td><input class="input_intable" type="number" name="goal_amount[]"></td>
        <td><input class="input_intable" type="text" name="performance_unit[]"></td>
        <td><input class="input_intable" type="number" name="performance_amount[]"></td>
        <td><button type="button" class="remove-row-btn" onclick="removeRow(this)">ลบ</button></td>
    `;
    tableBody.appendChild(newRow);
}
function removeRow(button) {
    const row = button.closest("tr");
    row.remove();
}
</script>