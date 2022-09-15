@extends("layout.admin_layout")
@section("content")
    {{--    test blade  create template then fill with variables --}}
    <div class="flex flex-col space-y-1">
        {{--    insert there new created livewire--}}
        {{--    give the title--}}
        <div class="flex flex-row justify-between pr-10">
            <x-helper.text.title>{{__("Настройки") ?? ""}}</x-helper.text.title>
            <div class='self-end'>
                    <x-helper.button.main_button href='{{route("admin.main_credit.create", array_merge([], \Request::query())) ?? ""}}'>
                              {{__('Создать')}}
                     </x-helper.button.main_button>
                     </div>
        </div>

        <hr class="border-dashed border-title_color"/>
        <div class="flex flex-row">
            <livewire:components.schema-sms.schema-sms-livewire selected_class='App\Domain\SchemaSms\Entities\SchemaSmsInstallment' />
        </div>
        {{--    insert name of the breadcrumbs and the arguments--}}
        <div class="w-full pb-10 ">
            

            <div 	class='space-y-2  pr-2'>
                			

            <div 	class='justify-between flex flex-row  space-x-2'>
                			

            <div 	class='border border-blue-300 p-2 bg-white rounded shadow w-max'>
            <span class='font-bold text-[1.09rem]'>{{__('Курс валюты')}}</span>
                			
<livewire:components.currency-field.currency/>
            </div>			

            <div 	class='border border-blue-300 p-2 bg-white rounded shadow w-max'>
            <span class='font-bold text-[1.09rem]'>{{__('Удержка Денег')}}</span>
                			
<livewire:components.currency-field.money/>
            </div>
            </div>			
<x-helper.container.container :title='__("Виды рассрочки")' 	class='flex flex-wrap justify-between'>
                			
<livewire:admin.pages.main-credit.main-credit-index />
                </x-helper.container.container>
            </div>
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
