<style>
/* ปุ่มหลักทั้งหมด */
.btn {
    display: inline-block;
    padding: 6px 14px;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out, transform 0.1s;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.btn:hover {
    transform: scale(1.03);
}

.btn-primarys {
    background-color: #007bff;
    color: white;
}

.btn-primarys:hover {
    background-color: #0069d9;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-success {
    background-color: #28a745;
    color: white;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-info {
    background-color: #17a2b8;
    color: white;
}

.btn-info:hover {
    background-color: #138496;
}

.btn-warning {
    background-color: #ffc107;
    color: black;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-sm {
    padding: 4px 10px;
    font-size: 13px;
}

.delete-btn {
    background-color: transparent;
    color: #dc3545;
    border: 1px solid #dc3545;
}

.delete-btn:hover {
    background-color: #dc3545;
    color: white;
}

.status-box.gap,
.gap {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    justify-content: center;
    align-items: center;
}

.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.custom-pagination {
    display: flex;
    gap: 8px;
}

.custom-pagination a,
.custom-pagination span {
    padding: 8px 12px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
}

.custom-pagination a {
    background-color: #007bff;
    color: white;
    border: 1px solid #007bff;
}

.custom-pagination a:hover {
    background-color: #0056b3;
}
.btn-outline-primary{
    background-color: #0056b3;
    color:rgb(255, 255, 255);
}
.custom-pagination .active {
    background-color: #28a745;
    color: white;
    border: 1px solid #28a745;
}

.custom-pagination .disabled {
    background-color: #e9ecef;
    color: #6c757d;
    border: 1px solid #dee2e6;
    cursor: not-allowed;
}

.custom-pagination .disabled:hover {
    background-color: #e9ecef;
}

.table-responsive {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table-responsive::-webkit-scrollbar {
    height: 6px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 3px;
}

.tm-status-circle {
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-right: 5px;
}

.tm-status-circle.finish {
    background-color: #28a745;
    /* เขียว */
}

.tm-status-circle.Pending {
    background-color: #ffc107;
    /* เหลือง */
}

.tm-block-scroll {
    max-height: 500px;
    overflow-y: auto;
}
.gap-2{
    gap: 5px;
}
.wrap-text {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    white-space: normal;
    word-break: break-word;
    max-width: 350px;
    text-align: left;
    margin: 10px 0;
}
.table-darks{
    color:rgb(255, 255, 255);
    background-color:rgb(27, 42, 57);
}

</style>
<div class="table-responsive">
    
    <table class="table table-hover table-striped align-middle text-center">

        <thead class="table-darks">
            <tr>
                <th style="min-width: 2px;">
                    <center>No</center>
                </th>
                <th style="min-width: 340px;">
                    <center>ชื่อโครงการ/กิจกรรม</center>
                </th>
                <th style="min-width: 20px;">
                    <center>ปีงบประมาณ</center>
                </th>
                <th>
                    <center style="min-width: 20px;">จัดการ</center>
                </th>
                <th style="min-width: 145px;">
                    <center>เพิ่มเติม</center>
                </th>
                <th style="min-width: 165px;">
                    <center>สถานะ</center>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($markers->filter(fn($marker) => Auth::user()->level === 'admin' || $marker->my_name ===
            Auth::user()->my_name) as $index => $marker)
            <tr>
                <td class="centertext">{{ ($markers->firstItem() + $index) }}</td>
                <td>
                    <div class="wrap-text">{{ $marker->Nactivity }}</div>
                </td>
                <td class="centertext">
                    <center>{{ $marker->year_money }}</center>
                </td>
                <td>
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('updatex', $marker->Nactivity) }}" class="btn btn-sm btn-outline-primary">
                            🔧 Update
                        </a>
                        <form id="delete-form-{{ $marker->Nactivity }}" action="{{ route('delx', $marker->Nactivity) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                data-nactivity="{{ $marker->Nactivity }}">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                </td>
                <td class="centertext">
                    <div class="gap">
                        @if(empty($marker->latitude) || empty($marker->longitude))
                        <button class="btn btn-warning btn-sm">⚠️ ข้อมูลยังไม่ครบ</button>
                        @else
                        <a href="javascript:void(0)"
                            onclick="viewMarkerInfo({{ $marker->latitude }}, {{ $marker->longitude }},'{{$marker->Nactivity}}')"
                            class="btn btn-info btn-sm">📝 ดูรูปเพิ่มเติม</a>
                        @endif

                        @if($marker->status == 'Pending' && Auth::check() && Auth::user()->level === 'admin')
                        @if(!empty($marker->latitude) && !empty($marker->longitude))
                        <form action="{{route('update_success', ['Nactivity' => $marker->Nactivity])}}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">✅ เสร็จสิ้น</button>
                        </form>
                        @endif
                        @endif
                    </div>
                </td>
                <td class="centertext">
                    <div class="status-box gap">
                        <div class="status {{ $marker->status == 'finish' ? 'finish' : 'Pending' }}">
                            <i
                                class="fa-solid {{ $marker->status == 'finish' ? 'fa-circle-check' : 'fa-circle-exclamation' }}"></i>
                            <span>{{ $marker->status == 'finish' ? 'เสร็จสิ้น' : 'รอดำเนินการ' }}</span>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-container" id="paginationContainer">
        {!! $markers->appends(request()->except('page') + ['section' => 'infoSection'])->links('vendor.pagination.custom') !!}
    </div>

</div>