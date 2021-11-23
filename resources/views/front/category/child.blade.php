@foreach($child as $sub)
<li><a class="dropdown-item text-center" href="/course/coursesCategory/{{$sub->name}}">{{ $sub->title }}</a></li>
    @if (count($sub->child))
        @include('front.category.child',['child'=>$category->child])
    @endif
@endforeach
