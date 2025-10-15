<form action="{{ route('testsave') }}" method="POST">
    @csrf
    <input type="hidden" name="my_name" value="{{ Auth::user()->my_name }}">

    <label for="latitude">Latitude :</label>
    <input class="input" type="text" id="latitude" name="latitude" required>

    <label for="longitude">Longitude :</label>
    <input class="input" type="text" id="longitude" name="longitude" required>

    <label>1. ชื่อโครงการ :</label>
    <input class="input" type="text" name="Nactivity" placeholder="กรอกชื่อโครงการ" required>

    <br>
    <div class="form-group full-width">
        <label>3. งบประมาณที่ได้รับ</label>
        <div class="marginx">
            <label>งบประมาณที่ใช้ :</label>
            <input class="input" type="number" name="batthai" placeholder="กรอกงบประมาณ" required>

            <label>ปีงบประมาณ :</label>
            <input class="input" type="text" name="year_money" placeholder="กรอกปีงบประมาณ" required>

            <label>แหล่งงบประมาณ :</label>
            <input class="input" type="text" name="arear_money" placeholder="กรอกแหล่งงบประมาณ" required>
        </div>
    </div>
    <br>

    <div class="form-group full-width">
        <label>6. พื้นที่และกลุ่มเป้าหมาย </label>
        <div class="marginx topx">
            <label>จังหวัด :</label>
            <input class="input" type="text" name="province" placeholder="กรอกจังหวัด" required>

            <label>อำเภอ :</label>
            <input class="input" type="text" name="district" placeholder="กรอกอำเภอ" required>

            <label>ตำบล :</label>
            <input class="input" type="text" name="subdistrict" placeholder="กรอกตำบล" required>

            <label>หมู่บ้าน :</label>
            <input class="input" type="text" name="mauban" placeholder="กรอกหมู่บ้าน" required>

            <label>หมู่ที่ :</label>
            <input class="input" type="text" name="mautee" placeholder="กรอกหมู่ที่" required>
        </div>
    </div>
    <br>
    <div class="form-group full-width">
        <label>กลุ่มเป้าหมาย</label>
        <div class="date-group">
            <div>
                <label>กลุ่มเป้าหมายภายใน :</label>
                <input class="input" type="text" name="number_target" placeholder="กรอกกลุ่มเป้าหมายภายใน" required>
            </div>
            <div>
                <label>กลุ่มเป้าหมายภายนอก :</label>
                <input class="input" type="text" name="number_target_out" placeholder="กรอกกลุ่มเป้าหมายภายนอก" required>
            </div>
        </div>
    </div><br>
    <div class="form-group full-width">
        <label>ระยะเวลาในการทำโครงการ / กิจกรรม</label>
        <div class="date-group">
            <div>
                <label for="time_pj">วันที่เริ่มต้น</label>
                <input class="input" type="date" id="time_pj" name="time_pj" required>
            </div>
            <div>
                <label for="time_pj_end">วันที่สิ้นสุด</label>
                <input class="input" type="date" id="time_pj_end" name="time_pj_end" required>
            </div>
        </div>
    </div>
    <br>
    <div class="form-group full-width">
        <label>7. สรุปผลการดำเนินงาน</label>
        <div class="marginx">
            <label>7.1 สรุปผลการดำเนินงานในภาพรวม :</label>
            <textarea class="textarea" name="performancex" placeholder="การจัดโครงการนี้..."></textarea>
            <label>7.2 รายละเอียดผลการดำเนินงานรายกิจกรรม :</label>
        </div>
    </div>

    <label>การประยุกต์ใช้กับหน่วยงาน :</label>
    <textarea class="textarea" name="applied" required></textarea>

    <label>9. ปัญหาและอุปสรรค</label>
    <textarea class="textarea" name="description" required></textarea>

    <label>10. ข้อเสนอแนะ</label>
    <textarea class="textarea" name="suggestions" required></textarea>

    <button type="submit">บันทึก</button>
</form>
