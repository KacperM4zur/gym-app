import React, { useState } from "react";
import {Route, Routes, Navigate, Router, useNavigate} from "react-router-dom";
import './LoginSignup.css'
import user_icon from '../Assets/person.png'
import email_icon from '../Assets/email.png'
import password_icon from '../Assets/password.png'

const isAuthenticated = () => {
    const user = localStorage.getItem('user');
    return user !== null;
};

const LoginSignup = () => {
    const [action, setAction] = useState("Login");
    const [formData, setFormData] = useState({
        customer_firstname: '',
        customer_lastname: '',
        customer_email: '',
        customer_password: ''
    });

    const navigate = useNavigate();

    const handleSubmit = (e) => {
        e.preventDefault();

        if (action === "Login") {
            fetch('http://gymappbo.westeurope.cloudapp.azure.com/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else if (response.status === 400) {
                        console.log("Error 400 - Invalid data.");
                        return Promise.reject("Invalid data");
                    } else {
                        console.log("Other HTTP error: ", response.status);
                        return Promise.reject("HTTP error");
                    }
                })
                .then(responseData => {
                    if (responseData.status === 200 && responseData.message === "Successfully logged in") {
                        console.log("Successfully logged in. User data:", responseData.data);
                        localStorage.setItem('user', JSON.stringify(responseData.data));
                        navigate('/');
                    } else {
                        console.log("Login error: ", responseData.message);
                    }
                })
                .catch(error => {
                    console.error("Error: ", error);
                    alert("An error occurred. Please try again later.");
                });
        } else if (action === "Sign Up") {
            fetch('http://gymappbo.westeurope.cloudapp.azure.com/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
                .then(response => {
                    if (response.ok) {
                        navigate('/');
                    } else {
                        alert("Registration failed. Check your data or existing account.");
                    }
                })
                .catch(error => {
                    console.error("Error: ", error);
                    alert("An error occurred. Please try again later.");
                });
        }
    };


    const handleLogout = () => {
        localStorage.removeItem('user');
    };

    return (
        <div className='container'>
            {isAuthenticated() ? (
                <div>
                    <div>{JSON.parse(localStorage.getItem('user')).name}</div>
                    <button onClick={handleLogout}>Logout</button>
                </div>
            ) : (
                <form onSubmit={handleSubmit}>
                    <div className="header">
                        <div className="text">{action}</div>
                        <div className="underline"></div>
                    </div>
                    <div className="inputs">
                        {action === "Login" ? <div></div> : (
                            <div className="input">
                                <img src={user_icon} alt=""/>
                                <input
                                    type="text"
                                    placeholder="First Name"
                                    value={formData.customer_firstname}
                                    onChange={(e) => setFormData({ ...formData, customer_firstname: e.target.value })}
                                />
                            </div>

                        )}
                        {action === "Login" ? <div></div> : (
                            <div className="input">
                                <img src={user_icon} alt=""/>
                                <input
                                    type="text"
                                    placeholder="Last Name"
                                    value={formData.customer_lastname}
                                    onChange={(e) => setFormData({ ...formData, customer_lastname: e.target.value })}
                                />
                            </div>

                        )}
                        <div className="input">
                            <img src={email_icon} alt=""/>
                            <input
                                type="email"
                                placeholder="Email"
                                value={formData.customer_email}
                                onChange={(e) => setFormData({ ...formData, customer_email: e.target.value })}
                            />
                        </div>
                        <div className="input">
                            <img src={password_icon} alt=""/>
                            <input
                                type="password"
                                placeholder="Password"
                                value={formData.customer_password}
                                onChange={(e) => setFormData({ ...formData, customer_password: e.target.value })}
                            />
                        </div>
                    </div>
                    {action === "Sign Up" ? <div></div> : (
                        <div className="forgot-password">Lost password? <span>Click Here!</span></div>)}
                    {action === "Sign Up" ? <div></div> : (
                        <div className="forgot-password"> You do not have an account? <span onClick={() => setAction("Sign Up")} >Create account!</span></div>)}
                    {action === "Login" ? <div></div> : (
                        <div className="forgot-password">If you have account <span onClick={() => setAction("Login")} >Login here!</span></div>)}
                    <div className="submit-container">
                        <button type="submit" className="submit">{action === "Sign Up" ? "Sign Up" : "Login"}</button>
                    </div>
                </form>
            )}
        </div>
    );
};

export default LoginSignup;