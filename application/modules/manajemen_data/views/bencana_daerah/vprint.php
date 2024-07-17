<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak PDF</title>
    <style>
        body {
            margin-left: 1cm;
            margin-right: 1cm;
            margin-top: 1cm;
            margin-bottom: 3cm;
        }

        .head-wrapper table tr td {
            margin: 0;
            padding: 0;
        }

        .content-main table tr td {
            margin: 0;
            padding: 0;
        }

        .image {
            width: 95px;
            height: auto;
        }



        h1 {
            font-size: 22px;
            height: 10px;
            font-family: "Bookman Old Style", Georgia, serif;
        }

        h2 {
            font-size: 18px;
            height: 0.5px;
            font-family: "Bookman Old Style", Georgia, serif;
        }

        h3 {
            font-size: 14px;
            height: 0.5px;
            font-family: "Bookman Old Style", Georgia, serif;
        }

        h4 {
            font-size: 14px;
            height: 8px;
            font-family: "Bookman Old Style", Georgia, serif;
        }



        p {
            font-size: 14px;
            /* height: 0.5px; */
            /* font-family: "Bookman Old Style", Georgia, serif; */
        }

        p1 {
            font-size: 14px;
            height: 10px;
            /* font-family: "Bookman Old Style", Georgia, serif; */
        }

        text {
            font-size: 14px;
            height: 2px;
            /* font-family: "Bookman Old Style", Georgia, serif; */
        }

        .text-left {
            text-align: left !important;
        }

        .text-justify {
            text-align: justify !important;
            width: 50%;
        }

        .mt-3 {
            margin-bottom: 1rem;
        }


        hr {
            margin-top: 2rem;
            height: 0.1px;
            /* background-color: black; */
        }

        .content-wrapper table tr td {
            font-size: 10pt !important;
            padding: 5px;
        }

        .upper {
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <!-- <div style="text-align:left"><img style="width: 30%; height: 50px;" class="image" src="<?= $base64 ?>">
    </div> -->
    <!-- <br> -->
    <main>
        <div class="content-main">
            <!-- <img src="<?php echo base_url('assets/img/balitbang.png'); ?>" alt=""> -->

            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td align="left" valign="top">
                            <h1>
                                <strong>
                                    LAPORAN INOVASI DAERAH
                                </strong>
                            </h1>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <td width="12%" align="left" valign="top">
                            <h2>
                                <strong>
                                    Pemerintah Daerah
                                </strong>
                            </h2>
                        </td>
                        <td width="2%" align="center" valign="top">
                            <h2>
                                <strong>
                                    :
                                </strong>
                            </h2>
                        </td>
                        <td width="38%" align="left" valign="top">
                            <h2>
                                <strong>
                                    Provinsi Sumatera Barat
                                </strong>
                            </h2>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td width="13%" align="left" valign="top">
                            <h2>
                                <strong>
                                    Nomor Registrasi
                                </strong>
                            </h2>
                        </td>
                        <td width="2%" align="center" valign="top">
                            <h2>
                                <strong>
                                    :
                                </strong>
                            </h2>
                        </td>
                        <td width="38%" align="left" valign="top">
                            <h2>
                                <strong>
                                    13-xxxxx-xxxxx-2024
                                </strong>
                            </h2>
                        </td>
                    </tr> -->
                </thead>
            </table>
            <br>
            <h1>1. PROFIL INOVASI</h1>
            <h1>1.1 Nama Inovasi</h1>
            <text><?= $data['nama_inovasi']; ?></text>
            <h3>1.2 Dibuat Oleh</h3>
            <text><?= $data['opd_id_name']; ?> Provinsi Sumatera Barat</text>
            <h3>1.3 Tahapan Inovasi</h3>
            <text><?php $id_tahapan = $data['id_tahapan_inovasi'];
                    if ($id_tahapan == 1) {
                        echo $tahapan = "Inisiatif";
                    } elseif ($id_tahapan == 2) {
                        echo $tahapan = "Uji Coba";
                    } else {
                        echo $tahapan = "Penerapan";
                    } ?>
            </text>
            <h3>1.4 Inisiator Inovasi Daerah</h3>
            <text><?php $id_inisiator = $data['id_inisiator_inovasi'];
                    if ($id_inisiator == 1) {
                        echo $inisiator = "Kepala OPD";
                    } elseif ($id_inisiator == 2) {
                        echo $inisiator = "Anggota DPRD";
                    } elseif ($id_inisiator == 3) {
                        echo $inisiator = "OPD";
                    } elseif ($id_inisiator == 4) {
                        echo $inisiator = "ASN";
                    } else {
                        echo $inisiator = "Masyarakat";
                    } ?>
            </text>
            <h3>1.5 Jenis Inovasi</h3>
            <text><?php $id_jenis = $data['id_jenis_inovasi'];
                    if ($id_jenis == 1) {
                        echo $jenis = "Digital";
                    } else {
                        echo $jenis = "Non Digital";
                    } ?>
            </text>
            <h3>1.6 Bentuk Inovasi Daerah</h3>
            <text><?= $data['nm_bentuk']; ?></text>
            <h3>1.7 Urusan Inovasi Daerah</h3>
            <text><?= $data['nm_urusan_utama']; ?></text>
            <h3>1.8 Rancang Bangun dan Pokok Perubahan Yang Dilakukan</h3>
            <p><?= $data['rancang_bangun']; ?></p>
            <!-- <br> -->
            <h4>1.9 Tujuan Inovasi Daerah</h4>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td align="justify">
                            <p1>1.
                                Melakukan penyebarluasan dan publikasi artikel hasil-hasil penelitian yang telah dilakukan oleh peneliti, dosen, mahasiswa dan masyarakat di seluruh Indonesia secara online.
                            </p1>
                        </td>
                    </tr>
                    <tr>
                        <td align="justify">
                            <p1>2. Meningkatkan keinginan para peneliti/dosen, mahasiswa dan masyarakat untuk menulis karya tulis ilmiah
                                dalam berbagai inovasi baru sebagai upaya memperluas jaringan pengetahuan.

                            </p1>
                        </td>
                    </tr>
                    <tr>
                        <td align="justify">
                            <p1>3. Meningkatkan ilmu pengetahuan dan inovasi bagi pemerintah maupun masyaraka
                            </p1>
                        </td>
                    </tr>
                    <tr>
                        <td align="justify">
                            <p1>4. Memudahkan akses dan publikasi secara luas dan meningkatkan daya saing, kualitas,kreatiftas, ilmu dan
                                pengetahuan para peneliti/penulis.
                            </p1>
                        </td>
                    </tr>

                </tbody>
            </table>
            <h4>1.10 Manfaat Yang Diperoleh</h4>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td align="justify">
                            <p1>1. Dapat memberikan informasi, permasalahan yang sedang berkembang di masyarakat, dan memberikan upaya
                                pemecahan masalah serta rekomendasi penelitian
                            </p1>
                        </td>
                    </tr>
                    <tr>
                        <td align="justify">
                            <p1>2. Memberikan pengetahuan baru, sehingga memotivasi masyarakat untuk meningkatkan minat baca pengguna
                                dalam memanfaatkan jurnal eletronik

                            </p1>
                        </td>
                    </tr>
                    <tr>
                        <td align="justify">
                            <p1>3. Menambah ide atau gagasan terbaru dalam setiap penelitian yang dilakukan oleh peneliti/dosen, mahasiswa dan
                                masyarakat.
                            </p1>
                        </td>
                    </tr>
                    <tr>
                        <td align="justify">
                            <p1>4. Membantu peneliti/dosen dalam pencapaian target sasaran kerja pegawai kredit yang harus dicapai dalam
                                rangka membantu pembinaan karier peneliti.

                            </p1>
                        </td>
                    </tr>
                    <tr>
                        <td align="justify">
                            <p1>Rekomendasi hasil penelitian dapat menjadi bahan masukan bagi pengambil kebijakan.

                            </p1>
                        </td>
                    </tr>

                </tbody>
            </table>
            <h4>1.11 Hasil Inovasi</h4>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td align="justify">
                            <p1>Publikasi berupa artikel hasil penelitiandan review hasil-hasil penelitian yang dapat dimanfaatkan para peneliti/
                                dosen, mahasiswa dan masyarakat umum serta pengambil kebijakan.
                            </p1>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h3>1.12 Waktu Uji Coba Inovasi Daerah</h3>
            <text><?= $data['waktu_uji_coba']; ?></text>
            <h3>1.13 Waktu Implementasi</h3>
            <text><?= $data['waktu_penerapan']; ?></text>
            <h3>1.14 Anggaran</h3>
            <text>-</text>
            <h3>1.15 Profil Bisnis</h3>
            <text>-</text>
            <h3>1.16 Skor Kematangan</h3>
            <text><?php
                    echo $dataBobot = $this->mindi->getTotalBobotByIdInovasi($data['token']);
                    ?></text>
            <br>
            <hr>
            <h3>2. INDIKATOR INOVASI</h3>
            <br>

            <!--Table-->
            <table width="100%" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="border:1px solid #000;text-align: center;padding: 4px;">No.</th>
                        <th style="border:1px solid #000;text-align: center;padding: 4px;">Indikator SPD</th>
                        <th style="border:1px solid #000;text-align: center;padding: 4px;">Informasi</th>
                        <th style="border:1px solid #000;text-align: center;padding: 4px;">Bukti Dukung</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no_urut = 0;
                    $indikator = $this->mindi->getDataIndikator();
                    foreach ($indikator as $key => $list) :
                        $id_indikator = !empty($list) ? $list->id_indikator : 0;
                        $this->db->select('a.id_indikator_nilai, a.id_indikator_satuan, b.bobot_satuan, b.nm_indikator_satuan');
                        $this->db->from('ms_indikator_nilai a');
                        $this->db->join('cx_indikator_satuan b', 'a.id_indikator_satuan = b.id_indikator_satuan', 'inner');
                        $this->db->where('a.id_indikator', $id_indikator);
                        $this->db->where('a.token', $data['token']);
                        $this->db->limit(1);
                        $dataNilai = $this->db->get();
                        $nm_indikator_satuan = !empty($dataNilai->row_array()) ? $dataNilai->row_array()['nm_indikator_satuan'] : '-';
                        $no_urut++;
                    ?>
                        <tr>
                            <td style="border:1px solid #000; text-align: center;padding: 4px;">
                                <font size="14px"><?php echo $no_urut; ?></font>
                            </td>
                            <td style="border:1px solid #000;text-align: left;padding: 4px;">
                                <font size="14px"><?php echo $list->nm_indikator; ?></font>
                            </td>
                            <td style="border:1px solid #000;text-align: left;padding: 4px;">
                                <font size="14px"><?php echo $nm_indikator_satuan; ?></font>
                            </td>
                            <td style="border:1px solid #000;text-align: left;padding: 4px;">
                                <font size="14px"><?php echo $list->data_pendukung; ?></font>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                </tbody>
            </table>
            <!--Table-->
        </div>
    </main>

</body>

</html>