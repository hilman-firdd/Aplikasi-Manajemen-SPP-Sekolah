var ctx = document.getElementById("chart-revenue").getContext("2d");
var gradient = ctx.createLinearGradient(0, 0, 0, 240);
gradient.addColorStop(0, "rgba(53, 71, 172, 0.7)");
gradient.addColorStop(1, "rgba(255, 255, 255, 0)");

window.onload = function () {
    window.myLine = new Chart(ctx, config);
};

var config = {
    type: "line",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        datasets: [
            {
                backgroundColor: gradient,
                borderColor: "#3547AC",
                fill: true,
                borderWidth: 4,
                pointRadius: 7,
                pointBorderWidth: 4,
                pointHoverRadius: 7,
                pointHoverBorderWidth: 4,
                pointBackgroundColor: "#FFFFFF",
                pointStyle: "circle",
                data: [12000, 45000, 26000, 15000, 50000, 48000],
            },
        ],
    },
    options: {
        legend: {
            display: false,
        },
        responsive: true,
        scales: {
            xAxes: [
                {
                    gridLines: {
                        display: false,
                    },
                },
            ],
            yAxes: [
                {
                    ticks: {
                        callback: function (value) {
                            var ranges = [
                                { divider: 1e6, suffix: "M" },
                                { divider: 1e3, suffix: "k" },
                            ];
                            function formatNumber(n) {
                                for (var i = 0; i < ranges.length; i++) {
                                    if (n >= ranges[i].divider) {
                                        return (
                                            (n / ranges[i].divider).toString() +
                                            ranges[i].suffix
                                        );
                                    }
                                }
                                return n;
                            }
                            return "$" + formatNumber(value);
                        },
                        stepSize: 20000,
                    },
                },
            ],
        },
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    return (
                        "$" + data["datasets"][0]["data"][tooltipItem["index"]]
                    );
                },
            },
        },
    },
};
