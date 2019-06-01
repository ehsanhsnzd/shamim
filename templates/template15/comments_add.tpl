<h2>{WORD_NEW}:</h2>
<form name="commentsadd" id="commentsadd" style="margin-bottom:25px"  Enctype="multipart/form-data">
<input type="hidden" name="postid" value="{POSTID}">
<table border="0" cellpadding="3" cellspacing="1" class="tborder">
<tr valign="top">
<td class="graybg"><b>{WORD_CONTENT}:</b></td>
<td class="tcontent"><textarea name="content" style="width:265;height:60" class='ibox'></textarea></td>
</tr>
<tr>
<td class="graybg"><img src="{SITE_ROOT}images/c{RR}.gif" width="80" height="30"></td>
<td class="tcontent"><input class='ibox' name="rn1" type="text" value="" size="20"><input name="rn2" type="hidden" value="{RR}"></td>
      </tr>

</table><input class='isubmit' type="button" onClick="comments_add('commentsadd');" value="{WORD_ADD}" style="margin-top:5px">

</form>