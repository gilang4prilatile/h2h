<?php

namespace App\Providers;

use App\Models\BcForm;
use App\Models\File;
use App\Models\Good;
use App\Models\GoodConversion;
use App\Models\HsCode;
use App\Models\Inbound;
use App\Models\InboundDetail;
use App\Models\InboundDocument;
use App\Models\InboundHistory;
use App\Models\InboundJenisTpb;
use App\Models\InboundKppbc;
use App\Models\InboundProfile;
use App\Models\InboundTransportation;
use App\Models\InboundTransportationPort;
use App\Models\InboundTujuanPengiriman;
use App\Models\InboundValas;
use App\Models\InboundWarehouse;
use App\Models\InventoryConversionHistory;
use App\Models\InventoryConversion;
use App\Models\Inventory;
use App\Models\InventoryHistory;
use App\Models\MasterJenisTpb;
use App\Models\MasterKppbc;
use App\Models\MasterPackage;
use App\Models\MasterTujuanPengiriman;
use App\Models\Outbound;
use App\Models\OutboundDetail;
use App\Models\OutboundDocument;
use App\Models\OutboundHistory;
use App\Models\OutboundJenisTpb;
use App\Models\OutboundKppbc;
use App\Models\OutboundProfile;
use App\Models\OutboundTransportLine;
use App\Models\OutboundTransportation;
use App\Models\OutboundTujuanPengiriman;
use App\Models\OutboundValas;
use App\Models\Port;
use App\Models\Profile;
use App\Models\RatePreference;
use App\Models\Status;
use App\Models\Transportation;
use App\Models\TransportLine;
use App\Observers\BcFormObserver;
use App\Observers\FileObserver;
use App\Observers\GoodConversionObserver;
use App\Observers\GoodObserver;
use App\Observers\HsCodeObserver;
use App\Observers\InboundDetailObserver;
use App\Observers\InboundDocumentObserver;
use App\Observers\InboundHistoryObserver;
use App\Observers\InboundJenisTpbObserver;
use App\Observers\InboundKppbcObserver;
use App\Observers\InboundObserver;
use App\Observers\InboundProfileObserver;
use App\Observers\InboundTransportationObserver;
use App\Observers\InboundTujuanPengirimanObserver;
use App\Observers\InboundValasObserver;
use App\Observers\InboundWarehouseObserver;
use App\Observers\InventoryConversionHistoryObserver;
use App\Observers\InventoryConversionObserver;
use App\Observers\InventoryHistoryObserver;
use App\Observers\InventoryObserver;
use App\Observers\MasterJenisTpbObserver;
use App\Observers\MasterKppbcObserver;
use App\Observers\MasterPackageObserver;
use App\Observers\MasterTujuanPengirimanObserver;
use App\Observers\OutboundDetailObserver;
use App\Observers\OutboundDocumentObserver;
use App\Observers\OutboundHistoryObserver;
use App\Observers\OutboundJenisTpbObserver;
use App\Observers\OutboundKppbcObserver;
use App\Observers\OutboundObserver;
use App\Observers\OutboundProfileObserver;
use App\Observers\OutboundTransportationObserver;
use App\Observers\OutboundTransportLineObserver;
use App\Observers\OutboundTujuanPengirimanObserver;
use App\Observers\OutboundValasObserver;
use App\Observers\PortObserver;
use App\Observers\ProfileObserver;
use App\Observers\RatePreferencesObserver;
use App\Observers\StatusObserver;
use App\Observers\TransportationObserver;
use App\Observers\TransportLineObserver;
use App\View\Components\GlobalFlash;
use App\View\Components\Link\AddNew;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Table\Actions;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Services\ImportService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ImportService::class, function ($app) {
            return new ImportService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('table-actions', Actions::class);
        Blade::component('link-add-new', AddNew::class);
        Blade::component('global-flash', GlobalFlash::class);

        MasterKppbc::observe(MasterKppbcObserver::class);
        MasterJenisTpb::observe(MasterJenisTpbObserver::class);
        MasterTujuanPengiriman::observe(MasterTujuanPengirimanObserver::class);
        MasterPackage::observe(MasterPackageObserver::class);

        BcForm::observe(BcFormObserver::class);
        File::observe(FileObserver::class);
        Good::observe(GoodObserver::class);
        GoodConversion::observe(GoodConversionObserver::class);
        HsCode::observe(HsCodeObserver::class);

        InboundDetail::observe(InboundDetailObserver::class);
        InboundDocument::observe(InboundDocumentObserver::class);
        InboundHistory::observe(InboundHistoryObserver::class);
        InboundJenisTpb::observe(InboundJenisTpbObserver::class);
        InboundKppbc::observe(InboundKppbcObserver::class);
        Inbound::observe(InboundObserver::class);
        InboundProfile::observe(InboundProfileObserver::class);
        InboundTransportation::observe(InboundTransportationObserver::class);
        InboundTransportationPort::observe(InboundTransportationPort::class);
        InboundTujuanPengiriman::observe(InboundTujuanPengirimanObserver::class);
        InboundValas::observe(InboundValasObserver::class);
        InboundWarehouse::observe(InboundWarehouseObserver::class);

        InventoryConversionHistory::observe(InventoryConversionHistoryObserver::class);
        InventoryConversion::observe(InventoryConversionObserver::class);
        Inventory::observe(InventoryObserver::class);
        InventoryHistory::observe(InventoryHistoryObserver::class);

        OutboundDetail::observe(OutboundDetailObserver::class);
        OutboundDocument::observe(OutboundDocumentObserver::class);
        OutboundHistory::observe(OutboundHistoryObserver::class);
        OutboundJenisTpb::observe(OutboundJenisTpbObserver::class);
        OutboundKppbc::observe(OutboundKppbcObserver::class);
        Outbound::observe(OutboundObserver::class);
        OutboundProfile::observe(OutboundProfileObserver::class);
        OutboundTransportation::observe(OutboundTransportationObserver::class);
        OutboundTransportLine::observe(OutboundTransportLineObserver::class);
        OutboundTujuanPengiriman::observe(OutboundTujuanPengirimanObserver::class);
        OutboundValas::observe(OutboundValasObserver::class);

        Port::observe(PortObserver::class);
        Profile::observe(ProfileObserver::class);
        RatePreference::observe(RatePreferencesObserver::class);
        Status::observe(StatusObserver::class);
        Transportation::observe(TransportationObserver::class);
        TransportLine::observe(TransportLineObserver::class);
    }

    
}
