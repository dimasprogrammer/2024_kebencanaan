                                <!-- Panel 6 -->
                                <div class="tab-pane fade" id="panel6" role="tabpanel">
                                    <div class="card-body mb-0">
                                        <div id="errEntry-relawan"></div>
                                        <form action="<?= site_url(isset($siteUri) ? $siteUri.'/create/relawan' : '') ?>" id="formEntry-relawan">
                                        <div class="row justify-content-center">
                                            <div class="table-responsive-md col-lg-8 col-md-10 col-sm-12">
                                                <table cellspacing="0" class="table table-striped table-sm table-bordered mb-0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%" class="font-weight-bold text-center align-middle">No</th>
                                                            <th width="75%" class="font-weight-bold text-center align-middle">Nama Organisasi</th>
                                                            <th width="20%" class="font-weight-bold text-center align-middle">Jumlah Relawan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="content-relawan">
                                                        <tr>
                                                            <td class="text-center" colspan="3">No Data</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end">

                                                    <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light px-2 py-1 font-weight-bold" name="btn-remove-relawan" id="btn-remove-relawan">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light px-2 py-1 font-weight-bold" name="btn-add-relawan" id="btn-add-relawan">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save-relawan"><i class="fas fa-check"></i> Simpan Data </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Panel 6 -->