<div class="flex flex-row justify-end h-full items-center ">
    <div class="inline-flex space-x-3 m-5    text-xl">

        <x-helper.header.icon_header
            :number="\App\Domain\User\Entities\User::newToday()"
            href="{{route('admin.user.index', ['today' => true])}}"
            :title='__("Новые пользователи")'
            icon="fas fa-users">
        </x-helper.header.icon_header>
        <x-helper.header.icon_header
            number="{{\App\Domain\Order\Entities\UserPurchase::waited()->todayCount()}}"
            href="{{route('admin.new_orders.index', ['today' => true, 'waited' => true])}}"
            :title='__("Новые Заказы")'
            icon="fas fa-money-check-alt">
        </x-helper.header.icon_header>
        <x-helper.header.icon_header
            number="{{0}}"
            href="{{route('logout')}}"
            :title='__("Выйти")'
            icon="fas fa-power-off">
        </x-helper.header.icon_header>
    </div>
</div>
