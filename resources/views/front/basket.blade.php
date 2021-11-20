@extends('front.include.master_front')
@section('page_title')
    سبد خرید
@endsection
@section('main_content')
    <div class="container">

        <div class="row d-flex mb-4 justify-content-center">



            <div class="col-lg-6 me-2" style="border: 2px solid tomato;height: 450px">
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
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>



            </div>
            <div class="col-lg-3 " style="border: 2px solid orange">

            </div>



        </div>

    </div>
@endsection
