Chart.register(ChartDataLabels);

document.addEventListener("DOMContentLoaded", () => {
    const data = window.dashboardData;

    // Chart 1: Marital Status of Family Heads
    const ctx1 = document.getElementById("marital_status");
    new Chart(ctx1, {
        type: "pie",
        data: {
            labels: ["Married", "Unmarried"],
            datasets: [
                {
                    label: "# of Family Heads",
                    data: [data.marriedHeads, data.unmarriedHeads],
                    backgroundColor: ["#3B82F6", "rgba(34, 197, 94, 0.6)"],
                    borderColor: [
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 99, 132, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                datalabels: {
                    color: "#fff",
                    formatter: (value) => `${value}`,
                },
                legend: { position: "top" },
                title: {
                    display: true,
                    text: "Marital Status of Family Heads",
                },
            },
        },
    });

    // Chart 2: Families Per State
    const ctx2 = document.getElementById("familiesPerState");
    new Chart(ctx2, {
        type: "bar",
        data: {
            labels: Object.keys(data.familiesPerState),
            datasets: [
                {
                    label: "Number of Families",
                    data: Object.values(data.familiesPerState),
                    backgroundColor: "#3B82F6",
                    borderColor: "#1D4ED8",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                datalabels: {
                    anchor: "end",
                    align: "top",
                    color: "#fff",
                    font: { weight: "bold" },
                },
                legend: { display: false },
                title: { display: true, text: "Families Per State" },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                },
            },
        },
    });

    // Chart 3: Marital Status of Members
    const ctx3 = document.getElementById("member_marital_status");
    new Chart(ctx3, {
        type: "doughnut",
        data: {
            labels: ["Married", "Unmarried"],
            datasets: [
                {
                    label: "# of Family Members",
                    data: [data.marriedMembers, data.unmarriedMembers],
                    backgroundColor: ["#3B82F6", "rgba(34, 197, 94, 0.6)"],
                    borderColor: [
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 99, 132, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: "top" },
                title: { display: true, text: "Marital Status of Members" },
            },
        },
    });

    // Chart 4: Family Growth
    const ctx4 = document.getElementById("familyGrowth");
    new Chart(ctx4, {
        type: "line",
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: "Cumulative Family Registrations",
                    data: data.cumulativeData,
                    backgroundColor: "rgba(54, 162, 235, 0.6)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Family Registration Growth Over Time",
                },
            },
            scales: {
                x: { title: { display: true, text: "Month" } },
                y: {
                    beginAtZero: true,
                    title: { display: true, text: "Cumulative Registrations" },
                    ticks: { stepSize: 1 },
                },
            },
        },
    });

    // Sidebar Toggle
    const sidebar = document.querySelector(".sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    if (sidebar && sidebarToggle) {
        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("active");
        });

        const sidebarLinks = document.querySelectorAll(".sidebar-link");
        sidebarLinks.forEach((link) => {
            link.addEventListener("click", () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove("active");
                }
            });
        });
    }
});
