@extends('front.include.master_front')
@section('page_title')
    سبد خرید
@endsection
@section('main_content')
    <div class="container">


        <div class="row d-flex justify-content-center alert-basket-section">
            <div class="col-lg-6 d-flex justify-center align-items-center">
                @if(session('error'))
                    <div class="alert alert-warning" style="border: 1px solid green">
                        {{ session('error')}}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success" style="border: 1px solid green">
                        {{ session('success')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="row d-flex mt-2 mb-4 justify-content-center">


            <div
                class="col-lg-6 me-2 basket-section border-solid border-4 border-indigo-600 border-opacity-100 rounded-lg">
                <h3 class="h4 mt-2">آیتم های سبد خرید</h3>

                <form action="" method="post">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>نام دوره</th>
                            <th>قیمت</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)

                            <tr>
                                <td>{{ $item->title }}</td>
                                <td class="item-price">{{ number_format($item->price) }} تومان</td>
                                <td><a href="{{ route('deleteBasket',['id'=>$item->id]) }}"
                                       class="btn btn-danger">حذف</a></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
            <div
                class="col-lg-3 d-flex pay-section align-items-center flex-column border-solid border-4 border-indigo-600 border-opacity-100 rounded-lg">

                @if(count($items) != 0)
                <div class="col-lg-8 mt-5 d-flex flex-column total_price">
                    <h4 class="text-center mt-3">مبلغ کل</h4>
                    <p class="item-price text-center mt-3 mb-2 bg-clip-content bg-red-500 rounded-2xl text-white">{{number_format($total_price)  }}
                        تومان </p>
                </div>

                <div class="col-lg-8 d-flex flex-column payable_price">
                    <h4 class="text-center mt-3">مبلغ قابل پرداخت</h4>
                    <p class="item-price text-center mt-3 mb-2 bg-clip-content bg-red-500 rounded-2xl text-white">{{ number_format( $total_price)  }}
                        تومان </p>
                </div>

                <a href="{{ route('addOrder',['total_price'=>$total_price])  }}" class="btn btn-outline-primary mt-5">ثبت سفارش</a>
                @endif

            </div>


        </div>

    </div>
@endsection
