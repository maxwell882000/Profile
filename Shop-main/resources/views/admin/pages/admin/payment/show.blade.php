@extends("layout.admin_layout")
@section("content")

    {{--    test blade  create template then fill with variables --}}
    <div x-data="setInitWidth()"
         @sidebar-event.window="setWidth($event)"
         class="flex flex-col space-y-3">
        {{--    insert there new created livewire--}}
        {{--    give the title--}}
        <x-helper.text.title>{{ __("Информация о покупки  #") . $entity->purchase_id ?? $form->title}}</x-helper.text.title>
        <hr class="border-dashed border-title_color"/>
        {{--    insert name of the breadcrumbs and the arguments--}}
        <div class="w-full pr-4">
            

            <div 	class='w-full  space-x-4 my-2 flex flex-row  space-x-2'>
                			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Информация о клиенте')}}</span>
                			
<x-helper.text.text_key_link key='Имя клиента' value='{{$entity->user->userCreditData->crucialData->name ?? ""}}' :link='route("admin.user.show", array_merge(["0" => $entity->user_id,], \Request::query()))'></x-helper.text.text_key_link>			
@if($entity->purchase->isCash()) 			
<x-helper.text.text_key key="Тип оплаты" value='Наличка ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute'></x-helper.text.text_key>			
@else 			
<x-helper.text.text_key key="Номер карты" value='{{$entity->card->plastic->card_number ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
 @endif
            </div>			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Информация о покупке')}}</span>
                			
<x-helper.text.text_key key="Номер Договора" value='{{$entity->purchase->id ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Количество покупок" value='{{$entity->purchase->number_purchase ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
@if(!$entity->purchase->isDelivery()) 			
<x-helper.text.text_key key="Сумма общая сумма договора" value='{{$entity->price_show ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
@else 			
<x-helper.text.text_key key="Сумма товаров" value='{{$entity->purchase->sumPurchasesShow() ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Сумма доставки" value='{{$entity->purchase->sumDeliveryShow() ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
 @endif
            </div>			

            <div >
                			
@if($entity->purchase->isDelivery()) 			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Информация о доставке')}}</span>
                			
<x-helper.text.text_key key="{{__('Индекс')}}" value='{{$entity->purchase->delivery_address->index ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="{{__('Область')}}" value='{{$entity->purchase->delivery_address->availableCities->regionNameCurrent ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="{{__('Город доставки')}}" value='{{$entity->purchase->delivery_address->availableCities->cityNameCurrent ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="{{__('Адрес доставки')}}" value='{{$entity->purchase->delivery_address->street ?? ""}}, {{$entity->purchase->delivery_address->house ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="{{__('Специальные указания для курьера')}}" value='{{$entity->purchase->delivery_address->instructions ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute'></x-helper.text.text_key>			
@if($entity->purchase->delivery()->exists()) 			
<x-helper.text.text_key key="{{__('Количество посылок')}}" value='{{$entity->purchase->deliveryCount() ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Количество посылок доставлено" value='{{$entity->purchase->deliveredCount() ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
 @endif			
<x-helper.text.text_key key="Общая цена за доставку" value='{{$entity->purchase->sumDeliveryShow() ?? ""}} сум ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute'></x-helper.text.text_key>
            </div>			
 @endif
            </div>
            </div>
<x-helper.container.container :title='__("Товары")' 	class='flex flex-col flex flex-wrap justify-between'>
                			
@if($entity->purchase->isDelivery()) 			
<livewire:admin.pages.taken-credit-edit-delivery.purchase-main-delivery
            :filterBy="['user_purchase_id' => $entity->purchase_id,]" />			
@else 			
<livewire:admin.pages.taken-credit-edit.purchase-main
            :filterBy="['user_purchase_id' => $entity->purchase_id,]" />			
 @endif
                </x-helper.container.container>

            <div 	class='mt-2'>
                			
<livewire:admin.pages.decision-attribute-for-payment.decision-attribute   :entity='$entity'/>
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
