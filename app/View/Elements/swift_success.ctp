<script type="text/javascript" language="javascript" class="init">
    $(function () {
        toastr.success('<?php echo h($message); ?>', 'successfully', 
            { 
                positionClass: 'toast-top-right',
                timeOut: 5000,
                progressBar:!0,
            }
        )
        
    });
</script>