
<h2 class="fw-bolder mt-4">Pungutan</h2>
<div class="border-dashed border-1 rounded p-3 d-flex flex-column " style="border-color: lightgrey">
    <div class="form-group row border-dashed border-0 border-bottom-1 " style="color: lightgrey; padding-bottom: 10px">
        <div class="col-md-1"></div>
        <div class="col-md-3 border-dashed border-0 border-right-1" >
            <label class="form-label" >Ditangguhkan (Rp)</label>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            <label class="form-label   " >Dibebaskan (Rp)</label>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tidak Dipungut (Rp)</label>
        </div>
    </div>
    <div class="form-group row border-dashed border-0 border-bottom-1 " style="margin-top:10px;padding-bottom:10px;color: lightgrey; ">
        <div class="col-md-1 my-auto">
            <span class="h5">BM</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto" >
            <span class="form-text">{{@$outbound->detail_imports['bm_ditangguhkan'] ?? 0 }}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text"> {{@$outbound->detail_imports['bm_dibebaskan'] ?? 0 }}</span>
        </div>

        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['bm_tidak_dipungut'] ?? 0 }}</span>
        </div>
    </div>
    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">PPN</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['ppn_ditangguhkan'] ?? 0 }}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['ppn_dibebaskan'] ?? 0 }}</span>
        </div>
        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['ppn_tidak_dipungut'] ?? 0 }}</span>
        </div>
    </div>

    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">PPnBM</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['ppnbm_ditangguhkan'] ?? 0 ?? 0 }}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['ppnbm_dibebaskan'] ?? 0 ?? 0 }}</span>
        </div>
        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['ppnbm_tidak_dipungut'] ?? 0 }}</span>
        </div>
    </div>

    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">PPh</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['pph_ditangguhkan'] ?? 0 }}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['pph_dibebaskan'] ?? 0 }}</span>
        </div>
        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['pph_tidak_dipungut'] ?? 0 }}</span>
        </div>
    </div>

    <div class="form-group row " style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">Total</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['total_ditangguhkan'] ?? 0 }}</span>
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['total_dibebaskan'] ?? 0 }}</span>
        </div>
        <div class="col-md-3 my-auto">
            <span class="form-text">{{@$outbound->detail_imports['total_tidak_dipungut'] ?? 0 }}</span>
        </div>
    </div>
</div>


