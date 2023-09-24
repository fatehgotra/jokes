
colors = ["#39afd1", "#ffbc00", "#313a46", "#fa5c7c", "#0acf97"];
(dataColors = $("#simple-donut").data("colors")) &&
    (colors = dataColors.split(","));
options = {
    chart: { height: 320, type: "donut" },
    series: [44, 55, 41, 17, 15],
    legend: {
        show: !0,
        position: "bottom",
        horizontalAlign: "center",
        verticalAlign: "middle",
        floating: !1,
        fontSize: "14px",
        offsetX: 0,
        offsetY: 7,
    },
    labels: ["Product 1", "Product 2", "Product 3", "Product 4", "Product 5"],
    colors: colors,
};
(chart = new ApexCharts(
    document.querySelector("#simple-donut"),
    options
)).render();