import WidgetsEdit from '../../modules/widgets/widgets_edit';

$(function () {
	let builder = new WidgetsEdit($('#roleID').data('id'));
	
	builder.isCurrentFormStatic = true;
	builder.init();
	builder.currentForm = 1;
});
