import Bootstrap from './bootstrap';
import Chart from 'chart.js/auto';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

require('datatables.net-buttons');


window.Alpine = Alpine;
window.Chart = Chart;
window.Swal = Swal;

window.$ = window.jQuery = require('jquery');



Alpine.start();