<x-helper.container.container :title="__('Укажите продукт')">
    <div class="flex flex-col space-y-3">
        <div class="flex flex-row justify-between">
            <div>
                <x-helper.input.input wire:model="search" label='{{__("Поиск по списку")}}'/>
            </div>

            <div>
                <x-helper.input.input class="w-14" wire:model="paginate" label='{{__("Показать")}}'/>
            </div>
            
        </div>
        <div class="flex flex-row  space-x-3">
            <div>
                <x-helper.button.main_button
                    type="button"
                    wire:click="changeToAdd()"
                >{{__("Весь список")}}</x-helper.button.main_button>
            </div>
            <div>
                <x-helper.button.main_button
                    type="button"
                    wire:click="changeToRemove()"
                >{{__("Добавленные")}}</x-helper.button.main_button>
            </div>

        </div>
        <x-helper.table.table :table="$table" :optional="$optional" >
         </x-helper.table.table>
        {{--        <x-helper.table.table :table="$table" :optional="$optional"/>--}}
    </div>
</x-helper.container.container>
