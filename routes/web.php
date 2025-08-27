<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\InvoiceController;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;

// use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\DeliveryboyController;
use App\Http\Controllers\CustomerpageController;
use App\Http\Controllers\SuperadminacessController;
use App\Http\Controllers\CUstomerapprovalController;
use App\Http\Controllers\ProductmanagementController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [WebsiteController::class, 'home']);
Route::get('/menu', [WebsiteController::class, 'menu']);
Route::get('services', [WebsiteController::class, 'services']);
Route::get('/about', [WebsiteController::class, 'about']);
Route::get('/contact', [WebsiteController::class, 'contact']);
Route::get('/shop', [WebsiteController::class, 'shop']);

//get quantity
Route::post('get-item-by-quantity', [CustomerpageController::class, 'getitembyquantity']);


// customer
Route::get('/customer-register', [CustomerpageController::class, 'customersregisterpage']);
Route::post('/customer-register', [CustomerpageController::class, 'customersregister'])->name('customers.register');

Route::get('/customer-login', [CustomerpageController::class, 'customerloginpage'])->name('customer.login');
Route::post('/customer-Subscribe', [CustomerpageController::class, 'customerlogin'])->name('customers.login');

Route::get('/customer-forgotpassword', [CustomerpageController::class, 'customerforgotpassword'])->name('customer.forgotpassword');
Route::post('/customer-otpvalue', [CustomerpageController::class, 'customerotpvalue'])->name('customers.otpvalue');

Route::post('/customer-otpresend', [CustomerpageController::class, 'customerotpresend'])->name('customers.otpresend');

Route::post('/customer-changepassword', [CustomerpageController::class, 'customercheckotpvalue'])->name('customers.checkotpvalue');

Route::get('/customer-changepassword', [CustomerpageController::class, 'customerchangepage'])->name('customers.changepage');

Route::post('/customer-login', [CustomerpageController::class, 'customerchangepassword'])->name('customer.changepassword');


Route::get('/customer-otpvalue', [CustomerpageController::class, 'cutomerotpvaluepage'])->name('customer.otpvaluepage');
Route::get('/customer-otpresend', [CustomerpageController::class, 'cutomerotpvaluepage'])->name('customer.otpvaluepage');

// Route::post('/customer-pricing', [CustomerpageController::class, 'customerotpvaluesubs'])->name('customers.otpvaluesubs');

Route::group(['middleware' => 'islogin'], function () {

    // Route::get('/customer-home',[CustomerpageController::class,'customerhome']);
    Route::get('/customer-shop', [CustomerpageController::class, 'customershop'])->name( 'customer.shop' );
    Route::get('/customer-pricing', [CustomerpageController::class, 'customerpricing'])->name('customer.pricing');
    Route::get('/customer-payment', [CustomerpageController::class, 'customerpayment'])->name('customer.payment');
    Route::get('/customer-profile', [CustomerpageController::class, 'customerprofile']);

    Route::get('/customer-subscribefrom', [CustomerpageController::class, 'customersubcribeformpage']);
    Route::post('/customer-subscribefrom', [CustomerpageController::class, 'customersubcribeform'])->name('customer.subscribefrom');

    Route::post('customer-subscribeinsert', [CustomerpageController::class, 'customersubcribeinsert']);

    Route::post('/customer-subcriptioncancel', [CustomerpageController::class, 'subscriptioncancel'])->name('customer.subcriptioncancel');
    Route::post('/customersubscriptionchange', [CustomerpageController::class, 'subchange'])->name('customer.subchange');

    Route::post('/customersubscriptionupdate', [CustomerpageController::class, 'subcustomerupdate'])->name('customer.subscribeupdate');

    Route::post('/customer-additionalorder', [CustomerpageController::class, 'additionalorder'])->name('customer.additionalfrom');

    Route::post('/customer-additionalorderinsert', [CustomerpageController::class, 'additionalorderinsert'])->name('customer.additionalfrominsert');

    Route::post('/customer-snackscountupdate',[CustomerpageController::class,'snackscountupdate']);

    Route::post('/customer-orderpayment',[PaymentController::class,'orderpayment']);

    Route::get('/download-invoice/{invoiceId}', [InvoiceController::class,'downloadInvoice'])->name('download.invoice');

});
Route::post('/customer-login', [CustomerpageController::class, 'customerlogout'])->name('customer.logout');



Auth::routes();

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

//superAdmin Routes List
// Route::middleware(['auth', 'user-access:superadmin'])->group(function () {

//     Route::get('/superadmin-dashboard', [HomeController::class, 'superadminHome'])->name('superadmin.home');

