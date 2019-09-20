<?php
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
?>