<?php
/*membership expiration message modification */
function modify_pmpro_expiration_text() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".pmpro_level-expiration:contains('Membership never expires.')").each(function() {
                $(this).text("Membership auto-renews yearly.");
            });
        });
    </script>
    <?php
}
