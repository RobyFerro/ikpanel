import React from 'react';

export const InputGroup = (props) => {
	return (
		<div className="form-group form-group-default input-group">
			<div className="form-input-group">
				<label htmlFor="title">{props.label}</label>
				{props.children}
			</div>
		</div>
	);
};
