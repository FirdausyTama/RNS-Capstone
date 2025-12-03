
// Base API URL - Adjust if backend port differs
const API_BASE_URL = 'http://127.0.0.1:8000/api';

// Format Rupiah
const formatRupiah = (number) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number);
};

// Load Dashboard Data
document.addEventListener('DOMContentLoaded', async () => {
    try {
        await Promise.all([
            loadSummaryData(),
            loadRecentTransactions(),
            loadCharts()
        ]);
    } catch (error) {
        console.error('Error loading dashboard data:', error);
    }
});

async function loadSummaryData() {
    try {
        // 1. Total Pelanggan (Users) - Using Pembelian count as proxy or mock if no user endpoint
        // Since we don't have a direct User endpoint in the provided list, we'll try to fetch unique users from Pembelian or Stok
        // For now, let's fetch Pembelian and count unique names or just use a placeholder if not available.
        // Actually, StokController has 'user_id', so maybe we can't easily count users without a User endpoint.
        // Let's try to fetch /api/pembelian to count pending payments and total revenue.
        
        const resPembelian = await fetch(`${API_BASE_URL}/pembelian`);
        const pembelianData = await resPembelian.json();

        // Total Pembelian (Revenue)
        const totalRevenue = pembelianData.reduce((sum, item) => sum + parseFloat(item.grand_total), 0);
        document.getElementById('totalPembelian').innerText = formatRupiah(totalRevenue);

        // Pembayaran Tertunda
        const pendingCount = pembelianData.filter(item => item.status_pembayaran !== 'lunas').length;
        document.getElementById('pembayaranTertunda').innerText = pendingCount;

        // Total Pelanggan (Unique names from pembelian as a proxy)
        const uniqueCustomers = new Set(pembelianData.map(item => item.penerima_nama)).size;
        document.getElementById('totalPelanggan').innerText = uniqueCustomers;


        // Total Dokumen (Sum of SPH, Invoice, Surat Jalan, Kwitansi)
        // We need to fetch counts for each.
        const [resSph, resInv, resSj, resKwitansi] = await Promise.all([
            fetch(`${API_BASE_URL}/sph`),
            fetch(`${API_BASE_URL}/invoice`),
            fetch(`${API_BASE_URL}/surat-jalan`),
            fetch(`${API_BASE_URL}/kwitansi`)
        ]);

        const sphData = await resSph.json();
        const invData = await resInv.json();
        const sjData = await resSj.json();
        const kwitansiData = await resKwitansi.json();

        const totalDokumen = (sphData.length || 0) + (invData.length || 0) + (sjData.length || 0) + (kwitansiData.length || 0);
        document.getElementById('totalDokumen').innerText = totalDokumen;

    } catch (error) {
        console.error('Error loading summary data:', error);
    }
}

async function loadRecentTransactions() {
    try {
        const res = await fetch(`${API_BASE_URL}/pembelian`);
        const data = await res.json();
        
        // Sort by date desc and take top 5
        const recent = data.sort((a, b) => new Date(b.tgl_transaksi) - new Date(a.tgl_transaksi)).slice(0, 5);
        
        const listContainer = document.getElementById('recentTransactionsList');
        listContainer.innerHTML = '';

        recent.forEach(item => {
            const isLunas = item.status_pembayaran === 'lunas';
            const badgeClass = isLunas ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning';
            const statusText = isLunas ? 'Lunas' : 'Cicilan'; // or item.status_pembayaran

            const html = `
                <li class="list-group-item">
                    <div class="d-flex">
                        <div class="flex-shrink-0 align-self-center">
                            <div class="align-content-center text-center border border-dashed rounded-circle p-1">
                                <i class="mdi mdi-account-circle fs-24 text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 align-content-center">
                            <div class="row">
                                <div class="col-7 col-md-5 order-md-1">
                                    <h6 class="mb-1 text-dark fs-15">${item.penerima_nama}</h6>
                                    <span class="fs-14 text-muted">${item.no_order}</span>
                                </div>
                                <div class="col-5 col-md-4 order-md-3 text-end mt-2 mt-md-0">
                                    <h6 class="mb-1 text-dark fs-14">${formatRupiah(item.grand_total)}</h6>
                                    <span class="fs-13 text-muted">${new Date(item.tgl_transaksi).toLocaleDateString('id-ID')}</span>
                                </div>
                                <div class="col-auto col-md-3 order-md-2 align-self-center">
                                    <span class="badge ${badgeClass} fw-semibold rounded-pill">${statusText}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            `;
            listContainer.innerHTML += html;
        });

    } catch (error) {
        console.error('Error loading recent transactions:', error);
    }
}

