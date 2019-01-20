export default class Notify {
	
	public static send(options): void {
		//@ts-ignore
		$('body').pgNotification(options).show();
	}
	
	public static info(message: string): void {
		this.send({
			type: 'info',
			message: message
		});
	}
	
	public static warning(message: string): void {
		this.send({
			type: 'warning',
			message: message
		});
	}
	
	public static success(message: string): void {
		this.send({
			type: 'success',
			message: message
		});
	}
	
	public static danger(message: string): void {
		this.send({
			type: 'danger',
			message: message
		});
	}
}
