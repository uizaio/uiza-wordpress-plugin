<?php
$records = listRecords();
?>
<div _ngcontent-c12="" class="card-body">
<h5 _ngcontent-c11="" class="card-title">Record Stream</h5>
<hr>
    <!---->
    <app-uiza-card-content _ngcontent-c11="">
        <div _ngcontent-c11="" class="col-md-12"></div>
        <div _ngcontent-c11="" class="col-md-12">
            <ul _ngcontent-c11="" class="list-event">
                <!---->
                <?php foreach ($records->body->data as $r) {?>
                <li>Test</li>
                <?php }?>
            </ul>
        </div>
    </app-uiza-card-content>
    <!---->
</div>