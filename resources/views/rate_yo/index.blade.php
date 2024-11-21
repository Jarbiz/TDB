@extends('welcome')

@section('title', 'Danh sách khuyến mãi')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <style>
        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .width-90 {
            width: 90px !important;
        }

        .rounded-3 {
            border-radius: 0.5rem !important;
        }

        a {
            text-decoration: none;
        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div id="msg-box">
                            <?php //Hiển thị thông báo thành công
                            ?>
                            @if (Session::has('success'))
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <span><i class="mdi mdi-check"></i></span>
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                    </button>
                                </div>
                            @endif
                            <?php //Hiển thị thông báo lỗi
                            ?>
                            @if (Session::has('error'))
                                <div class="alert alert-danger solid alert-end-icon alert-dismissible fade show">
                                    <span><i class="mdi mdi-help"></i></span>
                                    <strong>{{ Session::get('errors') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                    </button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title">Danh sách bình luận sản phẩm</h4>

                                </div>

                            </div>
                            <div class="table-responsive">
                                <div class="container">
                                    <div class="row">
                                        @foreach ($array as $rate)
                                            {{-- {{ dd($rate) }} --}}
                                            {{-- @foreach ($rate as $ra) --}}

                                            <div class="col-xl-12">
                                                <div class="card mb-3 card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <a href="#!.html">
                                                                <img src="https://png.pngtree.com/png-clipart/20190726/ourlarge/pngtree-online-teaching-linear-education-information-png-image_1629642.jpg"
                                                                    class="width-90 rounded-3" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col" style="display:flex; justify-content:space-between;">
                                                            <div class="overflow-hidden flex-nowrap">
                                                                <h6 class="mb-1">
                                                                    <a href="#!"
                                                                        class="text-reset">{{ $rate['product_name'] }}</a>
                                                                </h6>
                                                                <span class="text-muted d-block mb-2 small">
                                                                    Updated 2 Hours Ago
                                                                </span>
                                                                <div class="row align-items-center">
                                                                    <div class="col-12">
                                                                        <div class="row align-items-center g-0">

                                                                            <div class="col d-flex">
                                                                                <div style="margin-right:20px;">
                                                                                    <div class="d-flex text-success"
                                                                                        style="align-items: center;">
                                                                                        <i class="fa-solid fa-check"
                                                                                            style="margin-right:5px;"></i>
                                                                                        <p class="mb-0"
                                                                                            style="margin-right:5px;">Đã
                                                                                            duyệt: </p>
                                                                                        <p class="mb-0">
                                                                                            {{ $rate['status_count']['status_2'] }}
                                                                                        </p>
                                                                                    </div>

                                                                                </div>
                                                                                <div style="margin-right:20px;">
                                                                                    <div class="d-flex text-gray"
                                                                                        style="align-items: center;">

                                                                                        <i class="fa-solid fa-question"
                                                                                            style="margin-right:5px;"></i>
                                                                                        <p class="mb-0"
                                                                                            style="margin-right:5px;">Chưa
                                                                                            duyệt: </p>
                                                                                        <p class="mb-0">
                                                                                            {{ $rate['status_count']['status_1'] }}
                                                                                        </p>
                                                                                    </div>

                                                                                </div>
                                                                                <div style="margin-right:20px;">
                                                                                    <div class="d-flex text-danger"
                                                                                        style="align-items: center;">

                                                                                        <i class="fa-solid fa-xmark"
                                                                                            style="margin-right:5px;"></i>

                                                                                        <p class="mb-0"
                                                                                            style="margin-right:5px;">Từ
                                                                                            chối duyệt: </p>
                                                                                        <p class="mb-0">
                                                                                            {{ $rate['status_count']['status_3'] }}
                                                                                        </p>
                                                                                    </div>

                                                                                </div>


                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                            <div>
                                                                <a class="btn btn-primary" href="{{route('rateYo.edit',$rate['course_id'])}}">Truy cập xem bình luận</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        @endforeach




                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
