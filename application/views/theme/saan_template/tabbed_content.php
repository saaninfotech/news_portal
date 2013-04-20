<div id="tabbed_box_1" class="tabbed_box">
    <div class="tabbed_area">
        <ul class="tabs">
            <li><a href="javascript:void(0);" title="content_1" class="tab active">Top Stories</a></li>
            <li><a href="javascript:void(0);" title="content_2" class="tab">Africa</a></li>
            <li><a href="javascript:void(0);" title="content_3" class="tab">Entertainment</a></li>
            <li><a href="javascript:void(0);" title="content_4" class="tab">Sports</a></li>
            <li><a href="javascript:void(0);" title="content_5" class="tab">Politics</a></li>
        </ul>
        <div id="content_1" class="content">
            <ul>
                <?php
                $TopStoriesArray = appController::getTopStories();
                if(is_array($TopStoriesArray) && count($TopStoriesArray) > 0)
                {
                    foreach($TopStoriesArray as $topKey=>$topArray)
                    {
                    ?>
                        <li><a href="<?=__SITE_URL?>pages/readnews/news_id:<?=$this->registry->security->encryptData($topArray['news_id'])?>"><h3><?=ucwords($topArray['news_subject'])?></h3>
                            <?=ucfirst(substr($topArray['news_description'], 0, 250))?>
                            <small>More >></small>
                        </a></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </div>
        <?php
        $AllNewsArray = appController::getAllNews();
        if(is_array($AllNewsArray['africa']))
        {
            echo '<div id="content_2" class="content">
                    <ul>';
            foreach($AllNewsArray['africa'] as $key=>$value)
            {
                $valueArray = explode('--^--', $value);
                ?>
                <li><a href="<?=__SITE_URL?>pages/readnews/news_id:<?=$this->registry->security->encryptData($valueArray[0])?>"><h3><?=$valueArray[1]?></h3>
                    <?=$valueArray[2]?>
                    <small>More >></small>
                </a></li>
                <?php

            }
            echo '</ul>
                    </div>';
        }
        if(is_array($AllNewsArray['entertainment']))
        {
            echo '<div id="content_3" class="content">
                    <ul>';
            foreach($AllNewsArray['entertainment'] as $key=>$value)
            {
                $valueArray = explode('--^--', $value);
                ?>
                <li><a href="<?=__SITE_URL?>pages/readnews/news_id:<?=$this->registry->security->encryptData($valueArray[0])?>"><h3><?=$valueArray[1]?></h3>
                    <?=$valueArray[2]?>
                    <small>More >></small>
                </a></li>
                <?php

            }
            echo '</ul>
                    </div>';
        }
        if(is_array($AllNewsArray['sports']))
        {
            echo '<div id="content_4" class="content">
                    <ul>';
            foreach($AllNewsArray['sports'] as $key=>$value)
            {
                $valueArray = explode('--^--', $value);
                ?>
                <li><a href="<?=__SITE_URL?>pages/readnews/news_id:<?=$this->registry->security->encryptData($valueArray[0])?>"><h3><?=$valueArray[1]?></h3>
                    <?=$valueArray[2]?>
                    <small>More >></small>
                </a></li>
                <?php

            }
            echo '</ul>
                    </div>';
        }
        if(is_array($AllNewsArray['politics']))
        {
            echo '<div id="content_5" class="content">
                    <ul>';
            foreach($AllNewsArray['politics'] as $key=>$value)
            {
                $valueArray = explode('--^--', $value);
                ?>
                <li><a href="<?=__SITE_URL?>pages/readnews/news_id:<?=$this->registry->security->encryptData($valueArray[0])?>"><h3><?=$valueArray[1]?></h3>
                    <?=$valueArray[2]?>
                    <small>More >></small>
                </a></li>
                <?php

            }
            echo '</ul>
                    </div>';
        }
        ?>
    </div>
</div>
<div class="clear"></div>