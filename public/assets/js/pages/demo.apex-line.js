var today = new Date();
var priorDate = new Date(new Date().setDate(today.getDate() - 30));
var getDaysArray = function (priorDate, today) {
    for (
        var arr = [], dt = new Date(priorDate);
        dt <= new Date(today);
        dt.setDate(dt.getDate() + 1)
    ) {
        arr.push(formatDate(new Date(dt)));
    }
    return arr;
};

options = {
    chart: {
        height: 374,
        type: "line",
        shadow: {
            enabled: !1,
            color: "#bbb",
            top: 3,
            left: 2,
            blur: 3,
            opacity: 1,
        },
    },
    stroke: { width: 5, curve: "smooth" },
    series: [
        {
            name: "Sales",
            data: [
                6000, 2000, 4000, 6000, 4000, 8000, 6000, 8000, 12000, 10000,
                8000, 6000, 14000, 1600, 10000, 6000, 10000, 12000,
            ],
        },
    ],
    xaxis: {
        type: "datetime",
        categories: getDaysArray(
            new Date(new Date().setDate(today.getDate() - 18)),
            new Date()
        ),
        // categories: [
        //     "1/11/2000",
        //     "2/11/2000",
        //     "3/11/2000",
        //     "4/11/2000",
        //     "5/11/2000",
        //     "6/11/2000",
        //     "7/11/2000",
        //     "8/11/2000",
        //     "9/11/2000",
        //     "10/11/2000",
        //     "11/11/2000",
        //     "12/11/2000",
        //     "1/11/2001",
        //     "2/11/2001",
        //     "3/11/2001",
        //     "4/11/2001",
        //     "5/11/2001",
        //     "6/11/2001",
        // ],
    },
    // title: {
    //     text: "Social Media",
    //     align: "left",
    //     style: { fontSize: "16px", color: "#666" },
    // },
    fill: {
        type: "gradient",
        gradient: {
            shade: "dark",
            gradientToColors: ["#fa5c7c"],
            shadeIntensity: 1,
            type: "horizontal",
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100, 100, 100],
        },
    },
    markers: {
        size: 4,
        opacity: 0.9,
        colors: ["#ffbc00"],
        strokeColor: "#fff",
        strokeWidth: 2,
        style: "inverted",
        hover: { size: 7 },
    },
    yaxis: { min: 0, max: 20000, title: { text: "" } },
    grid: {
        row: { colors: ["transparent", "transparent"], opacity: 0.2 },
        borderColor: "#f1f3fa",
    },
    responsive: [
        {
            breakpoint: 600,
            options: { chart: { toolbar: { show: !1 } }, legend: { show: !1 } },
        },
    ],
};
(chart = new ApexCharts(
    document.querySelector("#line-chart-gradient"),
    options
)).render();

function formatDate(d) {
    var datestring =
        d.getFullYear() +
        "-" +
        ("0" + (d.getMonth() + 1)).slice(-2) +
        "-" +
        ("0" + d.getDate()).slice(-2);
    return datestring;
}
