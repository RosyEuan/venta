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

// Graficas con chart y vue integrado

// Ventas Diarias
const ventasDiariasCtx = document
  .getElementById('ventasDiarias')
  .getContext('2d');
var ventasDiariasChart = new Chart(ventasDiariasCtx, {
  type: 'bar',
  data: {
    labels: [],
    datasets: [
      {
        label: 'Ventas del Día',
        backgroundColor: ['#EEE651', '#322A7F', '#77C97A', '#D64040']
      }
    ]
  }
});

// Ventas Semanales
const ventasSemanalesCtx = document
  .getElementById('ventasSemanales')
  .getContext('2d');
var ventasSemanalesChart = new Chart(ventasSemanalesCtx, {
  type: 'pie',
  data: {
    labels: [],
    datasets: [
      {
        data: [],
        backgroundColor: ['#4B51B8', '#E8EC07', '#D64040', '#77C97A']
      }
    ]
  }
});

// Ventas Anuales
const ventasAnualesCtx = document
  .getElementById('ventasAnuales')
  .getContext('2d');
var ventasAnualesChart = new Chart(ventasAnualesCtx, {
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
        data: [],
        borderColor: '#4B51B8',
        backgroundColor: 'rgba(139, 146, 241, 0.4)',
        fill: true
      }
    ]
  }
});
//
// Funciones para actualizar las gráficas por cada tipo de reporte (diario, semanal, mensual, anual)
const actualizarGraficaPorMenu = (datos) => {
  ventasDiariasChart.data.labels = [];
  ventasDiariasChart.data.datasets[0].data = [];

  datos.forEach((dato) => {
    dato.menus.forEach((menu) => {
      ventasDiariasChart.data.labels.push(menu.nombreMenu);
      ventasDiariasChart.data.datasets[0].data.push(menu.montoTotal);
    });
  });

  ventasDiariasChart.update();
  console.log('Gráfica diaria actualizada:', ventasDiariasChart.data);
};

const actualizarGraficaSemanal = (datos) => {
  ventasSemanalesChart.data.labels = [];
  ventasSemanalesChart.data.datasets[0].data = [];

  datos.forEach((dato) => {
    dato.menus.forEach((menu) => {
      ventasSemanalesChart.data.labels.push(menu.nombreMenu);
      ventasSemanalesChart.data.datasets[0].data.push(menu.montoTotal);
    });
  });

  ventasSemanalesChart.update();
  console.log('Gráfica semanal actualizada:', ventasSemanalesChart.data);
};

const actualizarGraficaAnual = (datos) => {
  const ventasPorMes = Array(12).fill(0);

  datos.forEach((dato) => {
    console.log(dato);
    console.log('Monto pago:', dato.montoTotal);
    console.log('fecha pago', dato.fecha);
    const mes = new Date(dato.fecha).getMonth();
    dato.menus.forEach((menu) => {
      ventasPorMes[mes] += menu.montoTotal;
    });
  });

  ventasAnualesChart.data.datasets[0].data = ventasPorMes;
  ventasAnualesChart.update();
  console.log('Gráfica anual actualizada:', ventasAnualesChart.data);
};

// Función para agrupar los datos por categoría (fecha y menú)
const agruparPorCategoria = (datos, tipo) => {
  const categorias = {};

  datos.forEach((dato) => {
    console.log('Mira aqui', dato);
    const nombreMenu = dato.nombre_menu || 'Sin categoría';
    const montoTotal = parseFloat(dato.monto_pago);
    const fechaPago = dato.fecha_pago || 'Sin fecha';

    if (!isNaN(montoTotal)) {
      if (!categorias[fechaPago]) categorias[fechaPago] = {};
      if (!categorias[fechaPago][nombreMenu])
        categorias[fechaPago][nombreMenu] = 0;

      // Sumar el monto total al menú y fecha
      categorias[fechaPago][nombreMenu] += montoTotal;
    } else {
      console.log(`Error con el monto_pago: ${dato.monto_pago}`);
    }
  });

  // Convertir el objeto en un arreglo con fecha y nombre de menú
  const datosArray = Object.entries(categorias).map(([fecha, menus]) => {
    return {
      fecha,
      menus: Object.entries(menus).map(([nombreMenu, montoTotal]) => {
        return { nombreMenu, montoTotal };
      })
    };
  });

  //console.log('Datos agrupados:', datosArray);

  // Actualizar la gráfica correspondiente
  if (tipo === 'dia') {
    actualizarGraficaPorMenu(datosArray);
  } else if (tipo === 'semana') {
    actualizarGraficaSemanal(datosArray);
  } else if (tipo === 'mes') {
    //actualizarGraficaMensual(datosArray);
  } else if (tipo === 'anual') {
    actualizarGraficaAnual(datosArray);
  }
};

// Función para hacer el fetch a cada reporte
const obtenerDatos = (url, tipo) => {
  fetch(url)
    .then((response) => {
      if (!response.ok) throw new Error('Error al obtener los datos');
      return response.json();
    })
    .then((data) => {
      console.log(data); // Verifica la estructura completa de los datos recibidos
      agruparPorCategoria(data, tipo);
    })
    .catch((error) => console.error(`Error al actualizar ${tipo}:`, error));
};

const urls = {
  dia: 'http://localhost/venta/api/reportes/dia',
  semana: 'http://localhost/venta/api/reportes/semana',
  mes: 'http://localhost/venta/api/reportes/mes',
  anual: 'http://localhost/venta/api/reportes/anual'
};

// Actualizar cada gráfica
Object.keys(urls).forEach((tipo) => {
  obtenerDatos(urls[tipo], tipo);
});
