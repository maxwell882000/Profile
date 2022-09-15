@extends("layout.admin_layout")
@section("content")
    {{--    test blade  create template then fill with variables --}}
    <div class="flex flex-col space-y-1">
        {{--    insert there new created livewire--}}
        {{--    give the title--}}
        <div class="flex flex-row justify-between pr-10">
            <x-helper.text.title>{{__("Главная") ?? ""}}</x-helper.text.title>
            
        </div>

        <hr class="border-dashed border-title_color"/>
        <div class="flex flex-row">
            
        </div>
        {{--    insert name of the breadcrumbs and the arguments--}}
        <div class="w-full pb-10 ">
            

            <div 	class='mr-4 space-y-1'>
                			

            <div 	class='w-full flex flex-row  space-x-2'>
                			

            <div 	class='items-center block p-3 bg-white w-full h-full shadow-lg rounded'>
            <span class='font-bold text-[1.09rem]'>{{__('Статистика')}}</span>
                			

            <div 	class='justify-around w-full flex flex-row  space-x-2'>
                			

            <div 	class='space-x-6 p-5 items-center  flex flex-row  space-x-2'>
                			
<span 	class='fas fa-cash-register text-4xl text-[#bebebe]'></span>			

            <div 	class='space-y-0.5 items-start  flex flex-col  space-y-2'>
                			
<span 	class='text-sm text-center font-bold'>{{__('Рассрочки')}}</span>			

            <div 	class='text-sm'>
                			

            <div 	class='cursor-pointer hover:text-blue-300'	onclick='location.href ="{{route("admin.taken_credit.index", array_merge([], \Request::query()))}}"'>
                			
<span >{{__('Всего')}}:</span>			
<span 	class='font-bold'>{{App\Domain\Installment\Entities\TakenCredit::count('taken_credits.id') ?? ""}}</span>
            </div>			

            <div 	class='cursor-pointer hover:text-blue-300'	onclick='location.href ="{{route("admin.taken_credit.index", array_merge(["today" => 1,"title_for_credit" => "за сегодняшний день",], \Request::query()))}}"'>
                			
<span >{{__('Сегодня')}}:</span>			
<span 	class='font-bold'>{{App\Domain\Installment\Entities\TakenCredit::today()->count('taken_credits.id') ?? ""}}</span>
            </div>
            </div>
            </div>
            </div>			

            <div 	class='space-x-6 p-5 items-center  flex flex-row  space-x-2'>
                			
<span 	class='fas fa-address-book text-4xl text-[#bebebe]'></span>			

            <div 	class='space-y-0.5 items-start  flex flex-col  space-y-2'>
                			
<span 	class='text-sm text-center font-bold'>{{__('Просроченные рассрочки')}}</span>			

            <div 	class='text-sm'>
                			

            <div 	class='cursor-pointer hover:text-blue-300'	onclick='location.href ="{{route("admin.taken_credit.index", array_merge(["unpaid" => 1,"title_for_credit" => "просроченные",], \Request::query()))}}"'>
                			
<span >{{__('Всего')}}:</span>			
<span 	class='font-bold'>{{App\Domain\Installment\Entities\TakenCredit::unpaidCreditCount() ?? ""}}</span>
            </div>			

            <div 	class='cursor-pointer hover:text-blue-300'	onclick='location.href ="{{route("admin.taken_credit.index", array_merge(["today" => 1,"unpaid" => 1,"title_for_credit" => "за сегодняшний день просроченные",], \Request::query()))}}"'>
                			
<span >{{__('Сегодня')}}:</span>			
<span 	class='font-bold'>{{App\Domain\Installment\Entities\TakenCredit::today()->unpaidCreditCount() ?? ""}}</span>
            </div>
            </div>
            </div>
            </div>			

            <div 	class='space-x-6 p-5 items-center  flex flex-row  space-x-2'>
                			
<span 	class='fas fa-calendar-day text-4xl text-[#bebebe]'></span>			

            <div 	class='space-y-0.5 items-start  flex flex-col  space-y-2'>
                			
<span 	class='text-sm text-center font-bold'>{{__('За должность')}}</span>			

            <div 	class='text-sm'>
                			

            <div >
                			
<span >{{__('Всего')}}:</span>			
<span 	class='font-bold'>{{App\Domain\Installment\Entities\TakenCredit::amountOfUnpaidCreditShow() ?? ""}}</span>
            </div>			

            <div >
                			
<span >{{__('Сегодня')}}:</span>			
<span 	class='font-bold'>{{App\Domain\Installment\Entities\TakenCredit::today()->amountOfUnpaidCreditShow() ?? ""}}</span>
            </div>
            </div>
            </div>
            </div>			

            <div 	class='space-x-6 p-5 items-center  flex flex-row  space-x-2'>
                			
<span 	class='fas fa-money-bill-wave text-4xl text-[#bebebe]'></span>			

            <div 	class='space-y-0.5 items-start  flex flex-col  space-y-2'>
                			
<span 	class='text-sm text-center font-bold'>{{__('Действующие рассрочки')}}</span>			

            <div 	class='text-sm'>
                			

            <div 	class='cursor-pointer hover:text-blue-300'	onclick='location.href ="{{route("admin.taken_credit.index", array_merge(["accepted" => 1,"title_for_credit" => "действующие",], \Request::query()))}}"'>
                			
<span >{{__('Количество')}}:</span>			
<span 	class='font-bold'>{{App\Domain\Installment\Entities\TakenCredit::accepted()->count() ?? ""}}</span>
            </div>			

            <div >
                			
<span >{{__('Cумма')}}:</span>			
<span 	class='font-bold'>{{App\Domain\Installment\Entities\TakenCredit::acceptedAmountToPayShow() ?? ""}}</span>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>			

            <div 	class=' flex flex-row  space-x-2'>
                			
<x-dashboard.bar_chart  />			
<x-dashboard.doughnut_chart/>
            </div>
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
