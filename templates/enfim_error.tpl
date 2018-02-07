<div id="errorForThreeSecond"><h3 {if $error['success']}class="success"{else}class="alert"{/if}>{$error['message']}</h3></div>
<script>
    setTimeout(function () {
        $('#errorForThreeSecond').html('')
    }, 3000);
</script>

