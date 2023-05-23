    <div class="col-12">
        <!-- profile -->
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Yayasan Details</h4>
            </div>
            <div class="card-body py-2 my-25">
                <!-- form -->
                <form class="form-block" id="form-editFoundation" method="post">
                    <input type="hidden" class="form-control" name="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>" />
                    <div class="row mt-1">
                        <div class="col-12">
                            <h4 class="">
                                <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                <span class="align-middle">Informasi Yayasan</span>
                            </h4>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="LY_noakta">No. Akte Pendirian</label>
                                    <input id="LY_noakta" name="LY_noakta" type="text" class="form-control" value="<?= $t_lembaga['LY_noakta'] ?>" placeholder="No. Akte Pendirian" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="LY_tglakta">Tgl. Akte Pendirian</label>
                                    <input id="LY_tglakta" name="LY_tglakta" type="text" class="form-control flatpickr-basic" value="<?= $t_lembaga['LY_tglakta'] ?>" placeholder="Tgl. Akte Pendirian" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="LY_namanotaris">Nama Notaris Akte Pendirian</label>
                                    <input id="LY_namanotaris" name="LY_namanotaris" type="text" class="form-control" value="<?= $t_lembaga['LY_namanotaris'] ?>" placeholder="Nama Notaris Akte Pendirian" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="LY_noakta_update">No. Akte Perubahan Terakhir</label>
                                    <input id="LY_noakta_update" name="LY_noakta_update" type="text" class="form-control" value="<?= $t_lembaga['LY_noakta_update'] ?>" placeholder="No. Akte Perubahan Terakhir" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="LY_tglakta_update">Tgl. Akte Perubahan Terakhir</label>
                                    <input id="LY_tglakta_update" name="LY_tglakta_update" type="text" class="form-control flatpickr-basic" value="<?= $t_lembaga['LY_tglakta_update'] ?>" placeholder="Tgl. Akte Perubahan Terakhir" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="LY_namaakta_update">Nama Notaris Akte Perubahan Terakhir</label>
                                    <input id="LY_namaakta_update" name="LY_namaakta_update" type="text" class="form-control" value="<?= $t_lembaga['LY_namaakta_update'] ?>" placeholder="Nama Notaris Akte Perubahan Terakhir" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="LY_sk_kemenkumham">No. SK Kemenkumham Terakhir</label>
                                    <input id="LY_sk_kemenkumham" name="LY_sk_kemenkumham" type="text" class="form-control" value="<?= $t_lembaga['LY_sk_kemenkumham'] ?>" placeholder="No. SK Kemenkumham Terakhir" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="LY_tgl_kemenkumham">Tgl. SK Kemenkumham Terakhir</label>
                                    <input id="LY_tgl_kemenkumham" name="LY_tgl_kemenkumham" type="text" class="form-control flatpickr-basic" value="<?= $t_lembaga['LY_tgl_kemenkumham'] ?>" placeholder="Tgl. SK Kemenkumham Terakhir" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-1 mb-1 text-center">
                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </form>
                <!--/ form -->
            </div>
        </div>
    </div>
    <script src="Institution/institution.js"></script>