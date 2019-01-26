export default class FormDataBag {
	
	private formdata: FormData = new FormData();
	private inputs: object = {};
	
	public add(key: string, value: boolean | null | undefined | string | number | object): void {
		this.inputs[key] = (value === undefined || (typeof value === "string" && value.toString().length === 0) ? null : value);
	}
	
	public addFiles(key: string, fileList: FileList): void {
		for (let i = 0; i < fileList.length; i++) {
			this.formdata.append(key + '[]', fileList[i])
		}
	}
	
	public addFile(key: string, file: File): void {
		this.formdata.append(key, file);
	}
	
	public delete(key: string): void {
		this.formdata.delete(key);
	}
	
	public has(key: string): boolean {
		return this.formdata.has(key);
	}
	
	public get(key: string): FormDataEntryValue {
		return this.formdata.get(key);
	}
	
	public getAll(key: string): FormDataEntryValue[] {
		return this.formdata.getAll(key);
	}
	
	public getFormData(): FormData {
		this.formdata.append('data', JSON.stringify(this.inputs));
		return this.formdata;
	}
	
}
