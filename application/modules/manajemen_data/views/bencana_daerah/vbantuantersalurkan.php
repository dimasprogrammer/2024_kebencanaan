                                <!-- Panel 4 -->
                                <div class="tab-pane fade" id="panel4" role="tabpanel">
                                    <br>
                                    <div class="card-body mb-0">
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="font-weight-bold text-left">Jenis Bantuan</th>
                                                        <th width="30%" class="font-weight-bold text-left">Satuan</th>
                                                        <th width="30%" class="font-weight-bold text-left">Jumlah Bantuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($bantuan_diterima as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_bantuan; ?></td>
                                                            <td><?php echo $list->satuan; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="jml_bantuan" id="jml_bantuan" required> </td>
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
                                                        <th width="50%" class="font-weight-bold text-left">Sumber Bantuan</th>
                                                        <th width="20%" class="font-weight-bold text-left">Sumber Bantuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($jenis_sumber as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_bantuan; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="jml_bantuan" id="jml_bantuan" required> </td>
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
                                <!-- Panel 4 -->