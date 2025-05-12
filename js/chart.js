import { Chart, CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, BarController } from 'https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.esm.min.js';

// Registrar los componentes específicos que necesitas
Chart.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, BarController);

document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('myChart').getContext('2d');

    fetch('index.php?action=getCountByMonth')
        .then(response => response.json())
        .then(data => {
            console.log('Datos crudos getCountByMonth:', data);

            // Extraer y ordenar los meses únicos desde los datos
            const rawMonths = data.map(item => {
                const [año, mes] = item.mes.split('-');
                return `${año}-${mes.padStart(2, '0')}`;
            });

            const labels = [...new Set(rawMonths)].sort();
            console.log('Labels basados en datos:', labels);

            // Mapear datos a un objeto {mes: cantidad}
            const dataMap = {};
            data.forEach(item => {
                dataMap[item.mes] = parseInt(item.cantidad, 10);
            });
            console.log('Mapa de datos (mes->cantidad):', dataMap);

            const values = labels.map(m => dataMap[m] || 0);
            console.log('Values finales para el gráfico:', values);

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Partes por mes',
                        data: values,
                        backgroundColor: 'rgb(255, 87, 96)',
                        borderColor: 'rgba(0, 0, 0, 0)',
                        borderWidth: 1,
                        
                        
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    family: 'Nunito Sans', // Cambia 'Arial' por la fuente que desees
                                    size: 16, // Tamaño de la fuente
                                }
                            }
                        },
                        tooltip: {
                            bodyFont: {
                                family: 'Nunito Sans', // Cambia la fuente del tooltip si lo deseas
                                size: 12,
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                autoSkip: false
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
        });
});
