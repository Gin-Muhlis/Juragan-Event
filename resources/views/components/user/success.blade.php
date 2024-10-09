<style>
    .success-popup {
        padding: 25px;
        background: #198754;
        border-top-right-radius: 30px;
        border-bottom-left-radius: 30px;
        color: #fff;
        font-size: 1em;
        position: fixed;
        right: 20px;
        bottom: 20px;
    }
</style>

<div class="success-popup">
    {{ $message }}
</div>

<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('.success-popup').fadeOut();
        }, 3000);
    })
</script>
