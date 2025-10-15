
<div id="gridView" class="row" style="display: none;">
    @foreach ($markers as $index => $marker)
        <div class="col-md-3 mb-4"> {{-- เปลี่ยนจาก col-md-4 เป็น col-md-3 --}}
            <div class="card h-100">
                @php
                    $image = $images->firstWhere('Nactivity', $marker->Nactivity);
                @endphp

                @if ($image)
                    <img src="{{ asset('storage/images/' . $image->image_path) }}" class="card-img-top" alt="Image for {{ $marker->Nactivity }}">
                @else
                    <div class="p-3 text-danger">ยังไม่มีรูปภาพกิจกรรม</div>
                @endif

                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <p class="card-text"><strong>ชื่อโครงการ:</strong> {{ $marker->Nactivity }}</p>
                        <p class="card-text"><strong>ผู้รับผิดชอบ:</strong> {{ $marker->my_name }}</p>
                        <p class="card-text"><strong>ปีงบประมาณ:</strong> {{ $marker->year_money }}</p>
                        <p class="card-text"><strong>จังหวัด:</strong> {{ $marker->province }}</p>
                        <p class="card-text"><strong>อำเภอ:</strong> {{ $marker->district }}</p>
                        <p class="card-text"><strong>ระยะเวลา:</strong> {{ $marker->time_pj }} - {{ $marker->time_pj_end }}</p>
                    </div>

                    <div class="status-box gap mt-3">
                        <a href="{{ route('updatex', $marker->Nactivity) }}" class="btn btn-primary btn-sm w-100 mb-1">Update</a>

                        <form id="delete-form-{{ $marker->Nactivity }}" action="{{ route('delx', $marker->Nactivity) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm w-100 mb-1 delete-btn" data-nactivity="{{ $marker->Nactivity }}">ลบ</button>
                        </form>

                        @if(!empty($marker->latitude) && !empty($marker->longitude))
                            <a href="javascript:void(0)" onclick="viewMarkerInfo({{ $marker->latitude }}, {{ $marker->longitude }}, '{{ $marker->Nactivity }}')" class="btn btn-info btn-sm w-100 mb-1">ดูรูปเพิ่มเติม</a>
                        @else
                            <button class="btn btn-warning btn-sm w-100 mb-1">ข้อมูลยังไม่ครบ</button>
                        @endif

                        @if($marker->status == 'Pending' && Auth::check() && Auth::user()->level === 'admin')
                            <form action="{{ route('update_success', ['Nactivity' => $marker->Nactivity]) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm w-100">เสร็จสิ้น</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="pagination-container">
        {{ $markers->appends(request()->except('page'))->links('vendor.pagination.custom') }}
    </div>
</div>
