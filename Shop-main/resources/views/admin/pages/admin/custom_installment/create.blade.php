@extends("admin.layout.create_next")
@section("action")
    

            <div 	class='w-full justify-between'	x-data='installment()'>
                			

            <div 	class='space-x-0 flex flex-row  space-x-2'>
                			

            <div 	class='flex-1 p-2 text-white '	:class='show == 0 ? "bg-[#2489cc]" : "bg-[#BBBBBB]"'>
                			
<span >Детали</span>
            </div>			

            <div 	class='flex-1 p-2 text-white '	:class='show == 1 ? "bg-[#2489cc]" : "bg-[#BBBBBB]"'>
                			
<span >Договор</span>
            </div>			

            <div 	class='flex-1 p-2 text-white '	:class='show == 2 ? "bg-[#2489cc]" : "bg-[#BBBBBB]"'>
                			
<span >Подтверждение</span>
            </div>
            </div>			

            <div 	class='flex flex-wrap m-auto justify-start items-end space-x-3 pr-3 space-y-5 w-full '	x-show='show === 0'	x-data='{price_value: 0}'>
                			

            <div 	class='w-full'>
                
            </div>			

            <div 	class='w-full border-t border-[#DDD] h-0 text-center'>
                			
<span 	class='relative top-[-11px] bg-[#FAFAFA] text-[#3498db] p-2'>Детали рассрочки</span>
            </div>			
<x-installment.sum/>			
<livewire:components.drop-down.drop-down-search-with-relation
            :searchByKey='"name->" . app()->getLocale()'
            dropDownClass='App\Domain\CreditProduct\Front\Admin\DropDown\MainCreditDropDownRelation'
            
            searchLabel='названию Рассрочки'
            
            
        dropDownAssociatedClass='App\Domain\CreditProduct\Front\Admin\DropDown\CreditDropDownAssociated'
        dispatchClass='App\Domain\Installment\Front\Admin\Dispatch\DispatchCredit'
        
             />			
<x-helper.input.input name='price' type='number'
            label='{{__("Сумма договора")}}' value='{{old("price") ?? $entity->price ?? " "}}' id='price' oninput='' placeholder=''  onkeyup="$dispatch('pay-full', {
               data:{
                    value: event.target.value
               }
            })"  />			
<x-helper.input.input name='initial_price' type='number'
            label='{{__("Первоначальная плата")}}' value='{{old("initial_price") ?? $entity->initial_price ?? " "}}' id='initial_payment' oninput='' placeholder=''  onkeyup="$dispatch('pay-update', {
               data:{
                    value: event.target.value
               }
            })"  />			
<x-helper.input.input_checked name='payment_type' type='checkbox'
            label='{{__("Уплачен на кассе")}}' value='{{old("payment_type") ?? $entity->payment_type ?? " "}}' id='initial_pay' oninput='' placeholder=''  onchange=""  />			
<x-helper.input.input name='penny' type='text'
            label='{{__("Пенни")}}' value='{{old("penny") ?? $entity->penny ?? " "}}' id='penny' oninput='onlyNumbers(event)' placeholder=''  onkeyup=""  />			

            <div 	class='w-full border-t border-[#DDD] h-0 text-center'>
                			
<span 	class='relative top-[-11px] bg-[#FAFAFA] text-[#3498db] p-2'>Детали карты</span>
            </div>			
<livewire:admin.pages.plastic-attribute.plastic-attribute />			

            <div 	class='justify-end w-full py-2 flex flex-row  space-x-2'>
                			

            <div >
                			
<x-helper.button.base_button 	class='bg-blue-600 hover:bg-blue-400 '	@click='show = 1'>Далее</x-helper.button.base_button>
            </div>
            </div>
            </div>			

            <div 	class='flex flex-wrap m-auto justify-start items-end space-x-3 pr-3 space-y-5 w-full '	x-show='show === 1'>
                			

            <div 	class='w-full'>
                
            </div>			
<x-helper.input.input name='name' type='text'
            label='{{__("Ф.И.O клиента")}}' value='{{old("name") ?? $entity->name ?? " "}}' id='name' oninput='' placeholder=''  onkeyup=""  />			
<x-helper.input.input name='phone' type='text'
            label='{{__("Телефонный номер")}}' value='{{old("phone") ?? $entity->phone ?? " "}}' id='phone' oninput='' placeholder=''  onkeyup=""  	@plastic-phone.window='phone = $event.detail.value'	x-model='phone'/>			
<x-helper.text_area.text_area name='product' label='Товары' >{{old("product") ?? $entity->product ?? " "}}</x-helper.text_area.text_area>			

            <div 	class='justify-end w-full py-2 flex flex-row  space-x-2'>
                			
<x-helper.button.base_button 	class='bg-gray-600 hover:bg-gray-400 m-0'	@click='show = 0'>Назад</x-helper.button.base_button>			
<x-helper.button.base_button 	class='bg-blue-600 hover:bg-blue-400 m-0'	type='submit'	id='real_submit'>Сохранить</x-helper.button.base_button>
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