//     //menu
//     Route::get('/superadmin-menu', [ProductmanagementController::class, 'superadminmenu'])->name('superadmin.menu');
//     Route::post('/superadmin-menuadd', [ProductmanagementController::class, 'superadminmenuadd'])->name('superadmin.menuadd');
//     Route::post('/superadmin-menuupdate/{id}', [ProductmanagementController::class, 'superadminmenuupdate'])->name('superadmin.menuupdate');
//     Route::get('/superadmin-menustatus/{id}', [ProductmanagementController::class, 'superadminmenustatus'])->name('superadmin.menustatus');

//     // Category
//     Route::get('/superadmin-category', [ProductmanagementController::class, 'superadmincategory'])->name('superadmin.category');
//     Route::post('/superadmin-categoryadd', [ProductmanagementController::class, 'superadmincategoryadd'])->name('superadmin.categoryadd');
//     Route::post('/superadmin-categoryupdate/{id}', [ProductmanagementController::class, 'superadmincategoryupdate'])->name('superadmin.categoryupdate');
//     Route::get('/superadmin-categorystatus/{id}', [ProductmanagementController::class, 'superadmincategorystatus'])->name('superadmin.categorystatus');

//     // Product
//     Route::get('/superadmin-product', [ProductmanagementController::class, 'superadminproduct'])->name('superadmin.product');
//     Route::post('/superadmin-productadd', [ProductmanagementController::class, 'superadminproductadd'])->name('superadmin.productadd');
//     Route::post('/superadmin-productupdate/{id}', [ProductmanagementController::class, 'superadminproductupdate'])->name('superadmin.productupdate');
//     Route::get('/superadmin-productstatus/{id}', [ProductmanagementController::class, 'superadminproductstatus'])->name('superadmin.productstatus');

//     Route::get('/superadmin-cus_alllist', [CUstomerapprovalController::class, 'cusalllist'])->name('superadmin.cus_alllist');
//     // Route::get('/superadmin-cus_approvallist', [CUstomerapprovalController::class, 'cusapprovallist'])->name('superadmin.cus_approvallist');
//     Route::get('/superadmin-cus_blocklist', [CUstomerapprovalController::class, 'cusblocklist'])->name('superadmin.cus_blockllist');
//     Route::get('/superadmin-cus_paymenthistory', [CUstomerapprovalController::class, 'cuspaymenthistory'])->name('superadmin.cus_paymenthistory');
//     Route::get('/superadmin-cus_subschange', [CUstomerapprovalController::class, 'cussubschange'])->name('superadmin.cus_subschange');
//     Route::get('/superadmin-cus_subscancel', [CUstomerapprovalController::class, 'cussubscancel'])->name('superadmin.cus_subscancel');

//     Route::get('/superadmin-cus_subschange/{id}', [CUstomerapprovalController::class, 'cussubschangeappro'])->name('superadmin.cus_subschangeappro');
//     Route::get('/superadmin-cus_subscancel/{id}', [CUstomerapprovalController::class, 'cussubscancelappro'])->name('superadmin.cus_subscancelappro');

//     Route::get('/superadmin-cus_appro/{id}', [CUstomerapprovalController::class, 'cusappro'])->name('superadmin.custappro');
//     Route::get('/superadmin-cus_block/{id}', [CUstomerapprovalController::class, 'cusblock'])->name('superadmin.custblock');
//     Route::get('/superadmin-cus_blockappro/{id}', [CUstomerapprovalController::class, 'cusblockappro'])->name('superadmin.custblockappro');

//     // subscribe
//     Route::get('/superadmin-subscriptionplan', [CUstomerapprovalController::class, 'subscriptionplan'])->name('superadmin.subscriptionplan');

//     //stock
//     Route::post('/superadmin-stockadd', [SuperadminacessController::class, 'stockadd'])->name('superadmin.stockadd');
//     Route::post('/superadmin-stockupdate/{id}', [SuperadminacessController::class, 'stockupdate'])->name('superadmin.stockupdate');
//     Route::get('/superadmin-stockcontainers', [SuperadminacessController::class, 'stockcontainers'])->name('superadmin.stockcontainers');

//     //delivery
//     Route::get('/superadmin-deliveryboy-profileadd', [DeliveryboyController::class, 'profilecreate'])->name('superadmin.deliveryprofilecreate');
//     Route::post('/superadmin-deliveryboy-profilestore', [DeliveryboyController::class, 'store'])->name('superadmin.deliveryprofilestore');
//     Route::get('/superadmin-deliveryboy-profileindex', [DeliveryboyController::class, 'profileindex'])->name('superadmin.deliveryprofileindex');
//     Route::post('/superadmin-deliveryboy-profileupdate/{id}', [DeliveryboyController::class, 'update'])->name('superadmin.deliveryprofilupdate');

//     Route::get('/superadmin-deliveryboy-status/{id}', [DeliveryboyController::class, 'profilestatus'])->name('superadmin.deliveryboystatus');

