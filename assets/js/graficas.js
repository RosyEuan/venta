const { createApp } = Vue;
createApp({
  data() {
    return {
      isSidebarOpen: false
    };
  },
  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
    closeSidebar() {
      this.isSidebarOpen = false;
    }
  }
}).mount('#app');

// Ventas Diarias
const ventasDiariasCtx = document
  .getElementById('ventasDiarias')
  .getContext('2d');
new Chart(ventasDiariasCtx, {
  type: 'bar',
  data: {
    labels: ['🟡Platillos', '🔵Bebidas', '🟢Alcohol', '🔴Postres'],
    datasets: [
      {
        label: 'Ventas del Día',
        data: [50, 75, 80, 78, 100],
        backgroundColor: ['#EEE651', '#322A7F', '#77C97A', '#D64040']
      }
    ]
  }
});

// Ventas Semanales
const ventasSemanalesCtx = document
  .getElementById('ventasSemanales')
  .getContext('2d');
new Chart(ventasSemanalesCtx, {
  type: 'pie',
  data: {
    labels: ['Platillos', 'Bebidas', 'Alcohol', 'Postres'],
    datasets: [
      {
        data: [20, 25, 15, 40],
        backgroundColor: ['#4B51B8', '#E8EC07', '#D64040', '#77C97A']
      }
    ]
  }
});

// Ventas Anuales
const ventasAnualesCtx = document
  .getElementById('ventasAnuales')
  .getContext('2d');
// Crear el gradiente
const gradient = ventasAnualesCtx.createLinearGradient(0, 0, 0, 400); // De arriba a abajo (puedes ajustar las coordenadas)
gradient.addColorStop(0, 'rgba(139, 146, 241, 0.40)'); // Color inicial
gradient.addColorStop(0.7, 'rgba(119, 126, 232, 0.40)'); // Color intermedio
gradient.addColorStop(0.91, 'rgba(128, 136, 251, 0.40)'); // Otro color intermedio
gradient.addColorStop(1, 'rgba(129, 138, 255, 0.40)'); // Color final
new Chart(ventasAnualesCtx, {
  type: 'line',
  data: {
    labels: [
      'Ene',
      'Feb',
      'Mar',
      'Abr',
      'May',
      'Jun',
      'Jul',
      'Ago',
      'Sep',
      'Oct',
      'Nov',
      'Dic'
    ],
    datasets: [
      {
        label: 'Ventas Generales-Anual',
        data: [25, 36, 65, 53, 65, 45, 74, 74, 56, 73, 85, 100],
        borderColor: '#4B51B8',
        backgroundColor: gradient,
        fill: true
      }
    ]
  }
});
