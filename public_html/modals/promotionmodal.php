
    <form id="add-promotion-form" action="controllers/addpromotioncontroller.php" method="post">
        <input type="hidden" name="casinoId" value=""></input>
        <select name="promoId">
            <?php
            $promotionTypeList = $promotion->getPromotionTypes();

            foreach ($promotionTypeList as $row) {
                echo '<option value="' . $row['promo_id'] . '">' . $row['promo_title'] . '</option>';
            }
            ?>
        </select>
    </form>