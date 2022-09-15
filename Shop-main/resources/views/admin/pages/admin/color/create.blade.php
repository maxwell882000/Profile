@extends("admin.layout.create")
@section("action")
    

            <div class='flex flex-col w-full space-y-1'>
            <x-helper.text.pre_title class='self-start'>
            Введите цвета
            </x-helper.text.pre_title>
                 <div class=' flex flex-row space-x-2'>
                 <x-helper.input.input name='color[ru]' class_div='w-1/4' label='{{__("на русском языке")}}'  value='{{old("color") ? old("color")["ru"] ?? $entity->color["ru"] ?? " " : $entity->color["ru"] ?? " "}}'  /><x-helper.input.input name='color[uz]' class_div='w-1/4' label='{{__("o`zbek tilda")}}'  value='{{old("color") ? old("color")["uz"] ?? $entity->color["uz"] ?? " " : $entity->color["uz"] ?? " "}}'  /><x-helper.input.input name='color[en]' class_div='w-1/4' label='{{__("in english")}}'  value='{{old("color") ? old("color")["en"] ?? $entity->color["en"] ?? " " : $entity->color["en"] ?? " "}}'  />
             </div>
            </div>
            
<x-helper.input.input name='color_hex' type='color'
            label='{{__("Выберите цвет")}}' value='{{old("color_hex") ?? $entity->color_hex ?? " "}}' id='color_hex' oninput='' placeholder=''  onkeyup=""  />
@endsection
@section("new_header")
                <x-helper.header.header/>
            @endsection
@section("sidebar")
    <div class="">
        <x-helper.sidebar.new_sidebar name="Админ" :list="\SideBar::sideBars()"/>
    </div>
@endsection
