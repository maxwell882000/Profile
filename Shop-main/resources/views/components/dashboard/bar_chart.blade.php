<div class="basis-[65%] bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="py-3 px-5 text-black_custom font-semibold">Статистика за 5 дней</div>
    <hr>
    <canvas class="p-10" id="chartBar"></canvas>
</div>

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart bar -->
<script>
    const labelsBarChart = [
        '{{str_day_of_week(now()->subDays(4)->dayOfWeek )}}',
        '{{str_day_of_week(now()->subDays(3)->dayOfWeek )}}',
        '{{str_day_of_week(now()->subDays(2)->dayOfWeek )}}',
        '{{str_day_of_week(now()->subDay()->dayOfWeek )}}',
        '{{str_day_of_week(now()->dayOfWeek)}}',
    ];
    const dataBarChart = {
        labels: labelsBarChart,
        datasets: [
            {
                label: '{{__("Покупки")}}',
                backgroundColor: "hsl(252, 82.9%, 67.8%)",
                borderColor: "hsl(252, 82.9%, 67.8%)",
                data: [
                    {{\App\Domain\Payment\Entities\Payment::whereDate('created_at', "=", now()->subDays(4))->count()}},
                    {{\App\Domain\Payment\Entities\Payment::whereDate('created_at', "=", now()->subDays(3))->count()}},
                    {{\App\Domain\Payment\Entities\Payment::whereDate('created_at', "=", now()->subDays(2))->count()}},
                    {{\App\Domain\Payment\Entities\Payment::whereDate('created_at', "=", now()->subDay())->count()}},
                    {{\App\Domain\Payment\Entities\Payment::whereDate('created_at', "=", now())->count()}},
                ],
            },
            {
                label: '{{__("Рассрочки")}}',
                backgroundColor: "rgb(170, 255, 0)",
                borderColor: "rgb(150, 255, 0)",
                data: [
                    {{\App\Domain\Installment\Entities\TakenCredit::whereDate('created_at', "=", now()->subDays(4))->count()}},
                    {{\App\Domain\Installment\Entities\TakenCredit::whereDate('created_at', "=", now()->subDays(3))->count()}},
                    {{\App\Domain\Installment\Entities\TakenCredit::whereDate('created_at', "=", now()->subDays(2))->count()}},
                    {{\App\Domain\Installment\Entities\TakenCredit::whereDate('created_at', "=", now()->subDay())->count()}},
                    {{\App\Domain\Installment\Entities\TakenCredit::whereDate('created_at', "=", now())->count()}},
                ],
            },
            {
                label: '{{__("Отказы")}}',
                backgroundColor: "rgb(220,20,60)",
                data: [
                    {{  decline_query(4)}},
                    {{  decline_query(3)}},
                    {{  decline_query(2)}},
                    {{  decline_query(1)}},
                    {{  decline_query()}},
                ],
            },
        ],
    };

    const configBarChart = {
        type: "bar",
        data: dataBarChart,
        options: {
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 15
                        }
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontSize: 16
                    }
                }],
                xAxes: [
                    {
                        ticks: {
                            fontSize: 16
                        }
                    }
                ]
            }
        },
    };

    var chartBar = new Chart(
        document.getElementById("chartBar"),
        configBarChart
    );
</script>
