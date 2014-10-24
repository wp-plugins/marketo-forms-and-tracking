<div class="marketo-fat-popout">
    <div class="mfatp-outer">
    	<a class="mfatp-tab" href="#" onclick="marketoFat.popout.toggle(this);"><span><?php echo $tabtext; ?></span></a>
    	<div class="mfatp-body">
    		<div class="mfatp-inner">
    		    <?php if(isset($title)): ?><h3 class="mfatp-title"><?php echo $title; ?></h3><?php endif; ?>
                <?php if(isset($snippet)): ?><p class="mfatp-snippet"><?php echo $snippet; ?></p><?php endif; ?>
    			<?php echo $form; ?>
    		</div>
        </div>
    </div>
</div>
