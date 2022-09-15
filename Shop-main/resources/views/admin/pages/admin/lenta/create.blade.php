@extends("admin.layout.create")
@section("action")
    

            <div class='flex flex-col w-full space-y-1'>
            <x-helper.text.pre_title class='self-start'>
            Введите название
            </x-helper.text.pre_title>
                 <div class=' flex flex-row space-x-2'>
                 <x-helper.input.input name='text[ru]' class_div='w-1/4' label='{{__("на русском языке")}}'  value='{{old("text") ? old("text")["ru"] ?? $entity->text["ru"] ?? " " : $entity->text["ru"] ?? " "}}'  /><x-helper.input.input name='text[uz]' class_div='w-1/4' label='{{__("o`zbek tilda")}}'  value='{{old("text") ? old("text")["uz"] ?? $entity->text["uz"] ?? " " : $entity->text["uz"] ?? " "}}'  /><x-helper.input.input name='text[en]' class_div='w-1/4' label='{{__("in english")}}'  value='{{old("text") ? old("text")["en"] ?? $entity->text["en"] ?? " " : $entity->text["en"] ?? " "}}'  />
             </div>
            </div>
            
<livewire:admin.pages.lenta-create.product-nested
                keyToAttach='product'
                dispatchClass='App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch'
                additionalAction='App\Domain\Core\Front\Admin\Livewire\AdditionalActions\Base\AdditionalActions'
                />
<x-helper.drop_down.drop_down :drop='\App\Domain\Lenta\Front\Admin\DropDown\SideDropDown::getDropDown($entity->is_left ?? "" )' />
<x-helper.container.container :title='__("Картинка")' 	class='flex flex-wrap justify-between'>
                			
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='left_image->ru'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Русский")'
                    :entityId='old("file->id_file->left_image->ru") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />			
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='left_image->uz'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Узбекский")'
                    :entityId='old("file->id_file->left_image->uz") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />			
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='left_image->en'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Английский")'
                    :entityId='old("file->id_file->left_image->en") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />
                </x-helper.container.container>
@endsection
@section("new_header")
                <x-helper.header.header/>
            @endsection
@section("sidebar")
    <div class="">
        <x-helper.sidebar.new_sidebar name="Админ" :list="\SideBar::sideBars()"/>
    </div>
@endsection
