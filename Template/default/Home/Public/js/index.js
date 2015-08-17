$(function(){
	$(window).scroll(function(e) {
		//若滚动条离顶部大于200元素
		if($(window).scrollTop()>200){
			$(".go-top").fadeIn(500);
		}else{
			$(".go-top").fadeOut(500);
		}
	});
})

// 第三方登陆
function showlogin(){
	$.post(saveLoginUrl, {"url":top.location.href}, function(data, textStatus, xhr) {
		$('#modal-login').modal('show');
	});
}

// 退出
function logout(){
	$.post(saveLoginUrl, {"url":top.location.href}, function(data, textStatus, xhr) {
		location.href=logoutUrl;
	});
}

// 点击返回顶部
function goTop(){

}
