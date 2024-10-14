@php
    $arraySubMenus = [];
    $arrayCanAny = [];
    foreach ($subMenu as $value) {
        if($value['innerSubMenu'] == false){
            foreach ($value['innerSubMenus'] as $innerSubMenu) {
                array_push($arraySubMenus, $innerSubMenu['class']);
                array_push($arrayCanAny, $innerSubMenu['canany']);
            }
        }
    }
@endphp


@canany($arrayCanAny)
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
        {{ in_array($moduleNav ,$arraySubMenus) ? "show" : "" }}
    ">
        <span class="menu-link">
            <span class="menu-icon">
                {!! $menuIcon !!}
            </span>
            <span class="menu-title">{{ $menuTitle }}</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @foreach ($subMenu as $menu)
                @if (isset($menu['innerSubMenu']) && $menu['innerSubMenu'] == true)
                    @php
                        if(isset($menu['innerSubMenu']) && $menu['innerSubMenu'] == true){
                            $arrayInnerSubMenus = [];
                            $arrayCanAny = [];
                            foreach ($menu['innerSubMenus'] as $innerSubMenu) {
                                array_push($arrayCanAny, $innerSubMenu['canany']);
                                array_push($arrayInnerSubMenus, $innerSubMenu['class']);
                            }
                        }
                    @endphp

                    @canany($arrayCanAny)
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                        {{in_array($moduleNav,$arrayInnerSubMenus) ? 'show' : ''}}    

                        ">
                            <span class="menu-link">
                                <span class="menu-icon"> 
                                    {!! $menu['subMenuIcon'] !!}
                                </span>
                                <span class="menu-title">{{ $menu['menu-title'] }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @foreach ($menu['innerSubMenus'] as $innerSubMenu)
                                    @can($innerSubMenu['canany'] )
                                    <div class="menu-item {{$moduleNav==$innerSubMenu['class'] ? 'here' : ''}}">
                                        <a class="menu-link" href="{{$innerSubMenu['url']}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ $innerSubMenu['title'] }}</span>
                                        </a>
                                    </div>
                                    @endcan
                                @endforeach
                            </div>
                        </div>
                    @endcanany
                @else
                    @php
                        if(isset($menu['innerSubMenu']) && $menu['innerSubMenu'] == false){
                            $arrayInnerSubMenus = [];
                            $arrayCanAny = [];
                            foreach ($menu['innerSubMenus'] as $innerSubMenu) {
                                array_push($arrayCanAny, $innerSubMenu['canany']);
                                array_push($arrayInnerSubMenus,$innerSubMenu['class']);
                            }
                        }
                    @endphp

                    @foreach ($menu['innerSubMenus'] as $item)
                        @can($item['canany'])
                        <div class="menu-item {{$moduleNav==$item['class'] ? 'here' : ''}}">
                            <a class="menu-link" href="{{$item['url']}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ $item['title'] }}</span>
                            </a>
                        </div>
                        @endcan
                    @endforeach     
                @endif
            @endforeach
        </div>
    </div>
@endcan
