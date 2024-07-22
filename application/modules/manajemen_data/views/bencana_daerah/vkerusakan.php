                                <!-- Panel 2 -->
                                <div class="tab-pane fade" id="panel2" role="tabpanel">
                                    <br>
                                    <div class="card-body mb-0">
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-center">Kerusakan Sarana</th>
                                                        <th width="20%" class="font-weight-bold text-center">Rusak Berat</th>
                                                        <th width="20%" class="font-weight-bold text-center">Rusak Sedang</th>
                                                        <th width="20%" class="font-weight-bold text-center">Rusak Ringan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php echo form_hidden('tokenId', $token['token_bencana_detail']); ?>
                                                    <?php echo form_hidden('tokenId', $token['token_bencana']); ?>
                                                    <?php $no_urut = 0;
                                                    foreach ($sarana_rusak as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_sarana; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_berat" id="rusak_berat" required> </td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_sedang" id="rusak_sedang" required> </td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_ringan" id="rusak_ringan" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-left">Rumah Terendam</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($sarana_terendam as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_sarana; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_berat" id="rusak_berat" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <br>
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-left">Sarana Lainnya</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($sarana_lainnya as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_sarana; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="rusak_berat" id="rusak_berat" required> </td>
                                                        </tr>
                                                    <?php

                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Simpan Data </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Panel 2 -->