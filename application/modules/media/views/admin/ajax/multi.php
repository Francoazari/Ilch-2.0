<style>
.container-fluid {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.container-fluid > [class*="col-"] {
    padding:0;
}
*, *:before, *:after {
    box-sizing: border-box;
}
</style>

<?php if ($this->get('medias') != ''): ?>
    <?php if ( $this->getRequest()->getParam('type') === 'image' || $this->getRequest()->getParam('type') === 'multi'): ?>
        <?php foreach ($this->get('medias') as $media): ?>
            <?php if (in_array($media->getEnding(), explode(' ',$this->get('media_ext_img')))): ?>
                <div id="<?=$media->getId() ?>" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 co thumb media_loader">
                    <img class="image thumbnail img-responsive"
                         data-url="<?=$media->getUrl() ?>"
                         src="<?=$this->getBaseUrl($media->getUrlThumb()) ?>"
                         alt="<?=$media->getName() ?>">
                    <input type="checkbox"
                           class="regular-checkbox big-checkbox"
                           id="<?=$media->getId() ?> test"
                           name="check_image[]"
                           value="<?=$media->getId() ?>" />
                    <label for="<?=$media->getId() ?> test"></label>
                </div>
                <input type="text"
                       class="hidden"
                       name="check_url[]"
                       value="<?=$media->getUrl() ?>" />
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($this->getRequest()->getParam('type') === 'media'): ?>
        <?php foreach ($this->get('medias') as $media): ?>
            <?php if (in_array($media->getEnding(), explode(' ',$this->get('media_ext_video')))): ?>
                <div class="col-lg-2 col-sm-3 col-xs-4">
                    <img class="image thumbnail img-responsive"
                         data-url="<?=$media->getUrl() ?>"
                         src="<?=$this->getBaseUrl('application/modules/media/static/img/nomedia.png') ?>"
                         alt="<?=$media->getName() ?>">
                    <div class="media-getending">Type: <?=$media->getEnding() ?></div>
                    <div class="media-getname"><?=$media->getName() ?></div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($this->getRequest()->getParam('type') === 'file'): ?>
        <?php foreach ($this->get('medias') as $media): ?>
            <?php if (in_array($media->getEnding(), explode(' ',$this->get('media_ext_file')))): ?>
               <div id="<?=$media->getId() ?>" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 co thumb media_loader">
                    <img class="image thumbnail img-responsive"
                         data-url="<?=$media->getUrl() ?>"
                         src="<?=$this->getBaseUrl('application/modules/media/static/img/nomedia.png') ?>"
                         alt="<?=$media->getName() ?>">
                    <div class="text-right">
                        <small class="text-info"><?=substr($media->getName(), 0, 20) ?></small>
                    </div>
                    <input type="checkbox"
                           class="regular-checkbox big-checkbox"
                           id="<?=$media->getId() ?> test"
                           name="check_image[]"
                           value="<?=$media->getId() ?>" />
                    <label for="<?=$media->getId() ?> test"></label>
                </div>
                <input type="text"
                       class="hidden"
                       name="check_url[]"
                       value="<?=$media->getUrl() ?>" />
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php else: ?>
    <?=$this->getTrans('noMedias') ?>
<?php endif; ?>

<?php if ($this->getRequest()->getParam('type') === 'multi'): ?>
    <script>
    $(".btn").click(function() {
        window.top.$('#mediaModal').modal('hide');
        window.top.reload();
    });

    $(document).on("click", "img.image", function() {
        $(this).closest('div').find('input[type="checkbox"]').click();
        elem = $(this).closest('div').find('img');
        if (elem.hasClass('chacked')) {
            $(this).closest('div').find('img').removeClass("chacked");
        } else {
            $(this).closest('div').find('img').addClass("chacked");
        };
    });
    </script>
<?php endif; ?>
<?php if ($this->getRequest()->getParam('type') === 'file'): ?>
    <script>
    $(".btn").click(function() {
        window.top.$('#mediaModal').modal('hide');
        window.top.reload();
    });

    $(document).on("click", "img.image", function() {
        $(this).closest('div').find('input[type="checkbox"]').click();
        elem = $(this).closest('div').find('img');
        if (elem.hasClass('chacked')) {
            $(this).closest('div').find('img').removeClass("chacked");
        } else {
            $(this).closest('div').find('img').addClass("chacked");
        };
    });
    </script>
<?php endif; ?>
