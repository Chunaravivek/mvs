<script type="text/javascript" language="javascript">
    $(function () {
        toastr.error('<?php echo h($message); ?>', 'Error!', 
            { 
                positionClass: 'toast-top-right',
                timeOut: 5000,
                progressBar:!0,
            }
        )
        
    });
</script>
