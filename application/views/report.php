<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASUS 2</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="barChart" width="400" height="200"></canvas>
    
    <script>
    // Simulasikan data pelanggan (sesuaikan dengan data sebenarnya)
    var customers = [
        { nama: "Pelanggan 1", jenis_kelamin: "Laki-laki", tanggal_lahir: "1990-01-01" },
        { nama: "Pelanggan 2", jenis_kelamin: "Perempuan", tanggal_lahir: "1985-03-15" },
        // Tambahkan data pelanggan lainnya...
    ];

    // Ambil elemen <canvas> sebagai wadah grafik
    var ctx = document.getElementById('barChart').getContext('2d');

    // Menghitung jumlah pelanggan per jenis kelamin
    var genderCounts = {
        "Laki-laki": 0,
        "Perempuan": 0
    };
    customers.forEach(customer => {
        genderCounts[customer.jenis_kelamin]++;
    });

    // Buat grafik batang
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(genderCounts), // Label di sumbu X
            datasets: [{
                label: 'Jumlah Pelanggan',
                data: Object.values(genderCounts), // Data jumlah pelanggan
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


</body>
</html>