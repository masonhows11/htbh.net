@extends('front.include.master_front')
@section('page_title')
    سبد خرید
@endsection
@section('main_content')
    <div class="container">

        <div class="row d-flex mb-4 justify-content-center">



            <div class="col-lg-6 me-2 basket-section" style="border: 2px solid tomato;height: 450px">
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
                            <td class="item-price">{{ number_format($item->price) }} تومان   </td>
                            <td><a href="{{ route('deleteBasket',['id'=>$item->id]) }}" class="btn btn-danger">حذف</a></td>
                        </tr>

                        @endforeach
                        </tbody>
                    </table>
                </form>



            </div>
            <div class="col-lg-3 d-flex  align-items-center flex-column" style="border: 2px solid orange">

                <div class="col-lg-8 mt-5 total_price" style="border: 2px solid black;height: 30px">
                <h4>مبلغ کل</h4>
                </div>

                <div class="col-lg-8 payable_price" style="border: 2px solid black;height: 30px">
                    <h4>مبلغ قابل پرداخت</h4>
                </div>


            </div>



        </div>

    </div>
@endsection
