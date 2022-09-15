@extends("layout.admin_layout")
@section("content")
    {{--    test blade  create template then fill with variables --}}
    <div class="flex flex-col space-y-1">
        {{--    insert there new created livewire--}}
        {{--    give the title--}}
        <div class="flex flex-row justify-between pr-10">
            <x-helper.text.title>{{__("Брэнд") ?? ""}}</x-helper.text.title>
            <div class='self-end'>
                    <x-helper.button.main_button href='{{route("admin.brand.create", array_merge([], \Request::query())) ?? ""}}'>
                              {{__('Создать')}}
                     </x-helper.button.main_button>
                     </div>
        </div>

        <hr class="border-dashed border-title_color"/>
        <div class="flex flex-row">
            
        </div>
        {{--    insert name of the breadcrumbs and the arguments--}}
        <div class="w-full pb-10 ">
            
<livewire:admin.pages.brand.brand-index />
        </div>
    </div>
@endsection

@section("new_header")
                <x-helper.header.header/>
            @endsection
@section("sidebar")
    <div class="">
        <x-helper.sidebar.new_sidebar name="Админ" :list="\SideBar::sideBars()"/>
    </div>
@endsection
