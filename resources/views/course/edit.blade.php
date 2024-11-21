@extends('welcome')
@section('title', 'Chi tiết khóa học')
@section('css')
  <style>
    .card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}

.width-90 {
    width: 90px!important;
}
.rounded-3 {
    border-radius: 0.5rem !important;
}

a {
text-decoration:none;    
}
  </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        @foreach($data->CourseData as $key => $CourseData)
            <div class="col-xl-12">
                <div class="card mb-3 card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="#!.html">
                            <img src="https://png.pngtree.com/png-clipart/20230417/original/pngtree-online-course-flat-icon-png-image_9064505.png" class="width-90 rounded-3" alt="">
                            </a>
                        </div>
                        <div class="col">
                            <div class="overflow-hidden flex-nowrap">
                                <h6 class="mb-1">
                                    <a href="#!" class="text-reset">{{ $data->name .' - Buổi học ' . ($key + 1) }} </a>
                                </h6>
                                <span class="text-muted d-block mb-2 small">
                                Ghi chú: {{ $CourseData->description ?? 'Không có ghi chú'}}
                                <br><br>
                                <b class="text-danger mb-0 mt-2" > 
                                    @if($CourseData->video) 
                                    <a href="{{ asset($CourseData->video) }}"  target="_blank">Video Minh họa</a>
                                    @else
                                    Chưa có video minh họa
                                    @endif

                                </b>
                            </span>
                            <div>
                                <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Cập nhật
                                </button>
                                <a href="{{ route('course.getQuestion',$CourseData->id) }}" class="btn btn-warning p-2 text-black">
                                    Cập nhật bài kiểm tra
                                </a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Cập nhật cho từng buổi {{ $key + 1 }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('course.store_video') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $CourseData->id }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">
                                    Nhập file
                                </label>
                                <input type="file" class="form-control" name="video">
                                
                            </div>
                            <div class="form-group">
                                <label for="">
                                Chú thích ngắn
                                </label>
                                <input type="text" class="form-control" name="description" value="{{ $CourseData->description }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
        @endforeach
    </div>
</div>
@endsection
@section('js')
   
@endsection
