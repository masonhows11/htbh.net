@foreach ($child as $sub_cat )
<li  role="presentation" class="dropdown child-category">
        <a class="dropdown-toggle category-item" data-toggle="dropdown" href="#">
            {{ $sub_cat->title }}
         </a>
            @if (count($sub_cat->child))
                <ul class="child-cat">
                @include('admin.post_management.child',
                    ['child'=>$sub_cat->child])
                </ul>
            @endif
</li>
@endforeach

