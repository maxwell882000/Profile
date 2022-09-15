@extends("layout.admin_layout")
@section("content")

    {{--    test blade  create template then fill with variables --}}
    <div x-data="setInitWidth()"
         @sidebar-event.window="setWidth($event)"
         class="flex flex-col space-y-3">
        {{--    insert there new created livewire--}}
        {{--    give the title--}}
        <x-helper.text.title>{{ __("Информация о ручной рассрочке  #") . $entity->contract_num ?? $form->title}}</x-helper.text.title>
        <hr class="border-dashed border-title_color"/>
        {{--    insert name of the breadcrumbs and the arguments--}}
        <div class="w-full pr-4">
            

            <div 	class='space-y-4 mr-4'>
                			

            <div 	class='w-full flex flex-row  space-x-2'>
                			

            <div 	class='basis-5/12  flex flex-col  space-y-2'>
                			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Информация о клиенте')}}</span>
                			
<x-helper.text.text_key key="Имя клиента" value='{{$entity->name ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Номер телефона" value='{{$entity->plastic->phone ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Номер карты" value='{{$entity->plastic->card_number ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>
            </div>			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Информация о кредите')}}</span>
                			
<x-helper.text.text_key key="Номер Договора" value='{{$entity->contract_num ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Сумма договора" value='{{ $entity->allToPayShow() . " сум "   . " ( " .  $entity->initial_price_show . " сум " . __("первоначальный") . ")" }} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Товары" value='{{$entity->product ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Первоначальная оплата" value='{{$entity->initial_price_show ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Ежемесячный платеж" value='{{$entity->eachMonthPaymentShow() ?? ""}} сум "{{$entity->nextPayDate() ?? ""}}"  ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Количество месяцев" value='{{$entity->number_month ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Процент" value='{{$entity->credit->percent ?? ""}} %' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			

            <div >
                			
@if($entity->penny) 			
<x-helper.text.text_key key="Пенни" value='{{$entity->penny_show ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
 @endif
            </div>
            </div>			
<livewire:admin.pages.condition-attribute.condition-attribute   :entity='$entity'/>
            </div>			

            <div 	class='flex-1  flex flex-col  space-y-2'>
                			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Сведения об оплате')}}</span>
                			
<livewire:admin.pages.custom-installment-show.custom-monthly-paid-index
            :filterBy="['taken_credit_id' => $entity->id,]" />
            </div>			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Комментарии')}}</span>
                			
<livewire:admin.pages.custom-installment-show.custom-comment-dynamic 
        
                 parentKey='taken_credit_id'
                :parentId='$entity->id'/>
            </div>			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Журнал авто списаний')}}</span>
                			
<livewire:admin.pages.custom-installment-show.custom-time-schedule-index
            :filterBy="['taken_credit_id' => $entity->id,]" />
            </div>
            </div>
            </div>			
<livewire:admin.pages.custom-installment-show.custom-plastic-card-dynamic 
        
                 parentKey='taken_credit_id'
                :parentId='$entity->id'/>
            </div>
        </div>

        <div>
            <x-helper.button.gray_button type="button" href="{{$form->route_back}}" class="p-2">
                {{__("Назад")}}
            </x-helper.button.gray_button>
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
