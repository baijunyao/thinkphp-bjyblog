$(function(){
	// 顶部导航点击增加样式
	$("#nav-top .nt-nav li").click(function(event) {
		var i=$(this).index();
		$(this).addClass('ntn-active').siblings('li').removeClass('ntn-active');
		$('#nav-left .nl-con').eq(i).addClass('nl-show').siblings('.nl-con').removeClass('nl-show');
	});

	// 左侧导航点击增加样式
	$("#nav-left .nl-con dd").click(function(event) {
		$('.nl-checked').hide();
		$(this).find('.nl-checked').show();
	})
})
