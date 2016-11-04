
<div id="promtionModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add a new promotion</h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" method="post">
        <select>
        <?php
          $promotionTypeList = $promotion->getPromotionTypes();

          foreach($promotionTypeList as $row){
            echo '<option value="'.$row['promo_id'].'">'.$row['promo_title'].'</option>';
          }

         ?>
       </select>
        <input type="submit" class="btn btn-info btn-lg" value="Create Promotion"></input>
      </form>
        <hr>
    </div>

  </div>

</div>
</div>
