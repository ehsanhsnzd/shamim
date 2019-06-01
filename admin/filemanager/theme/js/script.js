hash = 1; 
b = []; 
aAsc = []; 
ID = 0; 
searchQuery = ''; 
rows = [];
appBarOn = 0;
action = 0;
actionPath = '';

function fetch(dir, q) {
	appbar_hide();
	$("#path").empty();
	$("#explorer").html('<tr id="fetch"><td colspan="4"><img src="theme/images/preloader-w8-cycle-black.gif"></td></tr>');
	
	data = {"dir": _64(dir)};
	if(q) {
		page = "search.php";
		data.q = searchQuery;
	} else {
		page = "fetch.php";
	}
	
    $.ajax({
        url: page,
        data: data
	}).always(function(data, status) {
			if(!data || status != 'success' || data == '0') {
				$("#explorer").html('<tr><td colspan="4">You are not allowed to perform this action. <a href="javascript:history.back()">Go back!</a></td></tr>');
				return false;
			}
	
			var path, x, i;
            
            rows = [];
            b = data.split("\n"); b.pop();
			
			path = b[0].split("/"); 
			b[0] = ''; path.pop();
			for(i = 0; i < path.length; ++i) {			
				b[0] += path[i]+'/';
                $("<li/>", {
                    html: $("<a/>", {
                                href: "#"+b[0],
                                text: path[i]+'/'
                            })
                }).appendTo("#path");
			}
			
			for(i = 1; i < b.length; ++i) {
                rows[i] = 1;
				b[i] = b[i].split("|");
				b[i][6] = b[i][1].slice(0,1)=="d";
				if(b[i][6]) b[i][5] = 'File folder';
				else {
					x = b[i][0].lastIndexOf(".")+1;
					if(x) b[i][5] = b[i][0].slice(x).toUpperCase()+' File';
					else  b[i][5] = 'File';
				}
				
				out = '<tr onclick="appbar_d(this)" data-id="'+i+'">';
				out+= '<td><a ';
				if(b[i][6]) out+= 'href="#'+b[0]+b[i][0]+'/"';
				out+= 'title="'+b[0]+b[i][0]+'">';
				if(b[i][6]) out+= '<i class="icon-folder"></i>';
				else        out+= '<i class="icon-file"></i>';
				out+= b[i][0]+'</a></td>';
				out+= '<td>'+b[i][3]+'</td>';
				out+= '<td>'+b[i][5]+'</td>';
				out+= '<td>'+b[i][1]+'</td>';
				out+= '<td class="right">'+b[i][2]+'</td>';
				out+= '</tr>';
				
				$(out).appendTo("#explorer");
            }
			$("#fetch").remove();
			aAsc = []; sortTable(4);
	});
}

function action_path() {
    actionPath = [];
    $(".selected-row").each(function() {
        var ID;
        ID = $(this).data("id");
        actionPath.push(b[0]+b[ID][0]);
    });
}

function appbar_hide() {
	if(appBarOn) return false;
	$(".app-bar").hide("slow");
	$(".page.fill").css("margin-bottom", "0");
}

function appbar_show() {
	$(".app-bar").show("slow");
	$(".page.fill").css("margin-bottom", "100px");
}

function appbar_d(file) {
	if(appBarOn) return false;
    
    var rows;
    rows = $(".selected-row").length;

    if($(file).hasClass("selected-row")) {
        $(file).removeClass("selected-row");
        --rows;
    } else {
        $(file).addClass("selected-row");
        ++rows;
    }
    
    if(rows >= 1) {
        $("#name > span").text(rows + " files selected");
        $("#modi, #type, #size, #fullPath, #crea, #d").hide(0);
        
        appbar_show();
    }
    
    if(rows == 1) {
        id = $(".selected-row").data("id");
        
        $("#modi, #type, #size, #fullPath, #crea, #d").show(0);
		$("#name > span").text(b[id][0]);
		$("#modi > span").text(b[id][3]);
		$("#type > span").text(b[id][5]);
		$("#fullPath")   .text(b[0]);
		if(b[id][6]) {
			$("#size, #crea, #d").hide(0);
		} else {
			$("#size, #crea, #d").show(0);
            
			$("#size > span").text(b[id][2]);
			$("#crea > span").text(b[id][4]);
			$("#d").attr("href", "op.php?q=dLoad&a="+encodeURIComponent(b[0]+b[id][0]));
		}
		
		appbar_show();
    }
    
    if(rows == 0) {
        appbar_hide();
    }
}

function paste_show() {
	appBarOn = 1;
	$("#cut, #copy, #rename, #delete").hide();
	$("#paste, #cancel").show();
}

