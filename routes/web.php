<?php

use App\Http\Controllers\Inbound\InboundBC23Controller;
use App\Http\Controllers\MasterData\FasilitasController;
use App\Http\Controllers\MasterData\IncotermsController;
use App\Http\Controllers\MasterData\KursController;
use App\Http\Controllers\MasterData\PreferensiTarifController;
use App\Http\Controllers\PartialController;
use App\Http\Controllers\Air\AirPibController;

use App\Models\Country;
use App\Models\HsCode;
use App\Models\Inbound;
use App\Models\MasterKppbc;
use App\Models\MasterTPS;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(["web", "auth", "rbac"])->group(function () {
    Route::auto('dashboard', 'DashboardController');

    Route::auto("inbound", "Inbound\InboundController");

    Route::auto("inbound/bc-40", "Inbound\InboundBC40Controller");
    Route::auto("inbound/bc-23", "Inbound\InboundBC23Controller");
    Route::auto("inbound/bc-27", "Inbound\InboundBC27Controller");
    Route::auto("outbound/bc-41", "Outbound\OutboundBC41Controller");
    Route::auto("outbound/bc-25", "Outbound\OutboundBC25Controller");
    Route::auto("outbound/bc-27", "Outbound\OutboundBC27Controller");
    
    Route::auto("air/pib", "Air\AirPibController");
    Route::auto("air/peb", "Air\AirPebController");
    
    Route::auto("ocean/pib", "Ocean\OceanPibController");
    Route::auto("ocean/peb", "Ocean\OceanPebController");

    Route::auto("ftz/ftz0101", "Ftz\Ftz0101Controller");
    Route::auto("ftz/ftz0102", "Ftz\Ftz0102Controller");

    /*
    Route::auto("ftz/in", "Ftz\FtzInController");
    Route::auto("ftz/out", "Ftz\FtzOutController");
    */
    // Form
    Route::get("outbound/bc-25/form/tarif-fasilitas", "Outbound\OutboundBC25Controller@formTarifFasilitas");
    Route::get("outbound/bc-25/form/satuan-berat-harga", "Outbound\OutboundBC25Controller@formSatuanBeratHarga");

    // BEGIN INVENTORY 
    Route::auto('inventory', 'Inventory\InventoryController');
    Route::get('inventory/outbound/good/{id}', 'Inventory\InventoryController@getOutboundDataByGoodId');
    Route::get('inventory/inbound/good/{id}', 'Inventory\InventoryController@getInboundDataByGoodId');
    Route::get('inventory/inbound/good/{id}/ajax', 'Inventory\InventoryController@getInboundDataByGoodIdAjax');
    Route::get('inventory/current/good/{id}', 'Inventory\InventoryController@getCurrentDataByGoodId');
    Route::get('inventory/current/good/{id}/ajax', 'Inventory\InventoryController@getCurrentByGoodIdAjax');
    Route::get('inventory/conversion/good/{id}', 'Inventory\InventoryController@getConversionDataByGoodId');
    Route::get('inventory/conversion/good/{id}/ajax', 'Inventory\InventoryController@getConversionByGoodIdAjax');
    Route::get('inventory/outbound/good/{id}/ajax', 'Inventory\InventoryController@getOutboundDataByGoodIdAjax');

    Route::get('inventory/stock-in/good/{id}', 'Inventory\InventoryController@getStockInDataByGoodId');
    Route::get('inventory/stock-in/good/{id}/ajax', 'Inventory\InventoryController@getStockInDataByGoodIdAjax');
    Route::get('inventory/stock-out/good/{id}', 'Inventory\InventoryController@getStockOutDataByGoodId');
    Route::get('inventory/stock-out/good/{id}/ajax', 'Inventory\InventoryController@getStockOutDataByGoodIdAjax');
    Route::get('/air/pib/bc-satu-satu/{documentId}', [AirPibController::class, 'getBcSatuSatu']);
    // END INVENTORY 

    Route::auto('inventory-out', 'Inventory\InventoryOutController');

    Route::auto('inventory-conversion', 'Inventory\InventoryConversionController');
    Route::auto('inventory-conversion-out', 'Inventory\InventoryConversionOutController');
    Route::auto('inbound-details', 'Inbound\InboundDetailController');
    Route::auto('inbound-packages', 'Inbound\InboundPackageController');
    Route::auto('inbound-documents', 'Inbound\InboundDocumentController');
    Route::auto('inbound-peti-kemas', 'Inbound\InboundPetiKemasController');
    Route::auto('inbound-bank', 'Inbound\InboundBankController');
    Route::auto('inbound-profile', 'Inbound\InboundProfileController');
    Route::auto('inbound-transportations', 'Inbound\InboundTransportationController');

    Route::auto('outbound-details', 'Outbound\OutboundDetailController');
    Route::auto('outbound-detail-raw-goods', 'Outbound\OutboundDetailRawGoodController');
    Route::auto('outbound-packages', 'Outbound\OutboundPackageController');
    Route::auto('outbound-documents', 'Outbound\OutboundDocumentController');

    Route::auto("outbound", "Outbound\OutboundController");

    Route::prefix("master-data")->group(function () {
        Route::auto('country', 'MasterData\CountryController');

        Route::auto('origin-of-goods', 'MasterData\OriginGoodController');
        Route::auto('payment-method', 'MasterData\PaymentMethodController');
        Route::auto('trade-method', 'MasterData\TradeMethodController');
        Route::auto('place-of-origin', 'MasterData\PlaceOriginController');
        Route::auto('institutional-permission', 'MasterData\InstitutionalPermissionController');
        Route::auto('export-method', 'MasterData\ExportMethodController');
        Route::auto('type-of-guarantee', 'MasterData\TypeOfGuaranteeController');
        Route::auto('import-method', 'MasterData\ImportMethodController');
        Route::auto('bank', 'MasterData\BankController');
        Route::auto('good-category', 'MasterData\GoodCategoryController');
        Route::auto('expenditure-destination', 'MasterData\ExpenditureDestinationController');
        Route::auto('export-category', 'MasterData\ExportCategoryController');
        Route::auto('special-specification', 'MasterData\SpecialSpecificationController');
        Route::auto('transport-line', 'MasterData\TransportLineController');
        Route::auto('entrepreneur-status', 'MasterData\EntrepreneurStatusController');
        Route::auto('ftz-origin-of-goods', 'MasterData\Ftz\FtzOriginGoodController');
        Route::auto('master-status', 'MasterData\MasterStatusController');

        Route::auto('ftz-expenditure-goals', 'MasterData\Ftz\FtzExpenditureGoalsController');
        Route::auto('ftz-income-purpose', 'MasterData\Ftz\FtzIncomePurposeController');
 
        Route::auto('uom', 'MasterData\UomController');
        Route::auto('kppbc', 'MasterData\KppbcController');
        Route::auto('transportations', 'MasterData\TransportationController');
        Route::auto('tujuan-pengiriman', 'MasterData\TujuanPengirimanController');
        Route::auto('jenis-tpb', 'MasterData\JenisTpbController');
        Route::auto('package', 'MasterData\PackageController');
        Route::auto('document', 'MasterData\DocumentController');
        Route::auto('warehouse', 'MasterData\WarehouseController');

        // Peti Kemas
        Route::auto('ukuran-peti-kemas', 'MasterData\UkuranPetiKemasController');
        Route::auto('type-peti-kemas', 'MasterData\TypePetiKemasController');

        Route::auto('valas', 'MasterData\ValasController');
        Route::auto('tps', 'MasterData\TPSController');
        Route::auto('goods', 'MasterData\GoodController');
        Route::auto('type-goods', 'MasterData\TypeGoodsController');
        Route::auto('incoterms', 'MasterData\IncotermsController');
        Route::auto('good-conversions', 'MasterData\GoodConversionController');
        Route::auto('status', 'MasterData\StatusController');
        Route::auto('port', 'MasterData\PortController');
        Route::auto('profile', 'MasterData\ProfileController');
        Route::auto('fasilitas', 'MasterData\FasilitasController');
        Route::get('profile/form/nomor-izin', 'MasterData\ProfileController@formNomorIzin');
        Route::get('profile/form/country', 'MasterData\ProfileController@formCountry');
        Route::get('profile/form/api', 'MasterData\ProfileController@formApi');
        Route::get('profile/form/ppjk', 'MasterData\ProfileController@formPpjk');
        Route::get('profile/form/niper', 'MasterData\ProfileController@formNiper');
        Route::get('profile/form/warehouse', 'MasterData\ProfileController@formWarehouse');
        Route::auto('hscode', 'MasterData\HsCodeController');
        Route::get('hscode/{id}/ajax', 'MasterData\HsCodeController@getHsCodeByIdAjax');
        Route::auto('rate-preference', 'MasterData\RatePreferenceController');
        Route::post('goods/filter', 'MasterData\GoodController@filter');
    });


    // Route::prefix("inventory")->group(function () {
    //     Route::auto('header', 'Inventory\HeaderController');
    //     Route::auto('detail', 'Inventory\DetailController');
    // });

    Route::prefix("user-administration")->group(function () {
        Route::auto('role', 'UserAdministration\RoleController');
        Route::auto('user', 'UserAdministration\UserController');
    });

    Route::get('inbound/bc-40/detail/partial/{id}/{sku}', [PartialController::class, 'getpartialinbound']);

    Route::post('inbound/bc-40/detail/partial/{id}/{sku}/create', [PartialController::class, 'postpartialinbound']);

    Route::get('inbound/bc-40/detail/partial/{id}/{sku}/delete', [PartialController::class, 'deletePartialinbound']);

    Route::get('inbound/bc-40/detail/partial/{id}/{sku}/sppd', [PartialController::class, 'sppdPartialinbound']);

    Route::get('outbound/bc-41/detail/partial/{id}/{sku}', [PartialController::class, 'getpartialoutbound']);

    Route::post('outbound/bc-41/detail/partial/{id}/{sku}/create', [PartialController::class, 'postpartialoutbound']);

    Route::get('outbound/bc-41/detail/partial/{id}/{sku}/delete', [PartialController::class, 'deletePartialoutbound']);

    Route::get('outbound/bc-41/detail/partial/{id}/{sku}/sppd', [PartialController::class, 'sppdPartialoutbound']);

    Route::get('inbound/bc-23/detail/partial/{id}/{sku}', [PartialController::class, 'getpartialinbound']);

    Route::post('inbound/bc-23/detail/partial/{id}/{sku}/create', [PartialController::class, 'postpartialinbound']);

    Route::get('inbound/bc-23/detail/partial/{id}/{sku}/delete', [PartialController::class, 'deletePartialinbound']);

    Route::get('inbound/bc-23/detail/partial/{id}/{sku}/sppd', [PartialController::class, 'sppdPartialinbound']);

    Route::get('outbound/bc-25/detail/partial/{id}/{sku}', [PartialController::class, 'getpartialoutbound']);

    Route::post('outbound/bc-25/detail/partial/{id}/{sku}/create', [PartialController::class, 'postpartialoutbound']);

    Route::get('outbound/bc-25/detail/partial/{id}/{sku}/delete', [PartialController::class, 'deletePartialoutbound']);

    Route::get('outbound/bc-25/detail/partial/{id}/{sku}/sppd', [PartialController::class, 'sppdPartialoutbound']);
});


Route::auto('login', 'Auth\LoginController');
Route::auto('logout', 'Auth\LogoutController');
