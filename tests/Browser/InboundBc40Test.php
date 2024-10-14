<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class InboundBc40Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login');
            $browser->type('email', 'super@store2go.com');
            $browser->type('password', 'admin123');
            $browser->press('Masuk');
            $browser->assertPathIs('/dashboard');
            $browser->clickLink('BC-40');
            $browser->visit('/inbound/bc-40');
            $browser->clickLink('Add');
            $browser->visit('/inbound/bc-40/create');
            $browser->type('nomor_pengajuan', '123456');
            $browser->type('nomor_pendaftaran', '1234567');
            $browser->type('tanggal_pendaftaran', '2022-03-23');
            $browser->type('kode_gudang_plb', '12345');
            $browser->type('jenis_sarana_pengangkutan_darat', 'perahu');
            $browser->type('nomor_polisi', 'F 110 DE');
            $browser->type('harga_penyerahan', '15000');
            $browser->clickLink('Add');
            $browser->type('kt_package_repeater_basic[0][jumlah]', '112');
            $browser->select('1', 'kt_package_repeater_basic[0][package_id]');
            $browser->type('kt_package_repeater_basic[0][merk]', '1');
            $browser->clickLink('Add');
            $browser->type('kt_package_repeater_basic[1][jumlah]', '120');
            $browser->select('2', 'kt_package_repeater_basic[1][package_id]');
            $browser->type('kt_package_repeater_basic[1][merk]', '2');
            $browser->clickLink('Add');
            $browser->select('1', 'kt_document_repeater_basic[0][document_id]');
            $browser->type('kt_document_repeater_basic[0][date]', '2022-03-01');
            $browser->type('kt_document_repeater_basic[0][nomor_dokumen]', '123456');
            $browser->clickLink('Add');
            $browser->select('2', 'kt_document_repeater_basic[1][document_id]');
            $browser->type('kt_document_repeater_basic[1][date]', '2022-03-10');
            $browser->type('kt_document_repeater_basic[1][nomor_dokumen]', '1234567');
            $browser->type('barang_volume', '1234');
            $browser->type('barang_berat_kotor', '123');
            $browser->type('barang_berat_bersih', '123');
            $browser->clickLink('Data Detail');
            $browser->clickLink('Pilih barang');
            $browser->clickLink('Pilih');
            $browser->type('jumlah_satuan[]', '1');
            $browser->type('netto[]', '2');
            $browser->type('harga_penyerahan[]', '3');
            $browser->select('2', 'uom_id[]');
            $browser->type('volume[]', '1');
            $browser->clickLink('Data
                                        Header');
            $browser->press('Submit');
            $browser->assertPathIs('/inbound/bc-40');
        });
    }
}
