<div class="navigation">
    <div class="navigation-container">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><a href="<?=__SITE_URL?>" id="home">Home</a></td>
                <?php
                $NewsCategoryArray = appController::getAllCategory();
                if(is_array($NewsCategoryArray) && count($NewsCategoryArray) > 0)
                {
                    foreach($NewsCategoryArray as $newsCatKey=>$newsCatArray)
                    {
                        if($newsCatArray['news_category_name'] != "Home")
                        {
                        ?>
                            <td><a href="<?=__SITE_URL?>pages/view_news/news_cat:<?=strtolower($newsCatArray['news_category_name'])?>" id="<?=strtolower($newsCatArray['news_category_name'])?>"><?=$newsCatArray['news_category_name']?></a></td>
                        <?php
                        }
                    ?>

                    <?php
                    }
                }
                ?>
            </tr>
        </table>
    </div>
</div>
