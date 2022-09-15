@extends("admin.layout.create")
@section("action")
    
<x-installment.sum/>
<livewire:components.drop-down.drop-down-search-with-relation
            :searchByKey='"phone"'
            dropDownClass='App\Domain\Installment\Front\Admin\DropDown\UserInstallmentDropDownRelation'
            
            searchLabel='номеру пользователя'
            
            
        dropDownAssociatedClass='App\Domain\User\Front\Admin\DropDown\PlasticCardDropDownAssociated'
        dispatchClass='App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch'
        
             />
<livewire:components.drop-down.drop-down-search-with-relation
            :searchByKey='"name->" . app()->getLocale()'
            dropDownClass='App\Domain\CreditProduct\Front\Admin\DropDown\MainCreditDropDownRelation'
            
            searchLabel='названию Рассрочки'
            
            
        dropDownAssociatedClass='App\Domain\CreditProduct\Front\Admin\DropDown\CreditDropDownAssociated'
        dispatchClass='App\Domain\Installment\Front\Admin\Dispatch\DispatchCredit'
        
             />
<x-helper.input.input name='initial_price' type='number'
            label='{{__("Первоначальная плата")}}' value='{{old("initial_price") ?? $entity->initial_price ?? " "}}' id='initial_payment' oninput='' placeholder=''  onkeyup="$dispatch('pay-update', {
               data:{
                    value: event.target.value
               }
            })"  />
<x-helper.input.input_checked name='payment_type' type='checkbox'
            label='{{__("Уплачен на кассе")}}' value='{{old("payment_type") ?? $entity->payment_type ?? " "}}' id='initial_pay' oninput='' placeholder=''  onchange=""  />
<livewire:admin.pages.taken-credit.product-installment-nested
                keyToAttach='products'
                dispatchClass='App\Domain\Installment\Front\Admin\Dispatch\DispatchProduct'
                additionalAction='App\Domain\Product\Product\Front\Admin\AdditionalActions\GenerateRuleProductAdditionalAction'
                />

            <div 	class='border-2 rounded p-2 w-full justify-start items-start  flex flex-col  space-y-2'>
                			
<x-helper.input.input_checked name='delivery' type='checkbox'
            label='{{__("Будет доставка")}}' value='{{old("delivery") ?? $entity->delivery ?? " "}}' id='payment_type' oninput='' placeholder=''  onchange="$dispatch('delivery-update', {
               data:{
                    value: event.target.value
               }
            })"  />			

            <div 	class='space-y-4 w-full'	x-data='{show: false}'	:class='show && " " || "hidden"'>
                			

            <div 	@delivery-update.window='show = !show'>
                			
<livewire:components.drop-down.drop-down-search
            :searchByKey='"cityName"'
            dropDownClass='App\Domain\Installment\Front\Admin\DropDown\IntsallmentCityDropDown'
            
            searchLabel='названию городу'
            
            
             />			

            <div 	class='p-2'>
                
            </div>			

            <div 	class='flex flex-wrap justify-between items-around'>
                			
<x-helper.input.input name='purchase->delivery_address->index' type='number'
            label='{{__("Индекс")}}' value='{{old("purchase->delivery_address->index") ?? $entity->purchase->delivery_address->index ?? " "}}' id='purchase->delivery_address->index' oninput='' placeholder=''  onkeyup=""  />			
<x-helper.input.input name='purchase->delivery_address->street' type='text'
            label='{{__("Улица")}}' value='{{old("purchase->delivery_address->street") ?? $entity->purchase->delivery_address->street ?? " "}}' id='purchase->delivery_address->street' oninput='' placeholder=''  onkeyup=""  />			
<x-helper.input.input name='purchase->delivery_address->house' type='number'
            label='{{__("Номер дома")}}' value='{{old("purchase->delivery_address->house") ?? $entity->purchase->delivery_address->house ?? " "}}' id='purchase->delivery_address->house' oninput='' placeholder=''  onkeyup=""  />			
<x-helper.input.input name='purchase->delivery_address->flat' type='number'
            label='{{__("Этаж")}}' value='{{old("purchase->delivery_address->flat") ?? $entity->purchase->delivery_address->flat ?? " "}}' id='purchase->delivery_address->flat' oninput='' placeholder=''  onkeyup=""  />
            </div>			

            <div 	class='p-2'>
                
            </div>			
<x-helper.text_area.text_area name='purchase->delivery_address->instructions' label='Инструкции для курьера' >{{old("purchase->delivery_address->instructions") ?? $entity->purchase->delivery_address->instructions ?? " "}}</x-helper.text_area.text_area>
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
