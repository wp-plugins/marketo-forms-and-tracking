<?php if($wrap): ?>
    <div class="marketo-fat-form">
        <div class="inner">
<?php endif; ?>
            <form id="mktoForm_<?php echo $form_id; ?>"></form>
            <script>
                marketoFat.form.startRequest(<?php echo $form_id ; ?>);
                MktoForms2.loadForm(
                    "<?php echo $marketo_base_url; ?>", 
                    "<?php echo $marketo_id; ?>", 
                    <?php echo $form_id ; ?>, 
                    marketoFat.form.finishRequest
                );
            </script>
<?php if($wrap): ?>
        </div>
    </div>
<?php endif; ?>