//     // Route::get('/superadmin-forgotpassword', [SuperadminacessController::class, 'forgotpassword'])->name('superadmin.forgotpassword');
//     // Route::get('/superadmin-profile', [SuperadminacessController::class, 'profile'])->name('superadmin.profile');

//     //order
//     Route::get('/superadmin-confirmorder', [OrderController::class, 'confirmorder'])->name('superadmin.confirmorder');
//     Route::get('/superadmin-todayorder', [OrderController::class, 'todayorder'])->name('superadmin.todayorder');
//     Route::get('/superadmin-additionalorder', [OrderController::class, 'additionalorder'])->name('superadmin.additionalorder');

//     Route::post('/superadmin-orderconfirm', [OrderController::class, 'orderconfirm'])->name('superadmin.orderconfirm');
// });

//delivery Routes List
Route::middleware(['auth', 'user-access:delivery'])->group(function () {

    Route::get('/delivery-dashboard', [HomeController::class, 'deliveryHome'])->name('delivery.home');
    Route::get('/delivery-orderlist/{ses}', [DeliveryboyController::class, 'orderlist'])->name('delivery.orderlist');
    Route::get('/delivery-pendingorder/{ses}', [DeliveryboyController::class, 'pendingorder'])->name('delivery.pendingorder');
    Route::get('/delivery-completedorder/{ses}', [DeliveryboyController::class, 'completedorder'])->name('delivery.completedorder');
    Route::post('/processQRCode', [DeliveryboyController::class, 'processQRCode'])->name('processQRCode');
    Route::post('/deliveryboy-deliverystatus', [DeliveryboyController::class, 'deliverystatus'])->name('delivery.deliverystatus');
    Route::get('/deliveryboy-orderview/{cust_id}', [DeliveryboyController::class, 'orderview'])->name('delivery.orderview');
    Route::get('/deliveryboy-pendingorderview/{cust_id}', [DeliveryboyController::class, 'pendingorderview'])->name('delivery.pendingorderview');
    Route::get('/deliveryboy-completeorderview/{cust_id}', [DeliveryboyController::class, 'completeorderview'])->name('delivery.completeorderview');
        //profile
        Route::get('/delivery-profile', [DeliveryboyController::class, 'profile'])->name('delivery.profile');

        // container
        Route::get('/deliveryboy-customerlist/{customerId}', [DeliveryboyController::class, 'customerlist'])->name('delivery.customerlist');
        Route::get('/deliveryboy-containerdetail/{customerId}', [DeliveryboyController::class, 'containerdetail'])->name('delivery.containerdetail');
        Route::post('/deliveryboy-containerupdate', [DeliveryboyController::class, 'containerupdate'])->name('delivery.containerupdate');


});

