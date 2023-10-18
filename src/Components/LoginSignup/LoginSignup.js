import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import './LoginSignup.css'
import user_icon from '../Assets/person.png'
import email_icon from '../Assets/email.png'
import password_icon from '../Assets/password.png'
import AuthForm from './AuthForm';

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
                    if (responseData.status === 200) {
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
                <AuthForm action={action} formData={formData} setFormData={setFormData} handleSubmit={handleSubmit} setAction={setAction} />
            )}
        </div>
    );
};

export default LoginSignup;
