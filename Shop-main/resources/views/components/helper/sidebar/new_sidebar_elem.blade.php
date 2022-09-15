@props(['item'])
<a href="{{$item->route_name}}">
    <div x-data="{add_style:false}"
         @mouseover="add_style = true"
         @mouseleave="add_style = false"
         class="
@if($item->isCurrentRoute())
             bg-white border-r-4 @endif drop_element">
        <div class="hover_side_item text-lg">
            <div class="drop_helper_text">
                <div class="sidebar-icon" :class="
                {'text-2xl fa-fw ':isSideBarOpen,
                 'text-side_hovering': add_style,
                 'text-xl': !isSideBarOpen}">
                    <span
                        class="@if($item->isCurrentRoute()) text-xl text-side_hovering @endif  fas {{$item->icon}}"></span>
                </div>
                <div x-show="!isSideBarOpen">
                        <span :class="add_style && 'text-side_hovering'"
                              class="text-[.860rem] w-full font-medium">{{$item->name}}</span>
                </div>
            </div>
            <div>
            </div>
        </div>
    </div>

</a>
