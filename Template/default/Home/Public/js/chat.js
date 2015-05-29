$(function(){
	// js调整时间轴的高度
	$('.chat-middle').height($('.chat').height());
	// js调整气泡三角的top
	$('.arrows-right1,.arrows-right2').each(function(index, el) {
		$(el).css('top', $(el).parent('.chat-one').height()/2.5);
	});
})