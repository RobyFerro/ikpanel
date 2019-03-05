import Composer, {IRoutes, ITab} from "../composer";

export default class WidgetsEdit extends Composer {
	
	constructor(role) {
		super();
		this.setRole(role);
	}
	
	protected tabs: ITab[] = [
		{id: 'Widgets', title: 'Widgets', predicate: x => true}
	];
	
	public setRole(id) {
		let main = this;
		
		main.routes = {
			availableComponents: `widgets/edit-load-all`,
			formComponents: `widgets/load-rows/${id}`,
			saveForm: `widgets/save/${id}`
		};
	}
}

