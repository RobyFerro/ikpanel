/*
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

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
