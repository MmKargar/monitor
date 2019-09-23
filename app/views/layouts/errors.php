<?php
if (isset($data['text'])) {
    if ($data['text']) {

        ?>
        <script>
            $.toast({
                heading: "<?= $data['heading'] ?>",
                text: "<?= $data['text'] ?>",
                position: 'top-left',
                loaderBg: "<?= $data['loaderBg'] ?>",
                icon: "<?= $data['icon'] ?>",
                hideAfter: 7000
            });
        </script>
    <?php
        }
    }

    if (isset($data['error-upload'])) {
        foreach ($data['errors'] as $error) {
            ?>
        <script>
            $.toast({
                heading: "File Upload Error",
                text: "<?= $error ?>",
                position: 'top-left',
                loaderBg: "#ff6849",
                icon: "error",
                hideAfter: 21000
            });
        </script>
<?php
    }
}



?>