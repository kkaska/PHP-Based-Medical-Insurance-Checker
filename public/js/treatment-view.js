$(document).ready(function () {
    let url = 'treatment-info';
    let searchParams = new URLSearchParams(window.location.search);

    if (searchParams.has('disease') && searchParams.has('hospital')) {
        url += '?disease=' + searchParams.get('disease') + '&hospital=' + searchParams.get('hospital');
    } else {
        //TODO: get a proper error message
        return;
    }

    $.get(url, function (response) {
        let data = {
            AverageCoveredCharges: [],
            AverageTotalPayments: [],
            AverageMedicarePayments: [],
            Years: [],
            TotalDischarges: []
        };
        response = JSON.parse(response);
        response.forEach(function (disease) {
            data.AverageCoveredCharges.push(disease.AverageCoveredCharges);
            data.AverageTotalPayments.push(disease.AverageTotalPayments);
            data.AverageMedicarePayments.push(disease.AverageMedicarePayments);
            data.Years.push(disease.Year);
            data.TotalDischarges.push(disease.TotalDischarges);
        });

        generateChart('covered-chart', 'Average Covered Charges', data.Years, 'rgb(243, 150, 154)', data.AverageCoveredCharges);
        generateChart('total-chart', 'Average Total Payments', data.Years, 'rgb(108,195, 213)', data.AverageTotalPayments);
        generateChart('medicare-chart', 'Average Medicare Payments', data.Years, 'rgb(255, 206, 103)', data.AverageMedicarePayments);
        generateChart('patients-chart', 'Total Patients', data.Years, 'rgb(255, 120, 81)', data.TotalDischarges, false);
    });
});

function generateChart(id, label, years, colour, data, parseMoney = true) {
    let ctx = document.getElementById(id).getContext('2d');
    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [
                {
                    label: label,
                    borderColor: colour,
                    data: data,
                    fill: false
                }
            ]
        },
        legend: {
            display: false,
        },
        options: {
            legend: {
                labels: {
                    boxWidth: 20,
                    usePointStyle: true,
                },
                position: 'bottom'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function (value) {
                            if (parseMoney) {
                                return value.toLocaleString("en-US", {style: "currency", currency: "USD"})
                            } else {
                                return value;
                            }
                        }
                    }
                }]
            }
        }
    });
}

function initMap() {

}