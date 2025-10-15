<form action="{{ route('project.store') }}" method="POST">
    @csrf

    <label>ชื่อกิจกรรม:</label>
    <input type="text" name="Nactivity" required>

    <div id="personContainer"></div>
    <!-- เพิ่มปุ่มเฉพาะสำหรับ Person -->
    <button type="button" onclick="addPersonInputField()">เพิ่มผู้รับผิดชอบ</button>
    
    <div id="targetContainer"></div>
    <button type="button" onclick="addInputField('targetContainer', 'วัตถุประสงค์หลัก', ['กรอกวัตถุประสงค์หลัก'])">เพิ่มวัตถุประสงค์</button>

    <div id="resultContainer"></div>
    <button type="button" onclick="addInputField('resultContainer', 'ผลลัพธ์หลัก', ['กรอกผลลัพธ์'])">เพิ่มผลลัพธ์หลัก</button>

    <div id="activityContainer"></div>
    <button type="button" onclick="addInputField('activityContainer', 'กิจกรรม', ['กรอกกิจกรรม', 'กรอกผู้รับผิดชอบ', 'ผลลัพธ์'])">เพิ่มกิจกรรม</button>

    <div id="benefitContainer"></div>
    <button type="button" onclick="addInputField('benefitContainer', 'ประโยชน์ที่ได้รับ', ['กรอกประโยชน์ที่ได้รับ'])">เพิ่มประโยชน์</button>

    <table>
        <thead>
            <tr>
                <th>ผลลัพธ์หลัก</th>
                <th>หน่วยนับ</th>
                <th>จำนวน</th>
                <th>ผลการดำเนินงาน หน่วยนับ</th>
                <th>ผลการดำเนินงาน จำนวน</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <button type="button" onclick="addRow()">เพิ่มแถว</button>

    <button type="submit">บันทึกข้อมูล</button>
</form>
<script>
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

        inputHTML += `<button type="button" class="remove-btn" onclick="removeInputField(this)">ลบ</button>`;

        newInput.innerHTML = inputHTML;
        inputContainer.appendChild(newInput);
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
                <td><input class="input_intable"type="text" name="result_main[]" required></td>
                <td><input class="input_intable"type="text" name="goal_unit[]" required></td>
                <td><input class="input_intable"type="number" name="goal_amount[]" required></td>
                <td><input class="input_intable"type="text" name="performance_unit[]" required></td>
                <td><input class="input_intable"type="number" name="performance_amount[]" required></td>
            </tr>
        `;
        table.insertAdjacentHTML("beforeend", newRow);
    }
    </script>