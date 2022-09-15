@extends("admin.open_layout.index")
@section("content")

    {{--    test blade  create template then fill with variables --}}
    <div class="flex flex-col space-y-3">
        {{--    insert there new created livewire--}}
        {{--    give the title--}}
        <x-helper.text.title>{{__("Подкатегории от") ?? ""}} {{App\Domain\Category\Front\SubCategory\SubCategory::find($params)->name_current ?? ""}}</x-helper.text.title>
        <div class="flex flex-row">
            <div class='self-end'>
                    <x-helper.button.main_button href='{{route("admin.sub_category.create", array_merge([], \Request::query())) ?? ""}}'>
                              {{__('Создать')}}
                     </x-helper.button.main_button>
                     </div>
        </div>
        <hr class="border-dashed border-title_color"/>
        <div class="flex flex-row">
            
        </div>
        {{--    insert name of the breadcrumbs and the arguments--}}
        <div class="w-full ">
            
<livewire:admin.pages.sub-category.sub-category
            :filterBy="['parent_id' => $params,]" />
        </div>
    </div>
@endsection
@section("new_header")
                <x-helper.header.header/>
            @endsection