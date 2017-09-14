@if (!isset($level))
    @php
        $level = 0;
    @endphp
@endif
@foreach ($categories as $category)
    @if (count($category['children']))
        @php
            $attributes = 'class="dropdown-toggle" data-toggle="dropdown"';
            $liClass = 'class="dropdown-submenu"';
            $level++;
        @endphp
    @else
        @php
            $liClass = '';
            $attributes = '';
        @endphp
    @endif
    <li {!! $liClass !!}>
        <a href="{{ route('category.show', $category['object']->slug) }}"
           {!! $attributes !!} title="{{ $category['object']->name }}">
            {{ $category['object']->name }}
        </a>
        @while (true)
            @if ($category['object'] == null)
                @php break; @endphp
            @endif
            @php
                $category['object'] = null;
            @endphp
            @if (count($category['children']))
                <ul class="dropdown-menu multi-level" role="menu">
                {{ $level }}
                    @include('layouts.category-tree', [
                        'categories' => $category['children'],
                        'level' => $level,
                    ])
                </ul>
            @endif
        @endwhile
    </li>
@endforeach
