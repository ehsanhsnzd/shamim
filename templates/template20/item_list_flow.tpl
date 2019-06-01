
<!-- start home_item !-->
<div class="listing-item white-bg bordered mb-20 home_box get-item-flow">
	<div class="overlay-container">
		<a href="{ITEM_URL}"><img src="{ITEM_IMG2}" alt="{ITEM_TITLE_FULL}" class="home_preview"  {ITEM_LIGHTBOX} ></a>
		<span class="badge">{lang.New}</span>
		<span class="badge">{lang.Featured} : عمومی</span>
	</div>
	<div class="body">
 		<h3><a href="{ITEM_URL}">{ITEM_TITLE_FULL}</a></h3>
		<p class="small">{ITEM_DESCRIPTION}</p>
		<div class="elements-list clearfix">
			<a href="javascript:{ADD_CARD_DOWN}" title="{lang.Add to Cart}" id="ts_cart{ITEM_ID}" class="pull-left margin-clear btn btn-sm btn-default btn-animated"><span class="ts_cart_text{ITEM_ID}">{lang.Add to cart}</span><i class="fa fa-shopping-cart"></i><span style='display:none' class="ts_cart_text2{ITEM_ID}">{lang.In your cart}</span></a>

		</div>
	</div>
</div>
<!-- end home_item !-->
