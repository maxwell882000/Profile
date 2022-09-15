@extends("admin.layout.edit")
@section("action")
    

            <div class='flex flex-col w-full space-y-1'>
            <x-helper.text.pre_title class='self-start'>
            Введите политика и конфиденциальность
            </x-helper.text.pre_title>
                <div class='space-y-2'><x-helper.text_area.text_area  name='policies[ru]'  label='{{__("на русском языке")}}'>{{old("policies") ? old("policies")["ru"] ?? $entity->policies["ru"] ?? " " : $entity->policies["ru"] ?? " "}}</x-helper.text_area.text_area><x-helper.text_area.text_area  name='policies[uz]'  label='{{__("o`zbek tilda")}}'>{{old("policies") ? old("policies")["uz"] ?? $entity->policies["uz"] ?? " " : $entity->policies["uz"] ?? " "}}</x-helper.text_area.text_area><x-helper.text_area.text_area  name='policies[en]'  label='{{__("in english")}}'>{{old("policies") ? old("policies")["en"] ?? $entity->policies["en"] ?? " " : $entity->policies["en"] ?? " "}}</x-helper.text_area.text_area></div>
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
