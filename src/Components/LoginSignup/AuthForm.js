import React from "react";
import FormInput from "./FormInput";


import user_icon from '../Assets/person.png'
import email_icon from '../Assets/email.png'
import password_icon from '../Assets/password.png'

const AuthForm = ({ action, formData, setFormData, handleSubmit, setAction }) => {
    return (
        <form onSubmit={handleSubmit}>
            <div className="header">
                <div className="text">{action}</div>
                <div className="underline"></div>
            </div>
            {action !== "Login" && (
                <>
                    <FormInput
                        type="text"
                        placeholder="First Name"
                        value={formData.customer_firstname}
                        onChange={(e) => setFormData({ ...formData, customer_firstname: e.target.value })}
                        icon={user_icon}
                    />
                    <FormInput
                        type="text"
                        placeholder="Last Name"
                        value={formData.customer_lastname}
                        onChange={(e) => setFormData({ ...formData, customer_lastname: e.target.value })}
                        icon={user_icon}
                    />
                </>
            )}
            <FormInput
                type="email"
                placeholder="Email"
                value={formData.customer_email}
                onChange={(e) => setFormData({ ...formData, customer_email: e.target.value })}
                icon={email_icon}
            />
            <FormInput
                type="password"
                placeholder="Password"
                value={formData.customer_password}
                onChange={(e) => setFormData({ ...formData, customer_password: e.target.value })}
                icon={password_icon}
            />
            {action !== "Sign Up" && <div className="form-questions">Lost password? <span>Click Here!</span></div>}
            {action !== "Sign Up" && (
                <div className="form-questions">
                    You do not have an account? <span onClick={() => setAction("Sign Up")}>Create account!</span>
                </div>
            )}
            {action !== "Login" && (
                <div className="form-questions">
                    If you have an account <span onClick={() => setAction("Login")}>Login here!</span>
                </div>
            )}
            <div className="submit-container">
                <button type="submit" className="submit">
                    {action === "Sign Up" ? "Sign Up" : "Login"}
                </button>
            </div>
        </form>
    );
};

export default AuthForm;
