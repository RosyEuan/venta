<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller']            = 'Welcome';
/* Rutas para acceder a las pantallas */
$route['404_override']                  = '';
$route['translate_uri_dashes']          = FALSE;

$route['menu']                          = 'Welcome/menu';
$route['mesas']                         = 'Welcome/mesas';
$route['reservaciones']                 = 'Welcome/reservaciones';
$route['modal_login']                   = 'Welcome/modal_login';
$route['modal_producto']                = 'Welcome/modal_producto';
$route['modal_proveedores']             = 'Welcome/modal_proveedores';
$route['modal_utilidad']                = 'Welcome/modal_utilidad';
$route['graficas2']                     = 'Welcome/graficas2';
$route['personal']                      = 'Welcome/personal';
$route['barra']                         = 'Welcome/barra';
$route['registrarse']                   = 'InicioSesion/CrearCuenta';
$route['iniciar_sesion']                = 'InicioSesion/VerificaSesion';
$route['cerrar_sesion']                 = 'InicioSesion/CerrarSesion';

$route['verificar_correo']              = 'Mailer/SolicitudRecuperar';
$route['dashboard']                     = 'dashboard/dashboard';

$route['modal_pedidos']                 = 'Welcome/modal_pedidos';
$route['perfil']                        = 'Welcome/perfil';
$route['user']                          = 'Welcome/user';
$route['recuperar/(:any)']              = 'cambio_contraseña/actualizarPassword/$1';
$route['modificacion/contrasena']       = 'cambio_contraseña/modificacion_contraseña';
//Reportes
$route['api/reportes/dia']              = 'ReportesController/Get_ventasDiarias';
$route['api/reportes/semana']           = 'ReportesController/Get_ventasSemanales';
$route['api/reportes/mes']              = 'ReportesController/Get_ventasMensuales';
$route['api/reportes/anual']            = 'ReportesController/Get_ventasAnuales';
// Menu
$route['api/menu/guardarplatillo']      = 'MenuController/GuardarPlatillo';
$route['api/menu/mostrarplatillo']      = 'MenuController/obtenerMenu';
$route['api/menu/actualizarplatillo']   = 'MenuController/ActualizarPlatillo';
$route['api/menu/mostrarcategorias']    = 'MenuController/MostrarCategorias';

$route['actualizarPassword']            = 'Welcome/actualizarPassword';
$route['datos_perfil']                  = 'MEditar_Perfil/obtenerPerfil';
$route['actualizar_perfil']             = 'MEditar_Perfil/actualizarPerfil';
$route['productos/inventario']          = 'Inventario/obtenerInventario';
$route['insertar/inventario']           = 'Inventario/insertarinventario';
$route['proveedores/inventario']        = 'Inventario/obtenerProveedores';
$route['actualizar/inventario']         = 'Inventario/actualizarInventario';
$route['eliminar/inventario']           = 'Inventario/eliminarProducto';
$route['obtener/proveedores']           = 'Proveedores/obtenerProveedores';
$route['insertar/proveedores']          = 'Proveedores/insertarProveedores';
$route['actualizar/proveedores']        = 'Proveedores/actualizar';
$route['eliminar/proveedores']          = 'Proveedores/eliminar';
$route['obtener/utilidades']            = 'Utilidad/obtenerUtilidades';
$route['insertar/utilidades']          = 'Utilidad/insertarUtilidad';
// Pedidos
$route['api/pedidos']                = 'pedidosController/GenerarPedido';

$route['obtener/platillos']             = 'Pedidos/obtenerPlatillos';