async function loadCharts() {
    // Sales Overview Chart (Monthly Revenue)
    try {
        const res = await fetch(`${API_BASE_URL}/pembelian`);
        const data = await res.json();

        // Group by month
        const monthlyRevenue = {};
        data.forEach(item => {
            const month = new Date(item.tgl_transaksi).toLocaleString('default', { month: 'short' });
            monthlyRevenue[month] = (monthlyRevenue[month] || 0) + parseFloat(item.grand_total);
        });

        const categories = Object.keys(monthlyRevenue);
        const seriesData = Object.values(monthlyRevenue);

        // Update ApexChart if it exists (assuming global variable 'chart' or re-render)
        // Since we can't easily access the existing chart instance without modifying the init file,
        // we might need to clear the container and render a new one, or try to update it.
        // For simplicity, let's re-render the chart in #sales-overview
        
        const salesOptions = {
            series: [{
                name: "Total Pendapatan",
                data: seriesData
            }],
            chart: {
                type: "area",
                height: 300,
                parentHeightOffset: 0,
                toolbar: { show: false }
            },
            dataLabels: { enabled: false },
            colors: ["#108dff"],
            stroke: { curve: "smooth", width: 2 },
            xaxis: { categories: categories },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return formatRupiah(val);
                    }
                }
            },
            grid: { strokeDashArray: 3 },
            fill: { opacity: 1 }
        };

        const salesChart = new ApexCharts(document.querySelector("#sales-overview"), salesOptions);
        salesChart.render();

    } catch (error) {
        console.error('Error loading sales chart:', error);
    }

    // Stock Summary Chart & List
    try {
        // 1. Fetch Summary for Chart
        const resSummary = await fetch(`${API_BASE_URL}/stoks/summary`);
        const summaryData = await resSummary.json();
        
        const stockOptions = {
            series: [parseInt(summaryData.total_masuk), parseInt(summaryData.total_keluar)],
            labels: ["Stok Masuk", "Stok Keluar"],
            chart: { type: "donut", height: 225 },
            plotOptions: { pie: { size: 100, donut: { size: "70%" } } },
            dataLabels: { enabled: false },
            legend: { show: true, position: 'bottom' },
            colors: ["#287F71", "#E77636"]
        };

        document.querySelector("#top-session").innerHTML = '';
        const stockChart = new ApexCharts(document.querySelector("#top-session"), stockOptions);
        stockChart.render();

        // 2. Fetch Stock List for "Total Persediaan Stok" details
        const resStoks = await fetch(`${API_BASE_URL}/stoks`);
        const stoksData = await resStoks.json();
        const stoks = stoksData.data || stoksData; // Handle pagination wrapper if exists

        // Sort by quantity desc and take top 5
        const topStoks = stoks.sort((a, b) => b.jumlah - a.jumlah).slice(0, 5);
        
        const stockListContainer = document.getElementById('stockListContainer');
        stockListContainer.innerHTML = '<div class="col">';

        const colors = ["text-success", "text-primary", "text-warning", "text-danger", "text-info"];

        topStoks.forEach((item, index) => {
            const color = colors[index % colors.length];
            const html = `
                <div class="d-flex justify-content-between align-items-center p-1">
                    <div>
                        <i class="mdi mdi-circle fs-12 align-middle me-1 ${color}"></i>
                        <span class="align-middle fw-semibold">${item.nama_barang}</span>
                    </div>
                    <span class="fw-medium text-muted float-end">
                        <i class="mdi mdi-arrow-up text-success align-middle fs-14 me-1"></i>${item.jumlah} Stok
                    </span>
                </div>
            `;
            stockListContainer.querySelector('.col').innerHTML += html;
        });
        stockListContainer.innerHTML += '</div>';

    } catch (error) {
        console.error('Error loading stock data:', error);
        document.getElementById('stockListContainer').innerHTML = '<div class="text-center text-danger">Gagal memuat data stok</div>';
    }
}
