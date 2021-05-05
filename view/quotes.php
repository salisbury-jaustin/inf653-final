<?php include './view/header.php'; ?>
<?php include './view/filter.php'; ?>

    <div id="card_container">
        <?php foreach ($quote_response->data as $quote) : ?>
            <div class="card">
                <div class="quote">
                    <h2><?php echo $quote->quote?></h2>
                </div>
                <div class="details">
                    <h3><span class="accent">-</span><?php echo $quote->author?></h3>
                    <h4 class="accent"><?php echo $quote->category?></h4>
                </div>
            </div>
        <?php endforeach ?>
    </div>

</main>
</body>
</html>