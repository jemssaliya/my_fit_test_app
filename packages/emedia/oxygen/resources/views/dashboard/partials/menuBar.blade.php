@foreach (\EMedia\Helpers\Components\Menu\MenuBar::menuItems($menuBarType) as $item)
    @if ($permission = $item->getPermission())
        @if ($user->can($permission))
            <li><a href="{{ ($item->getUrl())? $item->getUrl(): route($item->getResource()) }}"><i class="{{ $item->getClass() }}"></i> {{ $item->getText() }}</a></li>
        @endif
    @else
        <li><a href="{{ ($item->getUrl())? $item->getUrl(): route($item->getResource()) }}"><i class="{{ $item->getClass() }}"></i> {{ $item->getText() }}</a></li>
    @endif
@endforeach