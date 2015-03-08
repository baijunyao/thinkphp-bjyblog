$(function(){
	$("#nav-top .nt-nav li").click(function(event) {
		var i=$(this).index();
		$(this).addClass('ntn-active').siblings('li').removeClass('ntn-active');
		$('#nav-left .nl-con').eq(i).addClass('nl-show').siblings('.nl-con').removeClass('nl-show');
	});
})