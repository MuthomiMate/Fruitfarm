<?php
$total=2345/100;
?>



<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<fieldset>
                                <input type="hidden" name="cmd" value="_xclick" />
                                <input type="hidden" name="business" value="muthomimate@gmail.com" />
                                <input type="hidden" name="lc" value="AU" />
                                <input type="hidden" name="item_name" value="Payment" />
                                <input type="hidden" name="item_number" value="P1" />
                                <input type="hidden" name="currency_code" value="USD" />
                                <!-- <input type="hidden" name="button_subtype" value="services" /> -->
                                <input type="hidden" name="no_note" value="0" />
                                <input type="hidden" name="cn" value="Comments" />
                                <input type="hidden" name="no_shipping" value="1" />
                                <input type="hidden" name="rm" value="1" />
                                <input type="hidden" name="return" value="http://www.ekerner.com/payments/?payment=success" />
                                <input type="hidden" name="cancel_return" value="http://www.ekerner.com/payments/?payment=cancelled" />
                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHostedGuest" />
                                <table>
                                        <tr><td style="padding:0 5px 5px 0;">Amount USD</td><td style="padding:0 5px 5px 0;"><input type="text" 
                                      

                                        name="amount" maxlength="200" readonly value='<?= $total; ?>' /></td></tr>
                                        
                                        <tr><td>&nbsp;</td><td style="padding:0 5px 5px 0;">
                                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">

                                        </td></tr>
                                </table>
                            </fieldset>
                            </form>
<!-- form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="H4B4AA7FED6N8">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form> -->
