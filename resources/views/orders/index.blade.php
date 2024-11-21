@extends('welcome')
@section('title', 'Quản lý giỏ hàng')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>ID HÓA ĐƠN</th>
                                <th>Người mua hàng</th>
                                <th>Tổng tiền</th>
                                <th>Ngày tạo đơn</th>
                                <th>Trạng thái</th>
                                <th class="text-center"><i class="fa fa-asterisk"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                use Carbon\Carbon;
                            @endphp
                            @foreach($order as $or)
                                <tr>
                                    
                                    <td>{{ $or->id }}</td>
                                    <td>{{ $or->User->name }}</td>
                                    <td>{{ number_format($or->total) }}</td>
                                    <td>{{ Carbon::parse($or->created_at)->format('d/m/Y H:s:i') }}</td>
                                    <td>
                                        @if($or->status == 1)
                                            Chưa thanh toán
                                        @elseif($or->status == 2)
                                            Đã thanh toán
                                        @else 
                                            Đã hủy
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('order.edit', $or->id) }}" 
                                            class="btn btn-info p-1"
                                            target="_blank">
                                            <i
                                            class="fa fa-eye"></i></a>
                                        @if($or->status != 2 && $or->status == 1)
                                            <button type="button" class="btn btn-primary p-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $or->id }}">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        @endif
                                     
                                    </td>

                                </tr>
                                <div class="modal fade" id="staticBackdrop{{ $or->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="staticBackdropLabel">Xác nhận đơn hàng</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('order.accept_orderWeb') }}" method="post">
                                            @csrf
                                            <div class="modal-body">                                   
                                                <input type="hidden" name="id" value ="{{ $or->id }}">
                                                <input type="hidden" name="status" value ="2">
                                                <p class="text-danger">Bạn có chắc chuyển trạng thái đơn hàng ...!</p>
                                            
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


                         
                        </tbody>
                    </table>

                   
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#table_id').dataTable({
            language: {
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ độ dài trang",
                info: "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ mục",

            }
        });
    </script>
    <script>
        CKEDITOR.replace('summernote', {
            height: 300,


        });
    </script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const imagePreview = document.getElementById('imagePreviewImg');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
