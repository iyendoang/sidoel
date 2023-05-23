    <div class="col-12">
        <!-- profile -->
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Alamat Details</h4>
            </div>
            <div class="card-body py-2 my-25">
                <form class="form" id="form-editAddress" method="post">
                    <input type="hidden" class="form-control" name="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>" />
                    <div class="row">
                        <div class="col-12">
                            <h4 class="mb-1">
                                <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                <span class="align-middle">Alamat Lembaga</span>
                            </h4>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label class="form-label" for="lembaga_provinsi">Provinsi</label>
                                    <input type="text" id="lembaga_provinsi" class="form-control" name="lembaga_provinsi" placeholder="Alamat" value="<?= $t_lembaga['lembaga_provinsi'] ?>" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label class="form-label" for="lembaga_kota">Kota</label>
                                    <input type="text" id="lembaga_kota" class="form-control" name="lembaga_kota" placeholder="Alamat" value="<?= $t_lembaga['lembaga_kota'] ?>" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label class="form-label" for="lembaga_kec">Kecamatan</label>
                                    <input type="text" id="lembaga_kec" class="form-control" name="lembaga_kec" placeholder="Alamat" value="<?= $t_lembaga['lembaga_kec'] ?>" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label class="form-label" for="lembaga_kel">Kelurahan</label>
                                    <input type="text" id="lembaga_kel" class="form-control" name="lembaga_kel" placeholder="Alamat" value="<?= $t_lembaga['lembaga_kel'] ?>" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_alamat">Alamat</label>
                                <input type="text" id="lembaga_alamat" class="form-control" name="lembaga_alamat" placeholder="Alamat" value="<?= $t_lembaga['lembaga_alamat'] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_rt">RT</label>
                                <input type="text" id="lembaga_rt" class="form-control" name="lembaga_rt" placeholder="RT" value="<?= $t_lembaga['lembaga_rt'] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_rw">RW</label>
                                <input type="text" id="lembaga_rw" class="form-control" name="lembaga_rw" placeholder="RW" value="<?= $t_lembaga['lembaga_rw'] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_kodepos">Kode Pos</label>
                                <input type="text" id="lembaga_kodepos" class="form-control" name="lembaga_kodepos" placeholder="Kode Pos" value="<?= $t_lembaga['lembaga_kodepos'] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_notelp">Nomor Telpon</label>
                                <input type="text" id="lembaga_notelp" class="form-control" name="lembaga_notelp" placeholder="Nomor Telpon" value="<?= $t_lembaga['lembaga_notelp'] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_web">Website</label>
                                <input type="text" id="lembaga_web" class="form-control" name="lembaga_web" placeholder="Website" value="<?= $t_lembaga['lembaga_web'] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="lembaga_email">Email Lembaga</label>
                                <input type="text" id="lembaga_email" class="form-control" name="lembaga_email" placeholder="Email Lembaga" value="<?= $t_lembaga['lembaga_email'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-12 mt-1 mb-1 text-center">
                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="Institution/institution.js"></script>
