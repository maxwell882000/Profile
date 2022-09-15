@extends("admin.layout.edit")
@section("action")
    
<livewire:components.drop-down.drop-down-search
            :searchByKey='"name"'
            dropDownClass='App\Domain\Category\Front\Admin\DropDown\CategoryDropDownSearchFirst'
            :initial='$entity->category_id'
            searchLabel='названию Категорий'
            
            emiting='fromCategory'
             />
<x-helper.input.input name='color' type='color'
            label='{{__("Выберите цвет шрифта при наведение")}}' value='{{old("color") ?? $entity->color ?? " "}}' id='color' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='back_color' type='color'
            label='{{__("Выберите задний цвет при наведение")}}' value='{{old("back_color") ?? $entity->back_color ?? " "}}' id='back_color' oninput='' placeholder=''  onkeyup=""  />
@endsection
@section("new_header")
                <x-helper.header.header/>
            @endsection
@section("sidebar")
    <div class="">
        <x-helper.sidebar.new_sidebar name="Админ" :list="\SideBar::sideBars()"/>
    </div>
@endsection