//adminbranch Routes List
Route::middleware(['auth', 'user-access:branchadmin'])->group(function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::get('/dashboard', [HomeController::class, 'adminHome'])->name('admin.home');
        //menu
        Route::get('/menu', [ProductmanagementController::class, 'adminmenu'])->name('admin.menu');
        Route::post('/menuadd', [ProductmanagementController::class, 'adminmenuadd'])->name('admin.menuadd');
        Route::post('/menuupdate/{id}', [ProductmanagementController::class, 'adminmenuupdate'])->name('admin.menuupdate');
        Route::get('/menustatus/{id}', [ProductmanagementController::class, 'adminmenustatus'])->name('admin.menustatus');

        // Category
        Route::get('/category', [ProductmanagementController::class, 'admincategory'])->name('admin.category');
        Route::post('/categoryadd', [ProductmanagementController::class, 'admincategoryadd'])->name('admin.categoryadd');
        Route::post('/categoryupdate/{id}', [ProductmanagementController::class, 'admincategoryupdate'])->name('admin.categoryupdate');
        Route::get('/categorystatus/{id}', [ProductmanagementController::class, 'admincategorystatus'])->name('admin.categorystatus');

        // Product
        Route::get('/product', [ProductmanagementController::class, 'adminproduct'])->name('admin.product');
        Route::post('/productadd', [ProductmanagementController::class, 'adminproductadd'])->name('admin.productadd');
        Route::post('/productupdate/{id}', [ProductmanagementController::class, 'adminproductupdate'])->name('admin.productupdate');
        Route::get('/productstatus/{id}', [ProductmanagementController::class, 'adminproductstatus'])->name('admin.productstatus');

        Route::get('/cus_alllist', [CUstomerapprovalController::class, 'cusalllist'])->name('admin.cus_alllist');
        // Route::get('/cus_approvallist', [CUstomerapprovalController::class, 'cusapprovallist'])->name('admin.cus_approvallist');
        Route::get('/cus_blocklist', [CUstomerapprovalController::class, 'cusblocklist'])->name('admin.cus_blockllist');
        Route::get('/cus_paymenthistory', [CUstomerapprovalController::class, 'cuspaymenthistory'])->name('admin.cus_paymenthistory');
        Route::get('/cus_subschange', [CUstomerapprovalController::class, 'cussubschange'])->name('admin.cus_subschange');
        Route::get('/cus_subscancel', [CUstomerapprovalController::class, 'cussubscancel'])->name('admin.cus_subscancel');

        Route::get('/cus_subschange/{id}', [CUstomerapprovalController::class, 'cussubschangeappro'])->name('admin.cus_subschangeappro');
        Route::get('/cus_subscancel/{id}', [CUstomerapprovalController::class, 'cussubscancelappro'])->name('admin.cus_subscancelappro');

        Route::get('/cus_appro/{id}', [CUstomerapprovalController::class, 'cusappro'])->name('admin.custappro');
        Route::get('/cus_block/{id}', [CUstomerapprovalController::class, 'cusblock'])->name('admin.custblock');
        Route::get('/cus_blockappro/{id}', [CUstomerapprovalController::class, 'cusblockappro'])->name('admin.custblockappro');

        // subscribe
        Route::get('/subscriptionplan', [CUstomerapprovalController::class, 'subscriptionplan'])->name('admin.subscriptionplan');

        //stock
        Route::post('/stockadd', [SuperadminacessController::class, 'stockadd'])->name('admin.stockadd');
        Route::post('/stockupdate/{id}', [SuperadminacessController::class, 'stockupdate'])->name('admin.stockupdate');
        Route::get('/stockcontainers', [SuperadminacessController::class, 'stockcontainers'])->name('admin.stockcontainers');

        //delivery
        Route::get('/deliveryboy-profileadd', [DeliveryboyController::class, 'profilecreate'])->name('admin.deliveryprofilecreate');
        Route::post('/deliveryboy-profilestore', [DeliveryboyController::class, 'store'])->name('admin.deliveryprofilestore');
        Route::get('/deliveryboy-profileindex', [DeliveryboyController::class, 'profileindex'])->name('admin.deliveryprofileindex');
        Route::post('/deliveryboy-profileupdate/{id}', [DeliveryboyController::class, 'update'])->name('admin.deliveryprofilupdate');
        Route::post('/deliveryboy-deliverylogin', [DeliveryboyController::class, 'deliverylogin'])->name('admin.deliverylogin');
        Route::post('/deliveryboy-deliveryloginupdate', [DeliveryboyController::class, 'deliveryloginupdate'])->name('admin.deliveryloginupdate');
        Route::get('/deliveryboy-status/{id}', [DeliveryboyController::class, 'profilestatus'])->name('admin.deliveryboystatus');

        // Route::get('/forgotpassword', [SuperadminacessController::class, 'forgotpassword'])->name('admin.forgotpassword');
        // Route::get('/profile', [SuperadminacessController::class, 'profile'])->name('admin.profile');

        //order
        Route::get('/confirmorder', [OrderController::class, 'confirmorderview'])->name('admin.confirmorder');
        Route::get('/todayorder', [OrderController::class, 'todayorder'])->name('admin.todayorder');
        Route::get('/additionalorder', [OrderController::class, 'additionalorder'])->name('admin.additionalorder');

        Route::post('/orderconfirm', [OrderController::class, 'orderconfirm'])->name('admin.orderconfirm');

        Route::get('/packing_run/{id}', [OrderController::class, 'packingrun'])->name('admin.packingstatus_run');
        Route::get('/packing_complete/{id}', [OrderController::class, 'packingcomplete'])->name('admin.packingstatus_complete');
        Route::post('/assumedelivery', [OrderController::class, 'assumedelivery'])->name('admin.deliveryboyassume');
        Route::post('/rejectorder', [OrderController::class, 'rejectorder'])->name('admin.rejectorder');
        Route::post('/reconfirmorder', [OrderController::class, 'reconfirmorder'])->name('admin.orderreconfirm');


        //Report

        Route::get('/subscriberreport', [ReportController::class, 'subscribersPerMonth'])->name('admin.subscribersPerMonth');
        Route::get('/deliveryreport/{detail}', [ReportController::class, 'deliveryreport'])->name('admin.deliveryreport');
        Route::get('/paymentreport/{detail}', [ReportController::class, 'paymentreport'])->name('admin.paymentreport');
        Route::get('/containerreport/{detail}', [ReportController::class, 'ContainerReport'])->name('admin.containerreport');
        Route::get('/invoicereport/{detail}', [ReportController::class, 'InvoiceReport'])->name('admin.invoicereport');

        //print
        Route::get('/print', [PrinterController::class, 'index'])->name('print');
        Route::get('/printview', [PrinterController::class, 'view'])->name('printview');

        Route::get('/custpaymentapproval/{custid}',[CUstomerapprovalController::class,'custpaymentapproval'])->name('admin.custloginblock');
    });
});
