<div>
    
<x-helper.error.error/>
<x-helper.input.input name='plastic_id' type='text'
            label='{{__("")}}' value='{{old("plastic_id") ?? $entity->plastic_id ?? " "}}' id='plastic_id' oninput='' placeholder=''  onkeyup=""  	class='hidden'	wire:model='plastic_id'/>

            <div 	class='items-end flex flex-row  space-x-2'>
                			
<x-helper.input.input name='card_number' type='text'
            label='{{__("Номер карты")}}' value='{{old("card_number") ?? $entity->card_number ?? " "}}' id='card_number' oninput='' placeholder=''  onkeyup=""  	id='card_number'	oninput='formatCardNumber(event)'	placeholder='**** **** **** ****'	wire:model.defer='card_number'/>			

            <div 	class='w-32'>
                			
<x-helper.input.input name='date_number' type='text'
            label='{{__("Срок годности")}}' value='{{old("date_number") ?? $entity->date_number ?? " "}}' id='date_number' oninput='' placeholder=''  onkeyup=""  	id='date_number'	oninput='formatDateForCard(event)'	placeholder='mm/yy'	wire:model.defer='date_number'/>
            </div>			

            <div 	x-data='modalWindow() '	@open-dialog.window='open()'	@close-dialog.window='show = false'>
                			
<x-helper.button.base_button 	class='bg-blue-600 hover:bg-blue-400 '	wire:click='sendSms()'>Получить код</x-helper.button.base_button>			
<div x-cloak 	x-show='show'><div

    class="fixed z-10 h-full w-full inset-0 hide_during_loading  overflow-y-auto" aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class=" sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left
            shadow-xl transform transition-all sm:my-8 sm:align-middle
            sm:max-w-max sm:w-full">
            			

            <div 	class='block p-5 space-y-4'>
                			
<x-helper.error.error/>			
<span 	class='text-2xl block text-center font-bold'>{{__('Получить код')}}</span>			
<x-helper.input.input name='code' type='number'
            label='{{__("Введите код")}}' value='{{old("code") ?? $entity->code ?? " "}}' id='code' oninput='' placeholder=''  onkeyup=""  />			

            <div 	class='self-end'>
                			
<x-helper.button.base_button 	class='bg-gray-600 hover:bg-gray-400 '	@click='show = false'>Отмена</x-helper.button.base_button>			
<x-helper.button.base_button 	class='bg-blue-600 hover:bg-blue-400 '	wire:click='getCode()'>Подтвердить</x-helper.button.base_button>
            </div>
            </div>
        </div>
    </div>
</div>

</div>
            </div>
            </div>
</div>
