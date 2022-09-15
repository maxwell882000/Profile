<div class="drag-and-drop" x-data="{ adding: false, removing: false }">
    <div class="drag-and-drop__container drag-and-drop__container--from">
        <h3 class="drag-and-drop__title">From</h3>
        <ul
            class="drag-and-drop__items"
            :class="{ 'drag-and-drop__items--removing': removing }"
            x-on:drop="removing = false"
            {{--            append child to correct place --}}
            x-on:drop.prevent="
                const target = event.target.closest('ul');
                const element = document.getElementById(event.dataTransfer.getData('text/plain'));
                target.appendChild(element);
            "
            x-on:dragover.prevent="removing = true"
            x-on:dragleave.prevent="removing = false">
            <!-- loop through the items -->
            <li
                id="item-1"
                class="drag-and-drop__item"
                :class="{ 'drag-and-drop__item--dragging': dragging }"
                {{--                move child to correct place --}}
                x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                x-on:dragend="dragging = false"
                x-data="{ dragging: false }"
                draggable="true">
                Your Item #1
            </li>
            <li
                id="item-2"
                class="drag-and-drop__item"
                :class="{ 'drag-and-drop__item--dragging': dragging }"
                x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                x-on:dragend="dragging = false"
                x-data="{ dragging: false }"
                draggable="true">
                Your Item #2
            </li>
            <li
                id="item-3"
                class="drag-and-drop__item"
                :class="{ 'drag-and-drop__item--dragging': dragging }"
                x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                x-on:dragend="dragging = false"
                x-data="{ dragging: false }"
                draggable="true">
                Your Item #3
            </li>
            <li
                id="item-4"
                class="drag-and-drop__item"
                :class="{ 'drag-and-drop__item--dragging': dragging }"
                x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                x-on:dragend="dragging = false"
                x-data="{ dragging: false }"
                draggable="true">
                Your Item #4
            </li>
            <li
                id="item-5"
                class="drag-and-drop__item"
                :class="{ 'drag-and-drop__item--dragging': dragging }"
                x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                x-on:dragend="dragging = false"
                x-data="{ dragging: false }"
                draggable="true">
                Your Item #5
            </li>
            <li
                id="item-6"
                class="drag-and-drop__item"
                :class="{ 'drag-and-drop__item--dragging': dragging }"
                x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                x-on:dragend="dragging = false"
                x-data="{ dragging: false }"
                draggable="true">
                Your Item #6
            </li>
        </ul>
    </div>
    <div class="drag-and-drop__divider">⇄</div>
    <div class="drag-and-drop__container drag-and-drop__container--to">
        <h3 class="drag-and-drop__title">To</h3>
        <ul
            class="drag-and-drop__items"
            :class="{ 'drag-and-drop__items--adding': adding }"
            x-on:drop="adding = false"
            x-on:drop.prevent="
                const target = event.target.closest('ul');
                const element = document.getElementById(event.dataTransfer.getData('text/plain'));
                target.appendChild(element);
            "
            x-on:dragover.prevent="adding = true"
            x-on:dragleave.prevent="adding = false">
            <!-- loop through the already selected items -->
        </ul>
    </div>
</div>
