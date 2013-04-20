<div class="navigation">
    <div class="navigation-container">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <?php
                $NewsCategoryArray = appController::getAllCategory();
                if(is_array($NewsCategoryArray) && count($NewsCategoryArray) > 0)
                {
                    foreach($NewsCategoryArray as $newsCatKey=>$newsCatArray)
                    {
                    ?>
                        <td><a href="<?=__SITE_URL?>pages/<?=strtolower($newsCatArray['news_category_name'])?>" id="<?=strtolower($newsCatArray['news_category_name'])?>"><?=$newsCatArray['news_category_name']?></a></td>
                    <?php
                    }
                }
                ?>
            </tr>
        </table>
    </div>
</div>
