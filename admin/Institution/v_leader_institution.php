    <div class="col-12">
        <!-- profile -->
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Pengurus Details</h4>
            </div>
            <div class="card-body py-2 my-25">
                <!-- form -->
                <form class="form" id="form-editLeader" method="post">
                    <input type="hidden" class="form-control" name="lembaga_id" value="<?= $t_lembaga['lembaga_id'] ?>" />
                    <div class="row mt-1">
                        <div class="col-12">
                            <h4 class="">
                                <i data-feather="user" class="font-medium-4 mr-25"></i>
                                <span class="align-middle">Pimpinan </span>
                            </h4>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_kamad">Nama Kamad</label>
                                    <input id="lembaga_kamad" name="lembaga_kamad" type="text" class="form-control" value="<?= $t_lembaga['lembaga_kamad'] ?>" placeholder="Nama Kamad" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_nip_kamad">NIP Kamad</label>
                                    <input id="lembaga_nip_kamad" name="lembaga_nip_kamad" type="text" class="form-control" value="<?= $t_lembaga['lembaga_nip_kamad'] ?>" placeholder="NIP Kamad" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_kamad_notelp">No. HP Kamad</label>
                                    <input id="lembaga_kamad_notelp" name="lembaga_kamad_notelp" type="text" class="form-control" value="<?= $t_lembaga['lembaga_kamad_notelp'] ?>" placeholder="No. HP Kamad" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h4 class="">
                                <i data-feather="user" class="font-medium-4 mr-25"></i>
                                <span class="align-middle">Operator </span>
                            </h4>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_operator">Nama Operator</label>
                                    <input id="lembaga_operator" name="lembaga_operator" type="text" class="form-control" value="<?= $t_lembaga['lembaga_operator'] ?>" placeholder="Nama Operator" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_nip_operator">NIP Operator</label>
                                    <input id="lembaga_nip_operator" name="lembaga_nip_operator" type="text" class="form-control" value="<?= $t_lembaga['lembaga_nip_operator'] ?>" placeholder="NIP Operator" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_operator_notelp">No. HP Operator</label>
                                    <input id="lembaga_operator_notelp" name="lembaga_operator_notelp" type="text" class="form-control" value="<?= $t_lembaga['lembaga_operator_notelp'] ?>" placeholder="No. HP Operator" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h4 class="">
                                <i data-feather="user" class="font-medium-4 mr-25"></i>
                                <span class="align-middle">Pengawas </span>
                            </h4>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_pengawas">Nama Pengawas</label>
                                    <input id="lembaga_pengawas" name="lembaga_pengawas" type="text" class="form-control" value="<?= $t_lembaga['lembaga_pengawas'] ?>" placeholder="Nama Pengawas" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_nip_pengawas">NIP Pengawas</label>
                                    <input id="lembaga_nip_pengawas" name="lembaga_nip_pengawas" type="text" class="form-control" value="<?= $t_lembaga['lembaga_nip_pengawas'] ?>" placeholder="NIP Pengawas" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h4 class="">
                                <i data-feather="user" class="font-medium-4 mr-25"></i>
                                <span class="align-middle">Kasie PENMAD</span>
                            </h4>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_kasie">Nama Kasie</label>
                                    <input id="lembaga_kasie" name="lembaga_kasie" type="text" class="form-control" value="<?= $t_lembaga['lembaga_kasie'] ?>" placeholder="Nama Kasie" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_nip_kasie">NIP Kasie</label>
                                    <input id="lembaga_nip_kasie" name="lembaga_nip_kasie" type="text" class="form-control" value="<?= $t_lembaga['lembaga_nip_kasie'] ?>" placeholder="NIP Kasie" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h4 class="">
                                <i data-feather="user" class="font-medium-4 mr-25"></i>
                                <span class="align-middle">Komite </span>
                            </h4>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_komite">Nama Komite </label>
                                    <input id="lembaga_komite" name="lembaga_komite" type="text" class="form-control" value="<?= $t_lembaga['lembaga_komite'] ?>" placeholder="Nama Komite " />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="lembaga_nip_komite">NIP Komite </label>
                                    <input id="lembaga_nip_komite" name="lembaga_nip_komite" type="text" class="form-control" value="<?= $t_lembaga['lembaga_nip_komite'] ?>" placeholder="NIP Komite " />
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
