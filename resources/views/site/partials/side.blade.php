 <div class="list-group my-5">
        <div class="my-4"><search-products></search-products></div>
        <hr>
        <div>
        <h2 style="color:#425B76!important" class="my-2">Categories</h2>
        @foreach($categories as $cat)
            @foreach($cat->items as $category)
                @if ($category->items->count() > 0)
                    <li class="nav-item dropdown list-unstyled my-2 ">
                        <a class="list-group-item list-group-item-action nav-link dropdown-toggle text-primary" href="{{ route('category.show', $category->slug) }}" id="{{ $category->slug }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $category->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="{{ $category->slug }}">
                             @foreach($category->items as $item)
                                <a class="dropdown-item text-primary" href="{{ route('category.show', $item->slug) }}">{{ $item->name }}</a>
                                    @endforeach
                        </div>
                    </li>
                @else
                    <li class="nav-item list-unstyled my-2">
                        <a href="{{ route('category.show', $category->slug) }}" class="nav-link list-group-item list-group-item-action text-primary">{{ $category->name }}</a>
                    </li>
                @endif
            @endforeach
        @endforeach
        <li class="nav-item list-unstyled my-2">
                        <a href="/contact-us" class="nav-link list-group-item list-group-item-action text-primary">Contact us for technical help !!!</a>
        </li>
</div>
</div> 