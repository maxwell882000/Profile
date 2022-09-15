@extends("admin.layout.edit")
@section("action")
    

            <div 	class='space-y-4  w-full'	@redirect-show.window='window.location = `{{  route('admin.taken_credit.show', $entity->id) }}`'>
                			

            <div 	class='w-full flex flex-row  space-x-2'>
                			

            <div 	class='basis-5/12  flex flex-col  space-y-2'>
                			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Информация о клиенте')}}</span>
                			
<x-helper.text.text_key_link key='Имя клиента' value='{{$entity->userData->crucialData->name ?? ""}}' :link='route("admin.user.show", array_merge(["0" => $entity->user_id,], \Request::query()))'></x-helper.text.text_key_link>			
<x-helper.text.text_key key="Номер телефона" value='{{$entity->plastic->phone ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Номер карты" value='{{$entity->plastic->card_number ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Имеются долги" value='{{$entity->userData->crucialData->old_dept_string ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
@if($entity->userData->crucialData->dept_sum) 			
<x-helper.text.text_key key="Сумма долга" value='{{$entity->userData->crucialData->dept_sum_show ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
 @endif
            </div>			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Информация о кредите')}}</span>
                			
<x-helper.text.text_key key="Номер Договора" value='{{$entity->purchase->id ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Количество покупок" value='{{$entity->purchase->number_purchase ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Сумма договора" value='{{ $entity->allToPayShow() . " сум "   . " ( " .  $entity->initial_price_show . " сум " . __("первоначальный") . ")" }} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Первоначальная оплата" value='{{$entity->initial_price_show ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Ежемесячный платеж" value='{{$entity->eachMonthPaymentShow() ?? ""}} сум "{{$entity->nextPayDate() ?? ""}}"  ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextValueAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Количество месяцев" value='{{$entity->number_month ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Процент" value='{{$entity->credit->percent ?? ""}} %' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.input.input name='penny' type='text'
            label='{{__("Пенни")}}' value='{{old("penny") ?? $entity->penny ?? " "}}' id='penny' oninput='onlyNumbers(event)' placeholder=''  onkeyup=""  />
            </div>			
@if($entity->surety) 			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Информация о поручители')}}</span>
                			
<x-helper.text.text_key key="Имя" value='{{$entity->surety->crucialData->name ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Серия паспорта" value='{{$entity->surety->crucialData->series ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="ПНФЛ" value='{{$entity->surety->crucialData->pnfl ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Телефон" value='{{$entity->surety->phone ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Дополнительный номер" value='{{$entity->surety->additional_phone ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key key="Дата рождения" value='{{$entity->surety->crucialData->date_of_birth ?? ""}} ' class_value='App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute'></x-helper.text.text_key>			
<x-helper.text.text_key_link key='Паспорт' value='Скачать' :link='route("download.file", ["path"=> $entity->surety->crucialData->passport->path])'></x-helper.text.text_key_link>			
<x-helper.text.text_key_link key='Прописка' value='Скачать' :link='route("download.file", ["path"=> $entity->surety->crucialData->passport_reverse->path])'></x-helper.text.text_key_link>			
<x-helper.text.text_key_link key='Паспорт c пользователем' value='Скачать' :link='route("download.file", ["path"=> $entity->surety->crucialData->user_passport->path])'></x-helper.text.text_key_link>
            </div>			
 @endif			

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
<livewire:admin.pages.condition-attribute.condition-attribute   :entity='$entity'/>
            </div>			

            <div 	class='flex-1  flex flex-col  space-y-2'>
                			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Сведения об оплате')}}</span>
                			
<livewire:admin.pages.taken-credit-edit.monthly-paid-index
            :filterBy="['taken_credit_id' => $entity->id,]" />
            </div>			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Комментарии')}}</span>
                			
<livewire:admin.pages.taken-credit-edit.comment-installment-dynamic 
        
                 parentKey='taken_credit_id'
                :parentId='$entity->id'/>
            </div>			

            <div 	class=' border shadow p-4 space-y-4 bg-white'>
            <span class='font-bold text-[1.09rem]'>{{__('Журнал авто списаний')}}</span>
                			
<livewire:admin.pages.taken-credit-edit.time-schedule-transaction-index
            :filterBy="['taken_credit_id' => $entity->id,]" />
            </div>
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
<livewire:admin.pages.taken-credit-edit.plastic-card-taken-credit-dynamic 
        
                 parentKey='taken_credit_id'
                :parentId='$entity->id'/>			

            <div >
                			
@if(!$entity->surety_id) 			
<x-helper.container.container :title='__("Добавить поручателя")' 	class='flex flex-wrap justify-between'>
                			

<x-helper.input.input name='surety->phone' type='text'
            label='{{__("Телефон пользователя")}}' value='{{old("surety->phone") ?? $entity->surety->phone ?? " "}}' id='surety->phone' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->additional_phone' type='text'
            label='{{__("Дополнительный телефон")}}' value='{{old("surety->additional_phone") ?? $entity->surety->additional_phone ?? " "}}' id='surety->additional_phone' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->firstname' type='text'
            label='{{__("Имя пользователя")}}' value='{{old("surety->crucialData->firstname") ?? $entity->surety->crucialData->firstname ?? " "}}' id='surety->crucialData->firstname' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->lastname' type='text'
            label='{{__("Фамилия пользователя")}}' value='{{old("surety->crucialData->lastname") ?? $entity->surety->crucialData->lastname ?? " "}}' id='surety->crucialData->lastname' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->father_name' type='text'
            label='{{__("Отчество пользователя")}}' value='{{old("surety->crucialData->father_name") ?? $entity->surety->crucialData->father_name ?? " "}}' id='surety->crucialData->father_name' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->series' type='text'
            label='{{__("Паспорт серия")}}' value='{{old("surety->crucialData->series") ?? $entity->surety->crucialData->series ?? " "}}' id='surety->crucialData->series' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->pnfl' type='text'
            label='{{__("ПНФЛ")}}' value='{{old("surety->crucialData->pnfl") ?? $entity->surety->crucialData->pnfl ?? " "}}' id='surety->crucialData->pnfl' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->date_of_birth' type='date'
            label='{{__("Дата рождения")}}' value='{{old("surety->crucialData->date_of_birth") ?? $entity->surety->crucialData->date_of_birth ?? " "}}' id='surety->crucialData->date_of_birth' oninput='' placeholder=''  onkeyup=""  />
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='surety->crucialData->passport_reverse'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Прописка")'
                    :entityId='old("file->id_file->surety->crucialData->passport_reverse") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='surety->crucialData->user_passport'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Паспорт c пользователем")'
                    :entityId='old("file->id_file->surety->crucialData->user_passport") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='surety->crucialData->passport'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Паспорт пользователя")'
                    :entityId='old("file->id_file->surety->crucialData->passport") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />
                </x-helper.container.container>			
@else 			
<x-helper.container.container :title='__("Изменить поручателя")' 	class='flex flex-wrap justify-between'>
                			

<x-helper.input.input name='surety->phone' type='text'
            label='{{__("Телефон пользователя")}}' value='{{old("surety->phone") ?? $entity->surety->phone ?? " "}}' id='surety->phone' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->additional_phone' type='text'
            label='{{__("Дополнительный телефон")}}' value='{{old("surety->additional_phone") ?? $entity->surety->additional_phone ?? " "}}' id='surety->additional_phone' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->firstname' type='text'
            label='{{__("Имя пользователя")}}' value='{{old("surety->crucialData->firstname") ?? $entity->surety->crucialData->firstname ?? " "}}' id='surety->crucialData->firstname' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->lastname' type='text'
            label='{{__("Фамилия пользователя")}}' value='{{old("surety->crucialData->lastname") ?? $entity->surety->crucialData->lastname ?? " "}}' id='surety->crucialData->lastname' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->father_name' type='text'
            label='{{__("Отчество пользователя")}}' value='{{old("surety->crucialData->father_name") ?? $entity->surety->crucialData->father_name ?? " "}}' id='surety->crucialData->father_name' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->series' type='text'
            label='{{__("Паспорт серия")}}' value='{{old("surety->crucialData->series") ?? $entity->surety->crucialData->series ?? " "}}' id='surety->crucialData->series' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->pnfl' type='text'
            label='{{__("ПНФЛ")}}' value='{{old("surety->crucialData->pnfl") ?? $entity->surety->crucialData->pnfl ?? " "}}' id='surety->crucialData->pnfl' oninput='' placeholder=''  onkeyup=""  />
<x-helper.input.input name='surety->crucialData->date_of_birth' type='date'
            label='{{__("Дата рождения")}}' value='{{old("surety->crucialData->date_of_birth") ?? $entity->surety->crucialData->date_of_birth ?? " "}}' id='surety->crucialData->date_of_birth' oninput='' placeholder=''  onkeyup=""  />
@if($entity->surety)  <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('components.file.file-uploading', ['entityId' => $entity->id,'mediaKey' => 'surety->crucialData->passport_reverse_edit','entityClass' => 'App\Domain\Installment\Front\Main\TakenCreditEdit','multiple' => false,'label' => 'Прописка'])->html();
} elseif ($_instance->childHasBeenRendered('gFrXRXg')) {
    $componentId = $_instance->getRenderedChildComponentId('gFrXRXg');
    $componentTag = $_instance->getRenderedChildComponentTagName('gFrXRXg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('gFrXRXg');
} else {
    $response = \Livewire\Livewire::mount('components.file.file-uploading', ['entityId' => $entity->id,'mediaKey' => 'surety->crucialData->passport_reverse_edit','entityClass' => 'App\Domain\Installment\Front\Main\TakenCreditEdit','multiple' => false,'label' => 'Прописка']);
    $html = $response->html();
    $_instance->logRenderedChild('gFrXRXg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?> <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('components.file.file-uploading', ['entityId' => $entity->id,'mediaKey' => 'surety->crucialData->passport_user_edit','entityClass' => 'App\Domain\Installment\Front\Main\TakenCreditEdit','multiple' => false,'label' => 'Паспорт c пользователем'])->html();
} elseif ($_instance->childHasBeenRendered('qYWUzzm')) {
    $componentId = $_instance->getRenderedChildComponentId('qYWUzzm');
    $componentTag = $_instance->getRenderedChildComponentTagName('qYWUzzm');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qYWUzzm');
} else {
    $response = \Livewire\Livewire::mount('components.file.file-uploading', ['entityId' => $entity->id,'mediaKey' => 'surety->crucialData->passport_user_edit','entityClass' => 'App\Domain\Installment\Front\Main\TakenCreditEdit','multiple' => false,'label' => 'Паспорт c пользователем']);
    $html = $response->html();
    $_instance->logRenderedChild('qYWUzzm', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?> <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('components.file.file-uploading', ['entityId' => $entity->id,'mediaKey' => 'surety->crucialData->passport_edit','entityClass' => 'App\Domain\Installment\Front\Main\TakenCreditEdit','multiple' => false,'label' => 'Паспорт пользователя'])->html();
} elseif ($_instance->childHasBeenRendered('bwFFDfb')) {
    $componentId = $_instance->getRenderedChildComponentId('bwFFDfb');
    $componentTag = $_instance->getRenderedChildComponentTagName('bwFFDfb');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('bwFFDfb');
} else {
    $response = \Livewire\Livewire::mount('components.file.file-uploading', ['entityId' => $entity->id,'mediaKey' => 'surety->crucialData->passport_edit','entityClass' => 'App\Domain\Installment\Front\Main\TakenCreditEdit','multiple' => false,'label' => 'Паспорт пользователя']);
    $html = $response->html();
    $_instance->logRenderedChild('bwFFDfb', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?> 
@else 
 @endif
                </x-helper.container.container>			
 @endif			

            <div 	class='mb-4'>
                
            </div>			
<livewire:admin.pages.decision-installment-attribute.decision-attribute   :entity='$entity'/>
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
