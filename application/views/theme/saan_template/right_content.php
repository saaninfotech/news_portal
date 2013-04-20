<div id="tabbed_box_right1" class="tabbed_box">
    <div class="tabbed_area">
        <ul class="tabs">
            <li><a href="javascript:void(0);" title="content_right1" class="tabs active_right">News Archives</a></li>
            <!-- <li><a href="javascript:void(0);" title="content_right2" class="tabs">Local News for You</a></li> -->
        </ul>
        <div id="content_right1" class="content_right">
            <ul>
                <?php
                $CatCountArray = appController::getAllNewsCountByCat();
                if(is_array($CatCountArray) && count($CatCountArray) > 0)
                {
                    foreach($CatCountArray as $countKey=>$countValue)
                    {
                        if($countValue['news_category_name'] != "Home")
                        {
                        ?>
                            <li><a href="<?=__SITE_URL?>pages/view_news/news_cat:<?=strtolower($countValue['news_category_name'])?>"><div><?=$countValue['news_category_name']?>(<?=$countValue['news_count']?>)</div>
                            </a></li>
                        <?php
                        }
                    ?>

                    <?php
                    }
                }
                ?>

            </ul>
        </div>
        <!-- <div id="content_right2" class="content_right">
            <ul>
                <li><a href="">December 2008
                    <small>More >></small>
                </a></li>
                <li><a href="">November 2008
                    <small>More >></small>
                </a></li>
                <li><a href="">October 2008
                    <small>More >></small>
                </a></li>
                <li><a href="">September 2008
                    <small>More >></small>
                </a></li>
                <li><a href="">August 2008
                    <small>More >></small>
                </a></li>
                <li><a href="">July 2008
                    <small>More >></small>
                </a></li>
            </ul>
        </div> -->
    </div>
</div>