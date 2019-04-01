export default function truncate(str, limit, suffix) {
	if(typeof str === 'string') {
		if(typeof suffix !== 'string') {
			suffix = '';
		}
		if(str.length > limit) {
			return str.slice(0, limit - suffix.length) + suffix;
		}
		return str;
	}
};
