
<div id="displaysModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Display Name Goes Here</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <select>
                        <?php
                        $promotionTypeList = $promotion->getPromotionTypes();

                        foreach($promotionTypeList as $row){
                            //echo "<input type='checkbox' name='promotion' value='" . $row['promo_id'] . "'>" . $row['promo_title'] . "<br>";
                            //echo '<option value="'.$row['promo_id'].'">'.$row['promo_title'].'</option>';
                        }

                        ?>
                    </select>
                    <input type="submit" class="btn btn-info btn-lg" value="Close" name="Close"></input>
                    <input type="submit" class="btn btn-warning btn-lg pull-left" value="Save" name="Save"></input>

                </form>
                <hr>
                <form class="form-horizontal" method="post">
                    <select>
                        <?php
                        $promotionTypeList = $promotion->getPromotionTypes();

                        foreach($promotionTypeList as $row){
                            //echo "<input type='checkbox' name='promotion' value='" . $row['promo_id'] . "'>" . $row['promo_title'] . "<br>";
                            //echo '<option value="'.$row['promo_id'].'">'.$row['promo_title'].'</option>';
                        }

                        ?>
                    </select>
                    <input type="submit" class="btn btn-info btn-lg" value="Close" name="Close"></input>
                    <input type="submit" class="btn btn-warning btn-lg pull-left" value="Save" name="Save"></input>

                </form>
            </div>

        </div>

    </div>
</div>
