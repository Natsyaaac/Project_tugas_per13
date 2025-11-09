fetch('data_angkatan.php')
      .then(response => response.json())
      .then(data => {
        const labels = data.map(item => item.angkatan);
        const values = data.map(item => item.jumlah);

        const ctx = document.getElementById('areaChart').getContext('2d');
        new Chart(ctx, {
          type: 'line', // line + fill = area chart
          data: {
            labels: labels,
            datasets: [{
              label: 'Jumlah Mahasiswa',
              data: values,
              fill: true,
              borderColor: 'rgba(75, 192, 192, 1)',
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              tension: 0.4
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: true, position: 'top' },
              title: { display: true, text: 'Mahasiswa per Angkatan (2021–2025)' }
            },
            scales: {
              y: {
                beginAtZero: true,
                ticks: { stepSize: 10 }
              }
            }
          }
        });
      });