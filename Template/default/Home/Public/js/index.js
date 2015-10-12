$(function(){
	// 设置iframe宽度
	$('.b-article iframe').width('95%');
	// 返回顶部
	$(window).scroll(function(e) {
		//若滚动条离顶部大于200元素
		if($(window).scrollTop()>200){
			$(".go-top").fadeIn(500);
		}else{
			$(".go-top").fadeOut(500);
		}
	});

	// 改变导航栏高度
	$(window).scroll(function(e) {
		//若滚动条离顶部大于100元素
		if($(window).scrollTop()>100){
			$('#b-public-nav .b-user-info').animate({'padding':'5px'},10);
			$('#b-public-nav .b-nav-cname a').animate({'padding':'10px'},10);
			$('#b-public-nav .navbar-brand').animate({'padding':'5px'},10);
		}else{
			$('#b-public-nav .b-nav-cname a').animate({'padding':'15px'},10);
			$('#b-public-nav .navbar-brand').animate({'padding':'5px'},10);
			$('#b-public-nav .b-user-info').animate({'padding':'10px'},10);
		}
	});

	// 为分页类增加响应式class
	$('.b-page .first,.num,.end').addClass('hidden-xs');
	$('.b-page .rows').addClass('hidden-xs');

})

// 退出
function logout(){
	$.post(saveLoginUrl, {"url":top.location.href}, function(data) {
		location.href=logoutUrl;
	});
}

// 点击返回顶部
function goTop(){
	$('body,html').animate({scrollTop:0},500);
	return false;
}
