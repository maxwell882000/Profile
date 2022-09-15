@extends("admin.layout.create")
@section("action")
    
<x-helper.input.input name='link' type='text'
            label='{{__("Линк для банера")}}' value='{{old("link") ?? $entity->link ?? " "}}' id='link' oninput='' placeholder=''  onkeyup=""  />
<x-helper.container.container :title='__("Desktop")' 	class='flex flex-wrap justify-between'>
                			
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='image->ru'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Русский Баннер")'
                    :entityId='old("file->id_file->image->ru") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />			
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='image->uz'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Узбекский Баннер")'
                    :entityId='old("file->id_file->image->uz") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />			
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='image->en'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Английский Баннер")'
                    :entityId='old("file->id_file->image->en") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />
                </x-helper.container.container>
<x-helper.container.container :title='__("Мобилка")' 	class='flex flex-wrap justify-between'>
                			
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='image_mobile->ru'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Русский Баннер")'
                    :entityId='old("file->id_file->image_mobile->ru") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />			
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='image_mobile->uz'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Узбекский Баннер")'
                    :entityId='old("file->id_file->image_mobile->uz") ?? ""'
                    :mediaInitial='"" ?? ""'
                    wire:key=''
                     />			
<livewire:components.file.file-uploading-without-entity
                    keyToAttach='image_mobile->en'
                    mediaKey='file_create'
                    entityClass='App\Domain\File\Entities\FileTemp'
                    :multiple='false'
                    :label='__("Английский Баннер")'
                    :entityId='old("file->id_file->image_mobile->en") ?? ""'
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
