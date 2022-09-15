<div class="">
    <div x-data="table_init()" class=" text-sm table_checker my-1">
        <div class="flex flex-row justify-between">
            <x-helper.drop_down.drop_down_livewire_modal :drop="$optional" class="hidden checkbox-show"/>
            <div class="remove-checks">
                <x-helper.button.outline_button type="button" onclick="selectAll(this)" wire:click="checkAll"
                                                class="hidden checkbox-show">
                    {{__("выбрать все")}}
                </x-helper.button.outline_button>
                <x-helper.button.outline_button type="button" onclick="removeChecker(this)" wire:click="removeAll"
                                                class="hidden checkbox-show">
                    {{__("Выйти")}}
                </x-helper.button.outline_button>
            </div>
        </div>
        <table class="table_main"
               x-data="table_draggable()"
               {{--               x-on:drop.prevent="drop_start()"--}}
               x-on:dragover.prevent=""
               x-on:dragleave.prevent=""
               wire:loading.class="opacity-80">
            <thead>
            <tr class="@if(!isset($attributes['turn_off'])) longpress @endif">
                <th class="table_main_th hidden checkbox-show">{{__("Выбрать")}}</th>
                @foreach($table->columns as $column)
                    <th class="table_main_th">{{$column->column_name}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($table->list as $items)
                <tr
                    draggable="true"
                    index_of_drag="{{$items->order}}"
                    x-on:dragstart="drop_start()"
                    x-on:dragover="drop_over()"
                    x-on:drop="drop_end()"
                    wire:key="clean_table_{{$loop->index}}"
                    class="table_main_tr  bg-white ">
                    <td class="table_main_td hidden checker checkbox-show">
                        <label for="check{{$loop->index}}">
                            <input type="checkbox" wire:model="checkBox" value="{{$items->id}}"
                                   class="form-checkbox mt-2 w-5 h-5"/>
                        </label>
                    </td>
                    @foreach($table->columns as $row)
                        <td class="table_main_td {{$items->row_style}}">
                            <div class="flex  flex-row justify-center {{$items->row_style}}">
                                {!! $items[$row->key_to_row] !!}
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
            {{--some style will be here above to react on action--}}
        </table>

        {{$slot}}
    </div>
    {{$table->paginate->links()}}
</div>
