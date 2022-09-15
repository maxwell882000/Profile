@extends("admin.layout.edit")
@section("action")
    

            <div class='flex flex-col w-full space-y-1'>
            <x-helper.text.pre_title class='self-start'>
            Введите название
            </x-helper.text.pre_title>
                 <div class=' flex flex-row space-x-2'>
                 <x-helper.input.input name='name[ru]' class_div='w-1/4' label='{{__("на русском языке")}}'  value='{{old("name") ? old("name")["ru"] ?? $entity->name["ru"] ?? " " : $entity->name["ru"] ?? " "}}'  /><x-helper.input.input name='name[uz]' class_div='w-1/4' label='{{__("o`zbek tilda")}}'  value='{{old("name") ? old("name")["uz"] ?? $entity->name["uz"] ?? " " : $entity->name["uz"] ?? " "}}'  /><x-helper.input.input name='name[en]' class_div='w-1/4' label='{{__("in english")}}'  value='{{old("name") ? old("name")["en"] ?? $entity->name["en"] ?? " " : $entity->name["en"] ?? " "}}'  />
             </div>
            </div>
            

            <div class='flex flex-col w-full space-y-1'>
            <x-helper.text.pre_title class='self-start'>
            Введите условия
            </x-helper.text.pre_title>
                <div class='space-y-2'><x-helper.text_area.text_area  name='helper_text[ru]'  label='{{__("на русском языке")}}'>{{old("helper_text") ? old("helper_text")["ru"] ?? $entity->helper_text["ru"] ?? " " : $entity->helper_text["ru"] ?? " "}}</x-helper.text_area.text_area><x-helper.text_area.text_area  name='helper_text[uz]'  label='{{__("o`zbek tilda")}}'>{{old("helper_text") ? old("helper_text")["uz"] ?? $entity->helper_text["uz"] ?? " " : $entity->helper_text["uz"] ?? " "}}</x-helper.text_area.text_area><x-helper.text_area.text_area  name='helper_text[en]'  label='{{__("in english")}}'>{{old("helper_text") ? old("helper_text")["en"] ?? $entity->helper_text["en"] ?? " " : $entity->helper_text["en"] ?? " "}}</x-helper.text_area.text_area></div>
            </div>
            
<x-helper.input.input name='initial_percent' type='number'
            label='{{__("Введите первоначальный процент оплаты")}}' value='{{old("initial_percent") ?? $entity->initial_percent ?? " "}}' id='initial_percent' oninput='' placeholder=''  onkeyup=""  />
<livewire:admin.pages.main-credit.credit-dynamic-index 
        
                 parentKey='main_credit_id'
                :parentId='$entity->id'/>
@endsection
@section("new_header")
                <x-helper.header.header/>
            @endsection
@section("sidebar")
    <div class="">
        <x-helper.sidebar.new_sidebar name="Админ" :list="\SideBar::sideBars()"/>
    </div>
@endsection
