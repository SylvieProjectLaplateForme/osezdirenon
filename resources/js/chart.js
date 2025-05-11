import Chart from 'chart.js/auto';

// Graphique barres
const barCtx = document.getElementById('articlesBarChart');
if (barCtx) {
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Janv', 'Fév', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Articles',
                data: JSON.parse(barCtx.dataset.articles),
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        }
    });
}

// Graphique Pie
const pieCtx = document.getElementById('articlesPieChart');
if (pieCtx) {
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Validés', 'En attente'],
            datasets: [{
                data: JSON.parse(pieCtx.dataset.articlesPie),
                backgroundColor: ['#38bdf8', '#facc15']
            }]
        }
    });
}

