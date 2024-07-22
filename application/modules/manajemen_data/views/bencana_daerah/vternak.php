                                <!-- Panel 3 -->
                                <div class="tab-pane fade" id="panel3" role="tabpanel">
                                    <br>
                                    <div class="card-body mb-0">
                                        <div class="table-responsive-md">
                                            <table cellspacing="0" class="table table-striped table-bordered mb-0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="50%" class="font-weight-bold text-left">Jenis Ternak</th>
                                                        <th width="50%" class="font-weight-bold text-left">Jumlah Ternak</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_urut = 0;
                                                    foreach ($jenis_ternak as $key => $list) :
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $list->nm_jenis_ternak; ?></td>
                                                            <td><input type="number" class="form-control" value="0" name="jumlah_ternak" id="jumlah_ternak" required> </td>
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
                                <!-- Panel 3 -->