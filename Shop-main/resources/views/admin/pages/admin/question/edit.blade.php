@extends("admin.layout.edit")
@section("action")
    

            <div class='flex flex-col w-full space-y-1'>
            <x-helper.text.pre_title class='self-start'>
            Вопросы
            </x-helper.text.pre_title>
                 <div class=' flex flex-row space-x-2'>
                 <x-helper.input.input name='question[ru]' class_div='w-1/4' label='{{__("на русском языке")}}'  value='{{old("question") ? old("question")["ru"] ?? $entity->question["ru"] ?? " " : $entity->question["ru"] ?? " "}}'  /><x-helper.input.input name='question[uz]' class_div='w-1/4' label='{{__("o`zbek tilda")}}'  value='{{old("question") ? old("question")["uz"] ?? $entity->question["uz"] ?? " " : $entity->question["uz"] ?? " "}}'  /><x-helper.input.input name='question[en]' class_div='w-1/4' label='{{__("in english")}}'  value='{{old("question") ? old("question")["en"] ?? $entity->question["en"] ?? " " : $entity->question["en"] ?? " "}}'  />
             </div>
            </div>
            

            <div class='flex flex-col w-full space-y-1'>
            <x-helper.text.pre_title class='self-start'>
            Ответы
            </x-helper.text.pre_title>
                <div class='space-y-2'><x-helper.text_area.text_area  name='answer[ru]'  label='{{__("на русском языке")}}'>{{old("answer") ? old("answer")["ru"] ?? $entity->answer["ru"] ?? " " : $entity->answer["ru"] ?? " "}}</x-helper.text_area.text_area><x-helper.text_area.text_area  name='answer[uz]'  label='{{__("o`zbek tilda")}}'>{{old("answer") ? old("answer")["uz"] ?? $entity->answer["uz"] ?? " " : $entity->answer["uz"] ?? " "}}</x-helper.text_area.text_area><x-helper.text_area.text_area  name='answer[en]'  label='{{__("in english")}}'>{{old("answer") ? old("answer")["en"] ?? $entity->answer["en"] ?? " " : $entity->answer["en"] ?? " "}}</x-helper.text_area.text_area></div>
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
