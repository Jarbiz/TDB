@extends('welcome')
@section('title', 'Xem chi tiết giỏ hàng')
@section('content')
    <div class="row bg-white shadow" style="height:65vh; overflow:auto;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thông tin đơn hàng</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Mã đơn hàng: {{ $data->id }}
                        </li>
                        <li class="list-group-item">
                            Người đặt hàng: {{ $data->User->name }}
                        </li>
                        <li class="list-group-item">
                            Ngày đặt hàng: {{ $data->created_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="list-group-item">
                            Tổng tiền: {{ number_format($data->total, 0, '', ',') }} đ
                        </li>
                        <li class="list-group-item">
                            Trạng thái:
                           
                                @if($data->status == 1)
                                    <b class="text-info">Chưa thanh toán </b>
                                @elseif($data->status == 2)
                                    <b class="text-success">  Đã thanh toán</b> 
                                @else 
                                   <b class="text-danger">Đã hủy</b> 
                                @endif
                            
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-md-12 ml-2 mr-3 mb-3">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="row">STT</th>
                        <th>Khóa học</th>
                        <th>Gía tiền</th>
                      </tr>
                </thead>
                <tbody>
                 
                  @if($data->OrderDetails)
                    @foreach($data->OrderDetails as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }} </td>
                            <td>{{ $value->Course->name }} </td>
                            <td>{{ number_format($value->price) }} </td>
                        </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
        </div>
    </div>
@endsection

@section('js')

@endsection