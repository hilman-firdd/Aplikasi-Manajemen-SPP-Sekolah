var thickness = {
  id: 'thickness',
  beforeDraw: function (chart, _options) {
    let thickness = chart.options.plugins.thickness.thickness;
    thickness.forEach((item, index) => {
      chart.getDatasetMeta(0).data[index]._view.innerRadius = item[0];
      chart.getDatasetMeta(0).data[index]._view.outerRadius = item[1];
    });
  },
};

var ctx = document.getElementById('chart-budget').getContext('2d');
var chart = new Chart(ctx, {
  type: 'doughnut',
  plugins: [thickness],
  data: {
    labels: ['Earned', 'Spend'],
    datasets: [
      {
        label: 'Budget Stats',
        data: [60, 40],
        backgroundColor: ['#3547AC', '#DCE2F4'],
        borderWidth: 0,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      position: 'bottom',
      display: true,
      labels: {
        fontSize: 14,
        usePointStyle: true,
        fontColor: '#0D1458',
        padding: 20,
      },
    },
    plugins: {
      thickness: {
        thickness: [
          [35, 70],
          [40, 65],
        ],
      },
    },
  },
});
