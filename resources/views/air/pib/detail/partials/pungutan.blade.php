
<h2 class="fw-bolder mt-4">Pungutan</h2>
<div class="border-dashed border-1 rounded p-3 d-flex flex-column " style="border-color: lightgrey">
    <div class="form-group row border-dashed border-0 border-bottom-1 " style="color: lightgrey; padding-bottom: 10px">
        <div class="col-md-1"></div>
        <div class="col-md-3 border-dashed border-0 border-right-1" >
            <label class="form-label" >Dibayarkan (Rp)</label>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1" >
            <label class="form-label" >Ditangguhkan (Rp)</label>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            <label class="form-label" >Dibebaskan (Rp)</label>
        </div>
        <div class="col-md-2">
            <label class="form-label">Tidak Dipungut (Rp)</label>
        </div>
    </div>
    <div class="form-group row border-dashed border-0 border-bottom-1 " style="margin-top:10px;padding-bottom:10px;color: lightgrey; ">
        <div class="col-md-1 my-auto">
            <span class="h5">BM</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto"  style="text-align: right;">
            <span class="form-text" style="text-align: right;">{{@$inbound->details['bm_dibayarkan']}}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto" >
            <span class="form-text">{{@$inbound->details['bm_ditangguhkan']}}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text"> {{@$inbound->details['bm_dibebaskan']}}</span>
        </div>

        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$inbound->details['bm_tidak_dipungut']}}</span>
        </div>
    </div>
    <div class="form-group row border-dashed border-0 border-bottom-1 " style="margin-top:10px;padding-bottom:10px;color: lightgrey; ">
        <div class="col-md-1 my-auto">
            <span class="h5">BMT</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto" >
            <span class="form-text">{{@$inbound->details['bmt_dibayarkan']}}</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto" >
            <span class="form-text">{{@$inbound->details['bmt_ditangguhkan']}}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text"> {{@$inbound->details['bmt_dibebaskan']}}</span>
        </div>

        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$inbound->details['bmt_tidak_dipungut']}}</span>
        </div>
    </div>
    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">PPN</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['ppn_dibayarkan']}}</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['ppn_ditangguhkan']}}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['ppn_dibebaskan']}}</span>
        </div>
        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$inbound->details['ppn_tidak_dipungut']}}</span>
        </div>
    </div>

    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">PPnBM</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['ppnbm_dibayarkan']}}</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['ppnbm_ditangguhkan']}}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['ppnbm_dibebaskan']}}</span>
        </div>
        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$inbound->details['ppnbm_tidak_dipungut']}}</span>
        </div>
    </div>

    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">PPh</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['pph_dibayarkan']}}</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['pph_ditangguhkan']}}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['pph_dibebaskan']}}</span>
        </div>
        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$inbound->details['pph_tidak_dipungut']}}</span>
        </div>
    </div>

    <div class="form-group row " style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">Total</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['total_dibayarkan']}}</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['total_ditangguhkan']}}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$inbound->details['total_dibebaskan']}}</span>
        </div>
        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$inbound->details['total_tidak_dipungut']}}</span>
        </div>
    </div>
</div>


