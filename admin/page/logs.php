<div class="content-wrapper">
    <section class="content-header">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-globe"></i> Loglar</h3>
        </div>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <td><b>No</b></td>
                            <td><b>IP</b></td>
                            <td><b>Vaxt</b></td>
                            <td><b>Metod</b></td>
                            <td><b>Ölkə</b></td>
                            <td><b>Kod</b></td>
                            <td><b>Gəlinən Url</b></td>
                            <td><b>Host</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sayfada = 15; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                        $sorgu = mysql_query('SELECT COUNT(*) AS toplam FROM LOGLAR');
                        $sonuc = mysql_fetch_assoc($sorgu);
                        $toplam_icerik = $sonuc['toplam'];
                        $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                        $sayfa = isset($_GET['data']) ? (int)$_GET['data'] : 1;
                        if ($sayfa < 1) $sayfa = 1;
                        if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                        $limit = ($sayfa - 1) * $sayfada;
                        $sorgu = mysql_query('SELECT * FROM LOGLAR LIMIT ' . $limit . ', ' . $sayfada);
                        while ($yaz = mysql_fetch_assoc($sorgu)) {
                            $tarih = date_create($yaz['Tarih']);
                            echo '<tr>
									<td>' . $yaz['LogID'] . '</td>';
                            if ($yaz['LogIP'] == '130.193.51.50') {
                                echo '<td>Yandex <br /> ' . $yaz['LogIP'] . '</td>';
                            } elseif ($yaz['LogIP'] == '130.193.50.28') {
                                echo '<td>Yandex<br /> ' . $yaz['LogIP'] . '</td>';
                            } elseif ($yaz['LogIP'] == '66.249.76.126') {
                                echo '<td>GoogleBot<br /> ' . $yaz['LogIP'] . '</td>';
                            } elseif ($yaz['LogIP'] == '66.249.73.16') {
                                echo '<td>GoogleBot<br /> ' . $yaz['LogIP'] . '</td>';
                            } elseif ($yaz['LogIP'] == '66.249.76.121') {
                                echo '<td>GoogleBot<br /> ' . $yaz['LogIP'] . '</td>';
                            } else {
                                echo '<td>' . $yaz['LogIP'] . '</td>';
                            }
                            echo '<td>' . date_format($tarih, "d-m-Y H:i:s") . '</td>
									<td>' . $yaz['LogMetod'] . ' ' . substr($yaz['LogGiris'], 0, 35) . '</td>
									<td>' . $yaz['LogUlke'] . '</td>
									<td>' . $yaz['LogProtocol'] . '</td>
									<td><a href="' . $yaz['LogUrl'] . '" target="_blank">' . substr($yaz['LogUrl'], 0, 35) . '</a></td>
									<td>' . $yaz['LogHost'] . '</td>
									</tr>';
                        }
                        echo '</tbody>
								</table></div>';
                        $sayfa_goster = 15; // gösterilecek sayfa sayısı
                        $en_az_orta = ceil($sayfa_goster / 2);
                        $en_fazla_orta = ($toplam_sayfa + 1) - $en_az_orta;
                        $sayfa_orta = $sayfa;
                        if ($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
                        if ($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;
                        $sol_sayfalar = round($sayfa_orta - (($sayfa_goster - 1) / 2));
                        $sag_sayfalar = round((($sayfa_goster - 1) / 2) + $sayfa_orta);
                        if ($sol_sayfalar < 1) $sol_sayfalar = 1;
                        if ($sag_sayfalar > $toplam_sayfa) $sag_sayfalar = $toplam_sayfa;
                        echo '<nav aria-label="Page navigation"> 
                                    <ul class="pagination">';
                        if ($sayfa != 1) echo '
                                        <li class="page-item">
                                            <a class="page-link" href="user/log/site/1" aria-label="Previous">
                                                <span aria-hidden="true">&laquo; İlk Səhifə</span>
                                            </a>
                                        </li>';
                        if ($sayfa != 1) echo '
                                <li class="page-item">
                                    <a class="page-link" href="user/log/site/' . ($sayfa - 1) . '" aria-label="Previous">
                                        <span aria-hidden="true">&laquo; Əvvələ</span>
                                    </a>
                                </li>';
                        for ($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
                            if ($sayfa == $s) {
                                echo '<li class="page-item"><a class="page-link">[' . $s . ']</a> </li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link" href="user/log/site/' . $s . '"> ' . $s . ' </a> </li>';
                            }
                        }
                        if ($sayfa != $toplam_sayfa) echo ' <li class="page-item"><a class="page-link" href="user/log/site/' . ($sayfa + 1) . '" aria-label="Next"> <span aria-hidden="true">Sonraki &raquo;</span></a></li> ';
                        if ($sayfa != $toplam_sayfa) echo '<li class="page-item"> <a class="page-link" href="user/log/site/' . $toplam_sayfa . '" aria-label="Next"> <span aria-hidden="true"> Son Səhifə &raquo;</span></a></li>';
                        echo '</ul> </nav>';
                        ?>

                </div>
            </div>
    </section>
</div>