<div class="basis-[35%] bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="py-3 px-5 text-black_custom font-semibold">Общая статистика рассрочек</div>
    <hr>
    <canvas width="360" height="320" class="p-10" id="chartDoughnut"></canvas>
</div>

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart doughnut -->
<script>
    const datasets = [
        {
            label: "My First Dataset",
            data: [
                {{\App\Domain\Installment\Entities\TakenCredit::finished()->count()}},
                {{\App\Domain\Installment\Entities\TakenCredit::waited()->count()}},
                {{\App\Domain\Installment\Entities\TakenCredit::accepted()->count()}},
                {{\App\Domain\Installment\Entities\TakenCredit::declined()->count()}},
            ],
            backgroundColor: [
                "rgb(170, 255, 0)",
                "rgb(164, 101, 241)",
                "rgb(101, 143, 241)",
                "rgb(220,20,60)"
            ],
            hoverOffset: 4,
        },
    ];

    const dataDoughnut = {
        labels: [
            '{{__("Завершенные")}}',
            '{{__("Ожидаемые")}}',
            '{{__("Выплаты")}}',
            '{{__("Отказанные")}}'
        ],
        datasets: datasets,


    };
    const title = 'title_for_credit=';
    const params = [
        'finished=true&' + title + "завершенные",
        'waited=true&' + title + "ожидаемые",
        "accepted=true&" + title + "принятые",
        "declined=true&" + title + "отказанные"
    ];
    const configDoughnut = {
        type: "doughnut",
        data: dataDoughnut,
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
            onClick(e) {
                const activePoints = chartBar.getElementsAtEventForMode(e, 'nearest', {
                    intersect: true
                }, false)
                if (activePoints.length !== 0) {
                    window.location =
                        "{{route(\App\Domain\Installment\Front\Admin\Path\TakenCreditRouteHandler::new()->index())}}"
                        + "?" + params[activePoints[0].index];
                }
            },
        },
    };

    var chartBar = new Chart(
        document.getElementById("chartDoughnut"),
        configDoughnut,
    );

</script>
