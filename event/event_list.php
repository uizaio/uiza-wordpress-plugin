<div _ngcontent-c12="" class="card-body">
<h5 _ngcontent-c11="" class="card-title">Tracking Event</h5>
<hr>
    <!---->
    <app-uiza-card-content _ngcontent-c11="">
        <div _ngcontent-c11="" class="col-md-12"></div>
        <div _ngcontent-c11="" class="col-md-12">
            <ul _ngcontent-c11="" class="list-event">
                <!---->
                <?php foreach ($listLiveEvent as $live) {?>
                <li _ngcontent-c11="">
                    <div _ngcontent-c11="" style="position: relative">
                        <!---->
                        <!---->
                        <!---->
                        <div _ngcontent-c11="" class="img-tracking" style="background-image: url('<?=plugin_dir_url(__FILE__)?>../images/imageHolder.jpg');"></div>
                        <!---->
                    </div>
                    <p _ngcontent-c11="" class="mr-top-10 title-two-line"><?=$live['name']?></p><a href="?page=uiza-event&id=<?=$live['id']?>" _ngcontent-c11="" class="btn btn-outline-secondary btn-sm" live-id="<?=$live['id']?>">View Detail</a>
                    <!---->
                    <!---->
                    <!----><a _ngcontent-c11="" class="btn btn-info btn-sm"><i _ngcontent-c11="" class="icon icon-livestream" live-id="<?=$live['id']?>"></i>Start Live</a></li>
                <?php }?>
            </ul>
        </div>
    </app-uiza-card-content>
    <!---->
</div>
