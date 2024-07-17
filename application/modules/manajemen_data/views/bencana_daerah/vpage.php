<section class="mb-5 pb-4 mt-4">
    <?php echo $this->session->flashdata('message'); ?>
    <div id="errSuccess"></div>
    <div class="row" id="formParent">
        <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
            <div class="card card-cascade narrower z-depth-1">
                <div class="view view-cascade gradient-card-header magenta-gradient narrower py-1 mx-4 d-flex justify-content-between align-items-center">
                    <h6 class="white-text font-weight-normal mt-2">
                        <i class="fas fa-table"></i>
                        List Data User
                    </h6>
                    <div class="clearfix">
                        <a type="button" href="<?php echo site_url(isset($siteUri) ? $siteUri : '#'); ?>" class="btn btn-white btn-rounded waves-effect waves-light px-2 py-2 font-weight-bold" name="button"><i class="fas fa-sync-alt"></i> Refresh Data</a>
                        <button type="button" class="btn btn-blue btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold" id="btnAdd"><i class="fas fa-plus-circle"></i> Tambah Baru</button>

                        <a href="javascript:void(0);" class="btnFilter btn btn-white btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold">
                            <i class="fas fa-sliders-h"></i> Filter Data
                        </a>
                        <button type="button" class="btn btn-white btn-rounded waves-effect waves-light px-3 py-2 font-weight-bold" name="printExcelAll" id="printExcelAll"><i class="far fa-file-excel"></i> cetak excel </button>
                    </div>
                </div>
                <div class="card-body mb-0">
                    <div class="row mb-3 mt-1">

                        <div class="col-12 col-mb-12 mb-2">
                            <?php echo form_open(site_url('#'), array('id' => 'formFilter', 'style' => 'display:none;')); ?>
                            <div class="card rgba-grey-slight">
                                <div class="card-body">
                                    <div class="form-row mb-3 ">
                                        <div class="col-12 col-md-3">
                                            <label for="fullname" class="control-label font-weight-bolder">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" value="<?php echo $this->input->post('fullname', TRUE); ?>">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label for="username" class="control-label font-weight-bolder">Username</label>
                                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $this->input->post('username', TRUE); ?>">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="group" class="control-label font-weight-bolder">Group User</label>
                                            <?php echo form_dropdown('group', isset($group_user) ? $group_user : array('' => 'Pilih Group User'), $this->input->post('group', TRUE), 'class="form-control select-all" style="width:100%"'); ?>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="blokir" class="control-label font-weight-bolder">Blokir</label>
                                            <?php echo form_dropdown('blokir', array('' => 'Pilih Data', 1 => 'Blokir', 0 => 'Tidak Blokir'), $this->input->post('blokir', TRUE), 'class="form-control select-all" style="width:100%"'); ?>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="status" class="control-label font-weight-bolder">Status</label>
                                            <?php echo form_dropdown('status', array('' => 'Pilih Status', 1 => 'Aktif', 0 => 'Tidak Aktif'), $this->input->post('status', TRUE), 'class="form-control select-all" style="width:100%"'); ?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-12">
                                            <div class="d-flex justify-content-lg-start align-items-center" style="margin-right: -5px;">
                                                <button type="submit" class="btn btn-rounded btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="filter" id="filter"><i class="fas fa-filter"></i> Lakukan Pencarian</button>
                                                <button type="button" class="btn btn-rounded btn-danger waves-effect waves-light px-3 py-2 font-weight-bold" name="cancel" id="cancel"><i class="fas fa-sync-alt"></i> Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="table-responsive-md">
                        <table cellspacing="0" class="table table-striped table-borderless table-hover table-sm" id="tblList" width="100%">
                            <thead>
                                <tr>
                                    <th width="3%" class="font-weight-bold">#</th>
                                    <th width="10%" class="font-weight-bold">Nama Bencana</th>
                                    <th width="10%" class="font-weight-bold">Tanggal Bencana</th>
                                    <th width="30%" class="font-weight-bold">Penyebab Bencana</th>
                                    <th width="30%" class="font-weight-bold">Kabupaten/Kota</th>
                                    <th width="10%" class="font-weight-bold">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>