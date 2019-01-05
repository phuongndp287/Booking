<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "index";
$route['booking/(:any)'] = "booking/$1";

$route['admin'] = "login";

$route['admin/([a-z]+)/(\d+)'] = "$1/id_$2";
//$route['t-admin'] = "backend";
$route['404_override'] = '';


$route['admin/suppliers'] = "admin/suppliers";
// đoạn này có ngĩa là khi người dùng truy cập vào admin/suppliers thì nó sẽ sang controller suppliers


$route['suppliers/addSupplier']='suppliers/addSupplier';

//$route['suppliers/docFileExcel']='suppliers/docFileExcel';
//$route['admin/docFile']='admin/docFile';


/* End of file routes.php */
/* Location: ./application/config/routes.php */

/// file này nó sẽ quản lý các route ok o:))
/// các route nó sẽ trỏ về một controler , các controler nó namwfw trog foder controller
// ví dụ thằng này nõ sẽ trỏ đến login trong controler $route['admin'] = "login";