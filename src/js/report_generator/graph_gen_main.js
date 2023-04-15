function genLineGraph(labels1, data1, hoverTitle){
    var ctx = document.getElementById('chart').getContext('2d');
var chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: labels1,
    datasets: [
      {
        label: hoverTitle,
        data: data1,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true,
          },
        },
      ],
    },
  },
});
return chart;
}

// ///////////////////////////////////////////////////////
function doubleBarGraph(labels, data1, data2){
  // Get the canvas element
const canvas = document.getElementById('chart').getContext('2d');

// Define the data for the chart
const data = {
  labels: labels,
  datasets: [
    {
      label: 'Dataset 1',
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255,99,132,1)',
      borderWidth: 1,
      data: data1
    },
    {
      label: 'Dataset 2',
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1,
      data: data2
    }
  ]
};

// Define the options for the chart
const options = {
  scales: {
    y: {
      beginAtZero: true,
      min: 0,
      grace: '10%',
      ticks: {
        callback: function(value, index, values) {
          if (value === 0) {
            return value;
          } else if (value < 10000) {
            return '10k';
          } else if (value < 1000000) {
            return value/1000 + 'k';
          } else {
            return value/1000000 + 'M';
          }
        }
      }
    }
  },
  plugins: {
    legend: {
      position: 'top',
    },
    tooltip: {
      mode: 'index',
      intersect: false
    }
  },
  layout: {
    padding: {
      left: 50,
      right: 0,
      top: 0,
      bottom: 0
    }
  },
  responsive: true,
  minBarLength: 1,
};



// Create the chart
const chart = new Chart(canvas, {
  type: 'bar',
  data: data,
  options: options
});
return chart;
}