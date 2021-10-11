@foreach ($child as $sub_cat )
<li  role="presentation" class="dropdown child-category">
        <a class="dropdown-toggle category-item" data-toggle="dropdown" href="#">
            {{ $sub_cat->title }}
           </a>
        <ul>
            @if (count($sub_cat->child))
                @include('admin.post_management.child',
                    ['child'=>$sub_cat->child])
            @endif
        </ul>
</li>
@endforeach

