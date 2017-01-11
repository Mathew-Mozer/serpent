<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/10/2017
 * Time: 10:35 AM
 */
?>
<button class="PromotionDetailsBtn" type='button' hidden xmlns="http://www.w3.org/1999/html">Details</button>
<button class="PromotionSessionBtn" type='button'>Sessions</button>
<input type="hidden" name="promoId" id="promoId" value="<?php echo($_POST['promotion_id']) ?>">
<div id="session-manager" hidden>
    <div>
        <table class="table table-striped">
            <thead>
            <td>Start Day</td>
            <td>Start Time</td>
            <td>End Day</td>
            <td>End Time</td>
            <td></td>
            </thead>
            <tbody id="session-content">

            </tbody>
        </table>
        <table class="table table-striped">
            <thead>
            <td>Start Day</td>
            <td>Start Time</td>
            <td>End Day</td>
            <td>End Time</td>
            <td></td>
            </thead>
        <tr>
            <td><select id='sday' name="sday">
                    <option value="1">Sunday</option>
                    <option value="2">Monday</option>
                    <option value="3">Tuesday</option>
                    <option value="4">Wednesday</option>
                    <option value="5">Thursday</option>
                    <option value="6">Friday</option>
                    <option value="7">Saturday</option>
                </select></td>
            <td><select id='stime' name="stime">
                    <option value="00:00:00">12:00 am</option>
                    <option value="00:30:00">12:30 am</option>
                    <option value="01:00:00">1:00 am</option>
                    <option value="01:30:00">1:30 am</option>
                    <option value="02:00:00">2:00 am</option>
                    <option value="02:30:00">2:30 am</option>
                    <option value="03:00:00">3:00 am</option>
                    <option value="03:30:00">3:30 am</option>
                    <option value="04:00:00">4:00 am</option>
                    <option value="04:30:00">4:30 am</option>
                    <option value="05:00:00">5:00 am</option>
                    <option value="05:30:00">5:30 am</option>
                    <option value="06:00:00">6:00 am</option>
                    <option value="06:30:00">6:30 am</option>
                    <option value="07:00:00">7:00 am</option>
                    <option value="07:30:00">7:30 am</option>
                    <option value="08:00:00">8:00 am</option>
                    <option value="08:30:00">8:30 am</option>
                    <option value="09:00:00">9:00 am</option>
                    <option value="09:30:00">9:30 am</option>
                    <option value="10:00:00">10:00 am</option>
                    <option value="10:30:00">10:30 am</option>
                    <option value="11:00:00">11:00 am</option>
                    <option value="11:30:00">11:30 am</option>
                    <option value="12:00:00">12:00 pm</option>
                    <option value="12:30:00">12:30 pm</option>
                    <option value="13:00:00">1:00 pm</option>
                    <option value="13:30:00">1:30 pm</option>
                    <option value="14:00:00">2:00 pm</option>
                    <option value="14:30:00">2:30 pm</option>
                    <option value="15:00:00">3:00 pm</option>
                    <option value="15:30:00">3:30 pm</option>
                    <option value="16:00:00">4:00 pm</option>
                    <option value="16:30:00">4:30 pm</option>
                    <option value="17:00:00">5:00 pm</option>
                    <option value="17:30:00">5:30 pm</option>
                    <option value="18:00:00">6:00 pm</option>
                    <option value="18:30:00">6:30 pm</option>
                    <option value="19:00:00">7:00 pm</option>
                    <option value="19:30:00">7:30 pm</option>
                    <option value="20:00:00">8:00 pm</option>
                    <option value="20:30:00">8:30 pm</option>
                    <option value="21:00:00">9:00 pm</option>
                    <option value="21:30:00">9:30 pm</option>
                    <option value="22:00:00">10:00 pm</option>
                    <option value="22:30:00">10:30 pm</option>
                    <option value="23:00:00">11:00 pm</option>
                    <option value="23:30:00">11:30 pm</option>
                </select></td>
            <td><select id='eday' name="eday">
                    <option value="1">Sunday</option>
                    <option value="2">Monday</option>
                    <option value="3">Tuesday</option>
                    <option value="4">Wednesday</option>
                    <option value="5">Thursday</option>
                    <option value="6">Friday</option>
                    <option value="7">Saturday</option>
                </select></td>
            <td><select id='etime' name="etime">
                    <option value="00:00:00">12:00 am</option>
                    <option value="00:30:00">12:30 am</option>
                    <option value="01:00:00">1:00 am</option>
                    <option value="01:30:00">1:30 am</option>
                    <option value="02:00:00">2:00 am</option>
                    <option value="02:30:00">2:30 am</option>
                    <option value="03:00:00">3:00 am</option>
                    <option value="03:30:00">3:30 am</option>
                    <option value="04:00:00">4:00 am</option>
                    <option value="04:30:00">4:30 am</option>
                    <option value="05:00:00">5:00 am</option>
                    <option value="05:30:00">5:30 am</option>
                    <option value="06:00:00">6:00 am</option>
                    <option value="06:30:00">6:30 am</option>
                    <option value="07:00:00">7:00 am</option>
                    <option value="07:30:00">7:30 am</option>
                    <option value="08:00:00">8:00 am</option>
                    <option value="08:30:00">8:30 am</option>
                    <option value="09:00:00">9:00 am</option>
                    <option value="09:30:00">9:30 am</option>
                    <option value="10:00:00">10:00 am</option>
                    <option value="10:30:00">10:30 am</option>
                    <option value="11:00:00">11:00 am</option>
                    <option value="11:30:00">11:30 am</option>
                    <option value="12:00:00">12:00 pm</option>
                    <option value="12:30:00">12:30 pm</option>
                    <option value="13:00:00">1:00 pm</option>
                    <option value="13:30:00">1:30 pm</option>
                    <option value="14:00:00">2:00 pm</option>
                    <option value="14:30:00">2:30 pm</option>
                    <option value="15:00:00">3:00 pm</option>
                    <option value="15:30:00">3:30 pm</option>
                    <option value="16:00:00">4:00 pm</option>
                    <option value="16:30:00">4:30 pm</option>
                    <option value="17:00:00">5:00 pm</option>
                    <option value="17:30:00">5:30 pm</option>
                    <option value="18:00:00">6:00 pm</option>
                    <option value="18:30:00">6:30 pm</option>
                    <option value="19:00:00">7:00 pm</option>
                    <option value="19:30:00">7:30 pm</option>
                    <option value="20:00:00">8:00 pm</option>
                    <option value="20:30:00">8:30 pm</option>
                    <option value="21:00:00">9:00 pm</option>
                    <option value="21:30:00">9:30 pm</option>
                    <option value="22:00:00">10:00 pm</option>
                    <option value="22:30:00">10:30 pm</option>
                    <option value="23:00:00">11:00 pm</option>
                    <option value="23:30:00">11:30 pm</option>
                </select></td>
            <td>
                <button class="add-session-btn" type="button">Add Session</button>
            </td>
        </tr>
        </table>
    </div>
    <script>

    </script>
</div>