<style>
    .error-popup {
        padding: 25px;
        background: #DC3545;
        border-top-right-radius: 30px;
        border-bottom-left-radius: 30px;
        color: #fff;
        font-size: 1em;
        position: fixed;
        right: 20px;
        bottom: 20px;
    }
</style>

<div class="error-popup" style="z-index: 999;">
    {{ $message }}
</div>

<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('.error-popup').fadeOut();
        }, 3000);
    })
</script>
