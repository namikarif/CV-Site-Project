<div class="box">
    <div class="box-body">
        <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                <tr>
                    <td><b>No</b></td>
                    <td><b>IP</b></td>
                    <td><b>Blocked Date</b></td>
                    <td style="width: 110px;"><b>Process</b></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $inPage = 15;
                $contentCountQuery = mysqliQuery('SELECT COUNT(*) AS total FROM BLOCKED_IP');
                $contentCountResult = $contentCountQuery->fetch_array(MYSQLI_ASSOC);
                $totalContentCount = $contentCountResult['total'];
                $totalPage = ceil($totalContentCount / $inPage);
                $page = isset($_GET['data']) ? (int)$_GET['data'] : 1;
                if ($page < 1) $page = 1;
                if ($page > $totalPage) $page = $totalPage;
                $limit = ($page - 1) * $inPage;
                $logsQueryString = 'SELECT * FROM BLOCKED_IP ORDER BY ID DESC LIMIT ' . $limit . ', ' . $inPage;
                $logsQuery = mysqliQuery($logsQueryString);
                $rowNum = ($page - 1) * $inPage;
                if ($logsQuery) {
                    while ($rows = $logsQuery->fetch_array(MYSQLI_ASSOC)) {
                        $rowNum = $rowNum + 1;
                        $refID = $rows['ID'];
                        $date = date_create($rows['Date']);
                        echo '<tr id="blockedIP' . $refID . '">
								<td>' . $rowNum . '</td>
								<td>' . $rows['IP'] . '</td>
								<td>' . date_format($date, "d-m-Y H:i:s") . '</td>
								<td style="width: 110px;"><a onclick="unBlockIP('. $refID .');" class="btn btn-danger btn-block align-left" style="width: 100px;"><i class="fa fa-times"></i> Unblock IP</a></td>
							</tr>';
                    }
                }
                echo '</tbody></table></div>';
                $showInPage = 15;
                $leastMedium = ceil($showInPage / 2);
                $mediumAtMost = ($totalPage + 1) - $leastMedium;
                $midPage = $page;
                if ($midPage < $leastMedium) $midPage = $leastMedium;
                if ($midPage > $mediumAtMost) $midPage = $mediumAtMost;
                $leftPages = round($midPage - (($showInPage - 1) / 2));
                $rightPages = round((($showInPage - 1) / 2) + $midPage);
                if ($leftPages < 1) $leftPages = 1;
                if ($rightPages > $totalPage) $rightPages = $totalPage;
                echo '<nav aria-label="Page navigation"> 
                                    <ul class="pagination">';
                if ($page != 1) echo '
                                        <li class="page-item">
                                            <a class="page-link" href="admin/referer/1" aria-label="Previous">
                                                <span aria-hidden="true">&laquo; First Page</span>
                                            </a>
                                        </li>';
                if ($page != 1) echo '
                                <li class="page-item">
                                    <a class="page-link" href="admin/referer/' . ($page - 1) . '" aria-label="Previous">
                                        <span aria-hidden="true">&laquo; Back</span>
                                    </a>
                                </li>';
                for ($s = $leftPages; $s <= $rightPages; $s++) {
                    if ($page == $s) {
                        echo '<li class="page-item"><a class="page-link">[' . $s . ']</a> </li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="admin/referer/' . $s . '"> ' . $s . ' </a> </li>';
                    }
                }
                if ($page != $totalPage) echo ' <li class="page-item"><a class="page-link" href="admin/referer/' . ($page + 1) . '" aria-label="Next"> <span aria-hidden="true">Next &raquo;</span></a></li> ';
                if ($page != $totalPage) echo '<li class="page-item"> <a class="page-link" href="admin/referer/' . $totalPage . '" aria-label="Next"> <span aria-hidden="true"> Last Page &raquo;</span></a></li>';
                echo '</ul> </nav>';
                ?>
        </div>
    </div>