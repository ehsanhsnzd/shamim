<div class="item_list">
<div  class="item_list_img">
<a href="{ITEM_URL}"><img src="{ITEM_IMG}" border="0" {ITEM_LIGHTBOX}></a>
</div>
<div  class="item_list_text{CLASS}">
<div><a href="{ITEM_URL}">{ITEM_TITLE}</a></div>
<div id='cart{ITEM_ID}'>{if cart}<a href="javascript:{CART_FUNCTION}_cart({ITEM_ID});" class="ac{CART_CLASS}">{ADD_TO_CART}</a>{/if}</div>
<div class="iviewed">{ITEM_VIEWED}</div>
<div class="idownloaded">{DOWNLOADS}</div>
</div>
</div>

