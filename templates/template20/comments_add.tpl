<form name="commentsadd" id="commentsadd"   Enctype="multipart/form-data">
<input type="hidden" name="postid" value="{POSTID}">

<div class="form_field">
<span><b>{WORD_NEW}:</b></span>
<textarea name="content" style="height:60px" class='ibox form-control'></textarea>
</div>


<div class="form_field">
<input class='btn btn-primary' type="button" onClick="comments_add('commentsadd');" value="{WORD_ADD}">
</div>
</form>