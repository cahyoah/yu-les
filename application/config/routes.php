<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] 	= FALSE;
$route['api/murid/register']['POST'] 	= 'murid/RegisterMuridController/saveMurid';
$route['api/murid/login']['POST'] 	= 'murid/LoginMuridController/loginMurid';
$route['api/murid/newalamat']['POST'] 	= 'murid/AlamatController/saveAlamat';
$route['api/murid/updatealamat']['POST'] 	= 'murid/AlamatController/updateAlamat';
$route['api/murid/updateuser']['POST'] 	= 'murid/UpdateAkunMuridController/updateUser';
$route['api/murid/updatenama']['POST'] 	= 'murid/UpdateAkunMuridController/updateNamaMurid';
$route['api/murid/updateemail']['POST'] 	= 'murid/UpdateAkunMuridController/updateEmailMurid';
$route['api/murid/updatefoto']['POST'] 	= 'murid/UpdateAkunMuridController/updateFotoProfilPengguna';
$route['api/murid/updatepassword']['POST'] 	= 'murid/UpdateAkunMuridController/updatePasswordMurid';
$route['api/murid/updatenotelepon']['POST'] 	= 'murid/UpdateAkunMuridController/updateNoTeleponMurid';
$route['api/murid/updateLocation']['POST'] 	= 'murid/LocationMuridUpdateController/updateLocation';
$route['api/cariguru/getallteacher']['POST'] 	= 'cariguru/CariGuruController/getTeacher';
$route['api/cariguru/getteacherwithid']['POST'] 	= 'cariguru/CariGuruController/getTeacherWithID';
$route['api/order/makeorder']['POST'] 	= 'order/OrderController/makeOrder';
$route['api/order/getordermurid']['POST'] 	= 'order/OrderController/getOrderMuridByIdMurid';
$route['api/order/cancelorder']['POST'] 	= 'order/OrderController/cancelOrderByIdOrder';
$route['api/order/getordermuridbyidorder']['POST'] 	= 'order/OrderController/getOrderMuridByIdOrder';

$route['api/guru/register']['POST'] 	= 'guru/RegisterGuruController/saveGuru';
$route['api/guru/login']['POST'] 	= 'guru/LoginGuruController/loginGuru';
$route['api/guru/updatepassword']['POST'] 	= 'guru/UpdateAkunGuruController/updatePasswordPengajar';
$route['api/guru/updateuser']['POST'] 	= 'guru/UpdateAkunGuruController/updateUserGuru';
$route['api/guru/updatelocation']['POST'] 	= 'guru/LocationGuruUpdateController/updateLocation';
$route['api/order/getorderpengajar']['POST'] 	= 'order/OrderController/getOrderMuridByIdPengajar';
$route['api/order/getorderdetailpengajarbyidorder']['POST'] 	= 'order/OrderController/getOrderDetailPengajarByIdOrder';
$route['api/order/changeorderstatus']['POST'] 	= 'order/OrderController/changeorderstatus';
$route['api/status/changeguruoffstate']['POST'] 	= 'guru/StatusGuruController/changeGuruOffState';
$route['api/status/changeguruonstate']['POST'] 	= 'guru/StatusGuruController/changeGuruOnState';
$route['api/status/changeguruorderavailablestate']['POST'] 	= 'guru/StatusGuruController/changeGuruOrderAvailableState';
$route['api/status/changeguruordernotavailablestate']['POST'] 	= 'guru/StatusGuruController/changeGuruOrderNotAvailableState';
$route['api/status/changeguruorderoffavailablestate']['POST'] 	= 'guru/StatusGuruController/changeGuruOffAvailableState';
$route['api/status/changeguruorderonnotavailablestate']['POST'] 	= 'guru/StatusGuruController/changeGuruOnAvailableState';
