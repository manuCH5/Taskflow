function getFormat(tiempo) {
    return (tiempo < 10) ? "0" + tiempo : tiempo;
}

function horaReal() {
    let fecha = new Date();

    let hora = fecha.getHours();
    let minuto = fecha.getMinutes();
    let segundo = fecha.getSeconds();

    document.getElementById("consola").innerHTML = `${getFormat(hora)}:${getFormat(minuto)}:${getFormat(segundo)}`;
}

setInterval(horaReal, 1000);

fetch(`/inicio/getData`, {
    method: "GET",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
    }
})
    .then(response => response.json())
    .then(data => {
    
    let totalStop = (data.totalStopTasks * 100)/data.totalTasks;
    let totalTodo = (data.totalTodoTasks * 100)/data.totalTasks;
    let totalProgress = (data.totalProgressTasks * 100)/data.totalTasks;
    let totalDone = (data.totalDoneTasks * 100)/data.totalTasks;
        const getChartOptions = () => {
            return {
                series: [totalDone,totalStop,totalProgress,totalTodo],
                colors: ["#1C64F2", "#ff6467", "#16BDCA", "#9061F9"],
                chart: {
                    height: 420,
                    width: "85%",
                    type: "pie",
                },
                stroke: {
                    colors: ["white"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        labels: {
                            show: true,
                        },
                        size: "100%",
                        dataLabels: {
                            offset: -25
                        }
                    },
                },
                labels: ["Finalizado", "Parado", "En progreso", "Pendiente"],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return value + "%"
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function (value) {
                            return value + "%"
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            }
        }

        if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
            chart.render();
        }
    })
    .catch(error => console.error("Error en fetch:", error));

