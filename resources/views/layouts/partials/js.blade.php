<script>
    $(document).ready(function() {
        $(".number").on("keyup", function(event) {
            if (event.which != 8 && event.which != 0 && event.which < 48 || event.which > 57) {
                this.value = this.value.replace(/\D/g, "");
            }
        });

        function formatCurrencyLbl(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);
        }
    });
</script>