function paste_hide() {
	appBarOn = 0;
    appbar_hide();
	$("#paste, #cancel").hide();
	$("#cut, #copy, #rename, #delete").show();
}

function check(){ 
    if(window.location.hash != hash) {
        hash = window.location.hash;
		q = hash.indexOf("?");
		if(q != -1) {
			searchQuery = hash.substring(q+1);
			fetch(hash.substring(1, q), 1);
		} else {
			fetch(hash.substring(1));
		}
	} setTimeout("check()", 400); 
}

function sortTable(x, t) {
	$(".icon-arrow-up-2").removeClass("icon-arrow-up-2");
	$(".icon-arrow-down-2").removeClass("icon-arrow-down-2");
	if(aAsc[x] == 'asc') {
		if(t) $("small", t).addClass("icon-arrow-down-2");
		aAsc[x] = 'desc';
	} else {
		if(t) $("small", t).addClass("icon-arrow-up-2");
		aAsc[x] = 'asc';
	}
	$('#explorer > tr').tsort('td:eq('+x+')', {order:aAsc[x]});
}

function dialogForm(q, a, b) {
    var _d = 1, _i = 0, _len;
	$("#dialogBox form").hide();
	$("#loading")       .show();
    
    if(!$.isArray(a)) {a = [a];}
    _len = a.length;
    
    $.each(a, function(i, v) {
        $.ajax({
            url: "op.php",
            data: {"q": q, "a": v, "b": b}
        }).always(function(data) {
            _d &= parseInt(data);
            _i++;
            
            if(_i >= _len) {
                $("#loading").hide();
                if(_d) {
                    $("#dialogBox h3").text("Success!")
                                      .addClass("fg-color-green")
                                      .show();
                } else {
                    $("#dialogBox h3").text("Failure")
                                      .addClass("fg-color-redLight")
                                      .show();
                }
            }
        });
    });
}

function searchForm(form) {
	var q = $.trim($("input[name=q]", form).val());
	if(q) {
		$.Dialog.close();
		window.location.hash = "#"+b[0]+"?"+q;
	} else {
		$("h3", form).hide(0);
		if($("span", form).length) {
			$("span", form).append("!");
		} else {
			$("<span />", {
				style: "display:none",
				text: "Write something"
			}).addClass("label important as-block")
			.appendTo(form).show("fast");
		}
	}
}

function uploadForm() {
	form = $("#dialogBox");
	if(Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0) {
		 $('#fileUpload', form).removeAttr("multiple");
    }
	$("#fileUpload", form).liteUploader({
		script: 'op.php?q=upload&a='+b[0],
		before: function() {
			$("h3", form).removeClass()
						 .text("Loading");
			$(".bar", form).css("width", "0");
			$(".unstyled", form).empty();
			
			return true;
		},
		each: function(file) {
			$("<li />", {
				text: file.name
			}).appendTo($(".unstyled", form));
		},
		success: function(response) {
			if(response=="1") {
				$("h3", form).text("Success")
							 .addClass("fg-color-green");
			} else {
				$("h3", form).text("Failure")
							 .addClass("fg-color-redLight");
			}
		},
		progress: function(percentage) {
			$(".bar", form).css("width", percentage+"%");
		}
	});
}

var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
function _64(input) {
 if (input == '') return '';
 input = unescape(encodeURIComponent(input));
 var output = "";
 var chr1, chr2, chr3 = "";
 var enc1, enc2, enc3, enc4 = "";
 var i = 0;

 do {
    chr1 = input.charCodeAt(i++);
    chr2 = input.charCodeAt(i++);
    chr3 = input.charCodeAt(i++);

    enc1 = chr1 >> 2;
    enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
    enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
    enc4 = chr3 & 63;

    if (isNaN(chr2)) {
       enc3 = enc4 = 64;
    } else if (isNaN(chr3)) {
       enc4 = 64;
    }

    output = output +
       keyStr.charAt(enc1) +
       keyStr.charAt(enc2) +
       keyStr.charAt(enc3) +
       keyStr.charAt(enc4);
    chr1 = chr2 = chr3 = "";
    enc1 = enc2 = enc3 = enc4 = "";
 } while (i < input.length);

 return output;
}

$(document).ready(function() {
	/* ctrlPressed = 0;
	$(window).keydown(function(evt) {
		if(evt.which == 17) { // ctrl
			ctrlPressed = 1;
		}
	}).keyup(function(evt) {
		if(evt.which == 17) { // ctrl
			ctrlPressed = 0;
		}
	}); */
    
    $.ajaxSetup({
        type: "get",
        dataType: "text",
        timeout: 5000,
        cache: false
    });
});
