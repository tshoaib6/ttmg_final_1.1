<script>
/*
Template Name: Minible - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: support@themesbrand.com
File: Dashboard
*/

// get colors array from the string
function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        if (colors) {
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    if (color) return color;
                    else return newValue;;
                } else {
                    var val = value.split(',');
                    if (val.length == 2) {
                        var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                        rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        }
    }
}

//
// Total Revenue Chart
//
var BarchartTotalReveueColors = getChartColorsArray("total-revenue-chart");
if (BarchartTotalReveueColors) {
var options1 = {
    series: [{
        data: [25, 66, 41, 89, 63, 25, 44, 20, 36, 40, 54]
    }],
    fill: {
        colors: BarchartTotalReveueColors,
    },
    chart: {
        type: 'bar',
        width: 70,
        height: 40,
        sparkline: {
            enabled: true
        }
    },
    plotOptions: {
        bar: {
            columnWidth: '50%'
        }
    },
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
    xaxis: {
        crosshairs: {
            width: 1
        },
    },
    tooltip: {
        fixed: {
            enabled: false
        },
        x: {
            show: false
        },
        y: {
            title: {
                formatter: function (seriesName) {
                    return ''
                }
            }
        },
        marker: {
            show: false
        }
    }
};

var chart1 = new ApexCharts(document.querySelector("#total-revenue-chart"), options1);
chart1.render();

}

//
// Orders Chart
//

var RadialchartOrdersChartColors = getChartColorsArray("orders-chart");
if (RadialchartOrdersChartColors) {
var options = {
    fill: {
        colors: RadialchartOrdersChartColors,
    },
    series: [70],
    chart: {
        type: 'radialBar',
        width: 45,
        height: 45,
        sparkline: {
            enabled: true
        }
    },
    dataLabels: {
        enabled: false
    },
    plotOptions: {
        radialBar: {
            hollow: {
                margin: 0,
                size: '60%'
            },
            track: {
                margin: 0
            },
            dataLabels: {
                show: false
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#orders-chart"), options);
chart.render();
}

// 
// Customers Chart
//
var RadialchartCustomersColors = getChartColorsArray("customers-chart");
if (RadialchartCustomersColors) {
var options = {
    fill: {
        colors: RadialchartCustomersColors,
    },
    series: [55],
    chart: {
        type: 'radialBar',
        width: 45,
        height: 45,
        sparkline: {
            enabled: true
        }
    },
    dataLabels: {
        enabled: false
    },
    plotOptions: {
        radialBar: {
            hollow: {
                margin: 0,
                size: '60%'
            },
            track: {
                margin: 0
            },
            dataLabels: {
                show: false
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#customers-chart"), options);
chart.render();
}

// 
// Clients Chart
//
var RadialchartCustomersColors = getChartColorsArray("clients-chart");
if (RadialchartCustomersColors) {
var options = {
    fill: {
        colors: RadialchartCustomersColors,
    },
    series: [55],
    chart: {
        type: 'radialBar',
        width: 45,
        height: 45,
        sparkline: {
            enabled: true
        }
    },
    dataLabels: {
        enabled: false
    },
    plotOptions: {
        radialBar: {
            hollow: {
                margin: 0,
                size: '60%'
            },
            track: {
                margin: 0
            },
            dataLabels: {
                show: false
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#clients-chart"), options);
chart.render();
}

// 
// Growth Chart
//
var BarchartGrowthColors = getChartColorsArray("growth-chart");
if (BarchartGrowthColors) {
var options2 = {
    series: [{
        data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54]
    }],
    fill: {
        colors: BarchartGrowthColors,
    },
    chart: {
        type: 'bar',
        width: 70,
        height: 40,
        sparkline: {
            enabled: true
        }
    },
    plotOptions: {
        bar: {
            columnWidth: '50%'
        }
    },
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
    xaxis: {
        crosshairs: {
            width: 1
        },
    },
    tooltip: {
        fixed: {
            enabled: false
        },
        x: {
            show: false
        },
        y: {
            title: {
                formatter: function (seriesName) {
                    return ''
                }
            }
        },
        marker: {
            show: false
        }
    }
};

var chart2 = new ApexCharts(document.querySelector("#growth-chart"), options2);
chart2.render();
}

//
// Sales Analytics Chart
var dashboard_chart;
var LinechartsalesColors = getChartColorsArray("sales-analytics-chart");
if (LinechartsalesColors) {
var options = {
    chart: {
        height: 343,
        type: 'line',
        stacked: false,
        toolbar: {
            show: false
        }
    },
    stroke: {
        width: [0, 2, 4],
        curve: 'smooth'
    },
    plotOptions: {
        bar: {
            columnWidth: '30%'
        }
    },
    colors: LinechartsalesColors,
    series: [{
        name: 'Leads',
        type: 'column',
        data: [<?=$total_leads ?>]
    }, {
        name: 'Accepted',
        type: 'area',
        data: [<?=$total_accepted_leads ?>]
    }, {
        name: 'Rejected',
        type: 'line',
        data: [<?=$total_rejected_leads ?>]
    }],
    fill: {
        opacity: [0.85, 0.25, 1],
        gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            stops: [0, 100, 100, 100]
        }
    },
 
    
    markers: {
        size: 0
    },

    xaxis: {
        type: 'category',
        categories: [<?=$label_dates ?>],
    },
    yaxis: {
        title: {
            text: 'Number of Leads',
        },
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
            formatter: function (y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(0) + " Leads";
                }
                return y;
  
            }
        }
    },
    grid: {
        borderColor: '#f1f1f1'
    }
  }
  
  dashboard_chart = new ApexCharts(
    document.querySelector("#sales-analytics-chart"),
    options
  );

  dashboard_chart.render();
}

$(function(){
    $("#dashboard-total-leads").html(<?=$dash_total_leads?>);
});

function dashboard_lead(sort)
{
    var url = '<?=base_url('ajax-dashboard-lead-chart/') ?>'+sort;

$.getJSON(url, function(response) {

    $("#dashboard-total-leads").html(response.dash_total_leads);
    dashboard_chart.updateOptions({
            series: [{
            name: 'Leads',
            type: 'column',
            data: response.total_leads
            }, {
                name: 'Accepted',
                type: 'area',
                data: response.total_accepted_leads
            }, {
                name: 'Rejected',
                type: 'line',
                data: response.total_rejected_leads
            }],
            xaxis: {
            type:'category',
            categories:response.label_dates
          },
        })
    });
}
</script>