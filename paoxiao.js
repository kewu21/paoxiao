var emptyShout = ["没有字你让我怎么咆哮阿！！！以为我尼玛是机器猫阿！！！！",
			"教主面对一片空白的输入框表示压力很大有木有！！！",
			"好歹写几个字吧！！！没有字我怎么咆哮啊啊啊！！！",
			"这货咆哮的时候不写字有没有！！熊孩子挺会玩啊啊！！"]
var TARGET_CHAR = ["。","，",".",",","；",";","!","！","\n"];
var SW = [["什么","神马"],["你妈","尼玛"],["没有","木有"],["怎么","肿么"],["我","劳资"],["我们","劳资"]];
var output = [];
var finalString = "";
var textToPaste = ""
var clipboardBtn = $(".toclipboard");
var userComposed = false
var contentChanged = false
$(document).ready(function(){
	var index = Math.floor(Math.random()*5).toString()
	//alert(index)
	$.get("text"+index+".txt", function(data){
		//alert("ddd"+data);
		$("#content").val(data);
		$("#content").attr("disabled","")
	})
	if($("#successIfno").css('display') != "none"){
		$("#successInfo").hide(2000)
	}
})
$("#content").focus(function(){
	if (!userComposed){
		userComposed = true
		$("#content").val("")
	}
})
$("#content").change(function(){
	contentChanged = true;
})
$(".genButton").click(function(){
	if (contentChanged){
		$("#output").hide()
		contentChanged = false
	}
	if ($("#content").val() == ""){
		$("#output").html(emptyShout[Math.floor(Math.random()*emptyShout.length)])
		$("#output").show()
		clipboardBtn.hide()
		$("#secondGen").hide();
	}else{
		paoxiao($("#content").val().replace(/^\s+|\s+$/g, ""));
		$("#output").show("slow")
		textToPaste = ""
		var clip = $("#output").find("p");
		for (var i = 0; i < clip.length ;i++ ) {
			textToPaste += clip[i].innerHTML.replace(/^\s+|\s+$/g, "") + "\r\n";
		}
		clipboardBtn.show();
		$("#secondGen").show();
		clipboardBtn.zclip({
			path:"ZeroClipboard.swf",
			copy:textToPaste
		})
	}
});


function paoxiao(source) {
	finalString = "";
	output = process(source);
	for (var i = 0; i < output.length; i++ ) {
		finalString += "<p>" + output[i] +  "</p>"  
	}
	$("#output").find("p").empty();
	$("#output").html(finalString);
	
}

function makeFun(source) {
	source.replace(/^\s+|\s+$/g, "");
	if (Math.random() * 10 < 1) {
		var target = Math.floor(Math.random() * source.length);
		source = source.substring(0, target) + "泥马" + source.substring(target, source.length);
	} else if (Math.random() * 10 < 2) {
		source = "尼玛" + source;
	}
	if (Math.random()*10 < 1) {
		source += randomShot("啊", 1, 5);
	}
	if (Math.random()*10 < 3) {
		source += "有木有" + randomShot("！", 3, 6);
		if (Math.random()*10 < 3) {
			source += "亲" + randomShot("！", 3, 6);
		}
	}
	for (var i = SW.length; i--;) {
		var old = SW[i][0];
		var _new = SW[i][1];
		source = source.replace(old, _new);
	}
	source += randomShot("！", 3, 10);
return source;	
}
function process(source) {
var l = [];
	var p = 0;
	for (var i = 0; i < source.length; i++ ){
		if ($.inArray(source.charAt(i),TARGET_CHAR) != -1) {
		if ((i-p) > 5 || i == source.length -1) {
	    var s = source.substring(p, i);
	    if (p != 0) {
					s = s.substring(1, s.length);
				}
	    p = i;
	    l.push(makeFun(s));
			}
		}
	}
	if (p < source.length - 1) {
		source = source.substring(p, source.length);
    if (p != 0) {
			source = source.substring(1, source.length);
		}
		source = makeFun(source.replace(/^\s+|\s+$/g, ""));
		l.push(source);
	}
l[l.length - 1] += randomShot("！", 5, 10);	
	if (Math.random()*10 < 3) {
		l.push("亲，包邮哦亲" + randomShot("！", 5, 10));	
	}else if (Math.random()*10 < 3) {
		l.push("你伤不起" + randomShot("啊", 1, 5)+randomShot("！", 5, 10));	
	}

	return l;
}
function randomShot(s, min, max) {
	var range = Math.floor(Math.random()*(max - min)) + min;
	var result = "";
	for (var i = 0; i < range ; i++) {
		result += s;
	}
	return result;
}
