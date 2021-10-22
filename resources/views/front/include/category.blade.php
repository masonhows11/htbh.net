<!------------------------- search section --------------------->
<div class="py-3   search-section">

    <div class="container ">

        <form action="#" class="row d-flex justify-content-center row-cols-lg-auto g-1 align-items-center">

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="دنبال چی میگردی..." aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">بگرد...</button>
            </div>

        </form>
    </div>

</div>

<!-------------------------------- category menu ------------------------------>
<div class="category-menu-wrapper mb-5">
    <div class="container category-menu">

        <ul class="nav justify-content-center py-3 ">



            @foreach($categories as $category)
            <li class="nav-item dropdown">

                <a href="#" class="nav-link" data-bs-toggle="dropdown" role="button" aria-expanded="false">{{ $category->title }}</a>
                @if (count($category->child))
                    <ul class="dropdown-menu">
                        @include('front.category.child',['child'=>$category->child])
                    </ul>
                @endif

            </li>
            @endforeach

        </ul>

    </div>
</div>

