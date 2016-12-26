<div class="<?php echo "section-{$section_name}"; ?>">
    <div class="container">
        <a href="javascript:void(0)" name="section_<?php echo $section_name; ?>"></a>
        <?php if(!empty($page['sidebar'])): ?>
        <div class="page-content-sidebar col-lg-8 col-md-4 col-sm-7">
            <?php echo render($page['content']); ?>
        </div>
        <div class="page-sidebar col-lg-4 col-md-4 col-sm-5">
            <?php echo render($page['sidebar']); ?>
        </div>
        <?php else: ?>
        <div class="page-content">
            <?php echo render($page['content']); ?>
        </div>
        <?php endif ?>
    </div>
</div>