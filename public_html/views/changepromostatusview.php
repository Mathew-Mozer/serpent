<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 3/7/2017
 * Time: 6:23 AM
 */
?>
<style>
    .promobtn{
        width: 200px;
        padding: 10px 10px 10px 10px;
    }
    td.promostatus {
        padding: 5px 5px 5px 5px;

    }
</style>
<table width="200px">
    <tr class="promostatus">
        <td class="promostatus"><button class="btn btn-sm btn-info promobtn newPromoStatus"  data-promoid="<?php echo($_POST["promoid"]) ?>" data-promo-status="1" ><span class="glyphicon glyphicon-play glyphicon-menu black newPromoStatus" data-promoid="<?php echo($_POST["promoid"]) ?>" data-promo-status="1" aria-hidden="true"><br> Active (Timer Enabled)</span></td>
    </tr>
    <tr class="promostatus">
        <td class="promostatus"><button class="btn btn-sm btn-info promobtn newPromoStatus"  data-promoid="<?php echo($_POST["promoid"]) ?>" data-promo-status="2" ><span class="glyphicon glyphicon-pause glyphicon-menu black newPromoStatus" data-promoid="<?php echo($_POST["promoid"]) ?>" data-promo-status="2" aria-hidden="true"></span></br> Timer Disabled </button></td>

    </tr>
    <tr class="promostatus" hidden>
        <td class="promostatus"><span class="glyphicon glyphicon-time glyphicon-menu black newPromoStatus" data-promoid="<?php echo($_POST["promoid"]) ?>" data-promo-status="3 aria-hidden="true"></span></td>
        <td class="promostatus">Scheduled</td>
    </tr>
    <tr class="promostatus">
        <td class="promostatus"><button class="btn btn-sm btn-info promobtn newPromoStatus"  data-promoid="<?php echo($_POST["promoid"]) ?>" data-promo-status="0" ><span class="glyphicon glyphicon-stop glyphicon-menu black newPromoStatus" data-promoid="<?php echo($_POST["promoid"]) ?>" data-promo-status="0" aria-hidden="true"></span><br> Promotion Disabled<br>(Will not be displayed</button></td>
    </tr>
</table>

<script>

    $(".newPromoStatus").unbind('click').click(changePromoStatus);

</script>