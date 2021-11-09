<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-envelope"></i> Messages</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-responsive table-hover table-striped">
            <thead>
                <tr>
                    <td><b>Name</b></td>
                    <td><b>E-Mail</b></td>
                    <td><b>Phone</b></td>
                    <td><b>Message</b></td>
                    <td><b>IP</b></td>
                    <td><b>Date</b></td>
                    <td><b>Process</b></td>
                </tr>
            </thead>
            <tbody id="messageTable">
                <?php
                    $selectMessage = mysqliQuery("SELECT * from INBOX order by MessageID DESC");
                    if($selectMessage->num_rows == 0)
                        echo '<tr><td>Not received message</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                    else {
                        while($messageList = $selectMessage->fetch_array(MYSQLI_ASSOC))
                        {
                            echo '<tr id="message'.$messageList['MessageID'].'">
                                    <td>'.(($messageList['Status'] == 1) ? '<span class="badge bg-red"><i class="fa fa-star"></i> New</span> ' : '').$messageList['Name'].'</td>
                                    <td>'.$messageList['EMail'].'</td>
                                    <td>'.$messageList['Phone'].'</td>
                                    <td>'.$messageList['Message'].'</td>
                                    <td>'.$messageList['IP'].'</td>
                                    <td>'.ActiveDate($messageList['Date']).'</td>
                                    <td><a onclick="deleteMessage(\''.$messageList['MessageID'].'\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td>
                                  </tr>';
                        }
                        mysqliQuery("UPDATE INBOX set Status = 0");
                    }
                ?>
            </tbody>
        </table>
        </div>
    </div>