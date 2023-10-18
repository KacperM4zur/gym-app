import React from "react";

const FormInput = ({ type, placeholder, value, onChange, icon }) => {
    return (
        <div className="input">
            <img src={icon} alt="" />
            <input type={type} placeholder={placeholder} value={value} onChange={onChange} />
        </div>
    );
};

export default FormInput;
