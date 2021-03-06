<div class="tabs">
    @if (request()->route()->getName() != 'vendoradmin.configuration.index')

        <?php $keys = explode('.', $menu->currentKey);  ?>


        @if ($items = array_get($menu->items, implode('.children.', array_slice($keys, 0, 2)) . '.children'))
        
            <ul>

                @foreach (array_get($menu->items, implode('.children.', array_slice($keys, 0, 2)) . '.children') as $item)

                    <li class="{{ $menu->getActive($item) }}">
                        <a href="{{ $item['url'] }}">
                            {{ trans($item['name']) }}
                        </a>
                    </li>

                @endforeach
        
            </ul>

        @endif

    @else

        @if ($items = array_get($config->items, request()->route('slug') . '.children'))

            <ul>

                @foreach ($items as $key => $item)

                    <li class="{{ $key == request()->route('slug2') ? 'active' : '' }}">
                        <a href="{{ route('vendoradmin.configuration.index', (request()->route('slug') . '/' . $key)) }}">
                            {{ trans($item['name']) }}
                        </a>
                    </li>

                @endforeach

            </ul>

        @endif

    @endif
</div>