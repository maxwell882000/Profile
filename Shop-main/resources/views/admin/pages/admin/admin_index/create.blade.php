@extends("admin.layout.create")
@section("action")
    
<x-helper.input.input name='phone' type='text'
            label='{{__("Телефон пользователя")}}' value='{{old("phone") ?? $entity->phone ?? " "}}' id='phone' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='password' type='password'
            label='{{__("Пароль")}}' value='' id='password' oninput='' placeholder=''  onkeyup=""  />
<x-helper.drop_down.drop_down :drop='\App\Domain\User\Front\Admin\DropDown\RoleDropDown::getDropDown($entity->role->role ?? "" )' />
@endsection
@section("new_header")
                <x-helper.header.header/>
            @endsection
@section("sidebar")
    <div class="">
        <x-helper.sidebar.new_sidebar name="Админ" :list="\SideBar::sideBars()"/>
    </div>
@endsection
