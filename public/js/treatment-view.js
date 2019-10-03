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
        let labels = [];
        let data = [];
        response = JSON.parse(response);
        response.forEach(function (disease) {
            labels.push(disease.Year);
            data.push(disease.AverageCoveredCharges);
            console.log(disease);
        });
        var ctx = document.getElementById('treatment-chart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: labels,
                datasets: [{
                    label: 'AverageCoveredCharges',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: data
                }]
            },

            // Configuration options go here
            options: {
                maintainAspectRatio: false
            }
        });
    });
});

function initMap() {

}