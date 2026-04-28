import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    const stats = window.dashboardStats || {
        approvedHours: 0,
        pendingHours: 0,
        remainingHours: 0,
        weeklyHours: [0, 0, 0, 0, 0],
        minHoursDay: 6
    };

    const chartFont = { size: 16, weight: '600' };

    const colors = {
        danger: '#DC2626',
        warning: '#CA8A04',
        success: '#16A34A',
        neutral: '#b0b3b6',
        primary: '#286cda',
    };

    const charts = [];

    const pieCtx = document.getElementById('hoursPieChart');
    if (pieCtx) {
        charts.push(new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Approved', 'Pending', 'Missing'],
                datasets: [{
                    data: [stats.approvedHours , stats.pendingHours, stats.remainingHours],
                    backgroundColor: [colors.success, colors.warning, colors.danger],
                    borderColor: '#ffffff',
                    borderWidth: 1.5,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: chartFont, padding: 25, usePointStyle: true }
                    },
                    tooltip: {
                        bodyFont: { size: 14 },
                        callbacks: { label: (ctx) => ` ${ctx.label}: ${ctx.raw}h` }
                    }
                }
            }
        }));
    }

    const barCtx = document.getElementById('hoursBarChart');
    if (barCtx) {
        charts.push(new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                datasets: [
                    {
                        label: 'Logged Hours',
                        data: stats.weeklyHours,
                        backgroundColor: colors.primary,
                        borderRadius: 6,
                        maxBarThickness: 45
                    },
                    {
                        label: 'Target (6h)',
                        data: Array(5).fill(stats.minHoursDay),
                        backgroundColor: colors.neutral,
                        borderRadius: 6,
                        maxBarThickness: 45
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10,
                        grid: { color: '#F1F5F9', drawBorder: true },
                        ticks: { font: chartFont, callback: (v) => v + 'h' }
                    },
                    x: {
                        grid: { display: true, color: '#F1F5F9', drawBorder: true },
                        ticks: { font: chartFont }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { font: chartFont, padding: 20, usePointStyle: true }
                    }
                }
            }
        }));
    }

    window.addEventListener('resize', () => {
        charts.forEach(chart => chart.resize());
    });
});