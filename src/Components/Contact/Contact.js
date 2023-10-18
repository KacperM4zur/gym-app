import React from 'react';
import {Navigate, useNavigate} from 'react-router-dom';

const isAuthenticated = () => {
    const user = localStorage.getItem('user');
    return user !== null;
};

const Contact = () => {
    const navigate = useNavigate();

    const handleLogout = () => {
        localStorage.removeItem('user');
        navigate('/login');
    };

    if (!isAuthenticated()) {
        return <Navigate to="/login" />;
    }

    return (
        <div className="contact">
            <h1>Contact Us</h1>
            <button onClick={handleLogout}>Logout</button>
        </div>
    );
};

export default Contact;
