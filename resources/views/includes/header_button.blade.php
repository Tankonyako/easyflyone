@php($isActive = $view_name == 'pages.' . $page)
<li class="nav-item @if($isActive) active @endif">
    <a class="nav-link" @if(isset($target)) target="{{ $target }}" @endif href="{{ $url }}">{{ $name }} @if($isActive) <span class="sr-only">(current)</span> @endif</a>
</li>
