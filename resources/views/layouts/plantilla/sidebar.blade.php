<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if (session("menu") != null)
                @foreach (session("menu") as $padre)                 
                    @if ($padre["padre"] == "No")
                        <li class="nav-item"><a href="{{ url($padre["url"]) }}"><i class="{{ $padre["icono"] }}"></i><span class="menu-title">{{ $padre["nombre"] }}</span></a>
                        </li>
                    @endif
                    @if ($padre["padre"] == "Si")
                        <li class="nav-item"><a href="{{ $padre["url"] }}"><i class="{{ $padre["icono"] }}"></i><span class="menu-title">{{ $padre["nombre"] }}</span></a>
                            <ul class="menu-content">
                                @foreach (session("menu") as $hijo)
                                    @if ($padre["id_menu"] == $hijo["padre"])
                                        <li><a class="menu-item" href="{{ url($hijo["url"]) }}"><i class="{{ $hijo["icono"] }}"></i><span>{{ $hijo["nombre"] }}</span></a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>