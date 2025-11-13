import './bootstrap'; // ini biasanya setup default Laravel
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js'; // penting! sudah include Poppe
import Chart from 'chart.js/auto'; // impor Chart.js

window.Chart = Chart; // buat Chart.js bisa diakses secara global
